<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response as res;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Protection;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.content.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['sections'] = Section::all();
        $data['contents'] = Content::all();
        $data['model'] = new Content();
        return view('back.content.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'active' => 'required',
        ],
        [
            'title.required' => 'Judul Wajib Diisi',
            'active.required' => 'Keterangan Wajib Diisi',
        ]);

        $content = $request->content;
        
        if(isset($content)) {
            $dom = new \DomDocument();
            $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $imageFile = $dom->getElementsByTagName('imageFile');
        
            foreach($imageFile as $item => $image){
                $data = $content->getAttribute('src');
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $imgeData = base64_decode($data);
                $image_name= "/upload/" . time().$item.'.png';
                $path = public_path() . $image_name;
                file_put_contents($path, $imgeData);
                
                $image->removeAttribute('src');
                $image->setAttribute('src', $image_name);
                }
        
            $content = $dom->saveHTML();
        }

        $model = new Content();

        $model->section_id = $request->section_id;
        $model->parent_content_id = $request->parent_content_id;
        $model->title = $request->title;
        $model->subtitle = $request->subtitle;
        $model->short_description = $request->short_description;
        $model->content = $content;
        $model->active = $request->active;
        $model->save();
    
        // dd($content);

        if ($model->save()) {
            return redirect()->route('administrator.content.index')->with('alert.success', 'Konten Baru Berhasil Tersimpan');
        } else {
            return redirect()->route('administrator.content.create')->with('alert.failed', 'Something Wrong');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Content::find($id);
        return res::json($model);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = base64_decode($id);
        $data['sections'] = Section::all();
        $data['contents'] = Content::all();
        $data['model'] = Content::find($id);
        return view('back.content.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'active' => 'required',
        ],
        [
            'title.required' => 'Judul Wajib Diisi',
            'active' => 'Keterangan Wajib Diisi',
        ]);

        $content = $request->content;

        if(isset($content)) {
            $dom = new \DomDocument();
            $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $imageFile = $dom->getElementsByTagName('imageFile');
        
            foreach($imageFile as $item => $image){
                $data = $content->getAttribute('src');
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $imgeData = base64_decode($data);
                $image_name= "/upload/" . time().$item.'.png';
                $path = public_path() . $image_name;
                file_put_contents($path, $imgeData);
                
                $image->removeAttribute('src');
                $image->setAttribute('src', $image_name);
                }
        
            $content = $dom->saveHTML();
        }
        
        $id = base64_decode($id);
        $model = Content::find($id);

        $model->section_id = $request->section_id;
        $model->parent_content_id = $request->parent_content_id;
        $model->title = $request->title;
        $model->subtitle = $request->subtitle;
        $model->short_description = $request->short_description;
        $model->content = $content;
        $model->active = $request->active;
        $model->save();

        if ($model->save()) {
            return redirect()->route('administrator.content.index')->with('alert.success', 'Konten telah Diperbaharui');
        } else {
            return redirect()->route('administrator.content.create')->with('alert.failed', 'Something Wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = base64_decode($id);
        $model = Content::find($id);
        $folderName = 'banner';
        $file = storage_path() . '/app/banner/' . $model->img;
            if (file_exists($file)) {
                Storage::delete($folderName . '/' . $model->img);
            }
        
        $model->deleted_at = date('Y-m-d H:i:s');
        $model->deleted_by = Auth::user()->id;
        $model->save();
    }

    public function datatable(Request $request)
    {
        $query = Content::get();
        return DataTables::of($query)
            ->editColumn('img', function($model) {
                $string = '<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#showBanner" title="Lihat Banner">'.$model->img.'</a>';
                return $string;
            })
            ->editColumn('section_id', function($model) {
                return $model->section->name;
            })
            ->addColumn('action', function ($model) {
                $string = '<div class="btn-group">';
                $string .= '<a href="' . route('administrator.content.edit', ['id' => base64_encode($model->id)]) . '" type="button"  class="btn btn-sm btn-info" title="Edit Content"><i class="fas fa-edit"></i></a>';
                $string .= '&nbsp;&nbsp;<a href="' . route('administrator.content.destroy', ['id' => base64_encode($model->id)]) . '" type="button" class="btn btn-sm btn-danger btn-delete" title="Hapus Content"><i class="fa fa-trash"></i></a>';
                $string .= '</div>';
                return
                    $string;
            })
            ->addIndexColumn()
            ->rawColumns(['action','section_id','img'])
            ->make(true);
    }
}
