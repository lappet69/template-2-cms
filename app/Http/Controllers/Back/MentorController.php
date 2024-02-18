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

class MentorController extends Controller
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

        $content = $request->description;
        
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

        $files = $request->file('img');
        if ($files) {
            $hashName = $files->hashName();
            $folderName = 'banner';
            $fileName = $hashName;
            $file = storage_path() . '/app/banner/' . $hashName;
            if (file_exists($file)) {
                Storage::delete($folderName . '/' . $fileName);
            }
            $files->store($folderName);
            // Storage::move($folderName . '/' . $hashName, $folderName . '/' . $fileName);

            // Storage::move('uploads/'.$filename, $file);
            $model->img = $hashName;
        }

        $model->title = $request->title;
        $model->description = $content;
        $model->active = $request->active;
        $model->save();
    
        // dd($content);

        if ($model->save()) {
            return redirect()->route('administrator.banner.index')->with('alert.success', 'Banner Berhasil Tersimpan');
        } else {
            return redirect()->route('administrator.banner.create')->with('alert.failed', 'Something Wrong');
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
        $model = Content::find($id);
        return view('back.banner.form', ['model' => $model]);
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
            'img'      => 'required|mimes:jpeg,bmp,png,gif,svg,pdf,jpg|max:20480',
            'active' => 'required',
        ],
        [
            'img.required' => 'File Banner Wajib Dilampirkan',
            'active' => 'Keterangan Wajib Diisi',
        ]);

        $content = $request->description;

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

        $files = $request->file('img');
        if ($files) {
            $hashName = $files->hashName();
            $folderName = 'banner';
            $fileName = $hashName;
            $old_img = $model->img;
            $old_file = storage_path() . '/app/banner/' . $old_img;
            $file = storage_path() . '/app/banner/' . $hashName;
            if (file_exists($old_file)) {
                Storage::delete($folderName . '/' . $old_img);
            }
            $files->store($folderName);
            // Storage::move($folderName . '/' . $hashName, $folderName . '/' . $fileName);

            // Storage::move('uploads/'.$filename, $file);
            $model->img = $hashName;
        }

        $model->title = $request->title;
        $model->description = $content;
        $model->active = $request->active;
        $model->save();

        if ($model->save()) {
            return redirect()->route('administrator.banner.index')->with('alert.success', 'Banner telah Diperbaharui');
        } else {
            return redirect()->route('administrator.banner.create')->with('alert.failed', 'Something Wrong');
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
        $query = Content::all();
        return DataTables::of($query)
            ->editColumn('img', function($model) {
                $string = '<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#showBanner" title="Lihat Banner">'.$model->img.'</a>';
                return $string;
            })
            ->addColumn('action', function ($model) {
                $string = '<div class="btn-group">';
                $string .= '<a href="' . route('administrator.banner.edit', ['id' => base64_encode($model->id)]) . '" type="button"  class="btn btn-sm btn-info" title="Edit Banner"><i class="fas fa-edit"></i></a>';
                $string .= '&nbsp;&nbsp;<a href="' . route('administrator.banner.destroy', ['id' => base64_encode($model->id)]) . '" type="button" class="btn btn-sm btn-danger btn-delete" title="Hapus Banner"><i class="fa fa-trash"></i></a>';
                $string .= '</div>';
                return
                    $string;
            })
            ->addIndexColumn()
            ->rawColumns(['action','img'])
            ->make(true);
    }
}
