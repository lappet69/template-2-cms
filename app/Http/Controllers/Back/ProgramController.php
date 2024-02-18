<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Content;
use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response as res;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Protection;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.program.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['model'] = new Content();
        $data['informasi'] = Informasi::all();
        return view('back.program.form', $data);
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
            'gambar.*'      => 'required|mimes:jpeg,bmp,png,gif,svg,pdf,jpg|max:20480',
            'active' => 'required',
        ],
        [
            'title.required' => 'Judul Program Wajib Diisi',
            'gambar.required' => 'File Gambar Wajib Dilampirkan',
            'active.required' => 'Keterangan Wajib Diisi',
        ]);

        $model = new Content();

        $model->title = $request->title;
        $model->subtitle = $request->subtitle;
        $model->short_description = $request->short_description;
        $model->slug = $this->textToSlug($request->title);
        $model->section_id = 3;
        $model->active = $request->active;
        $model->informasi_detail = implode(',',$request->informasi);
        $model->category_detail = implode(',',$request->category);
        $model->save();

        if($request->file('gambar')) {
            foreach($request->file('gambar') as $key => $file) {
                $time = time();
                $fileName = $time.'-'.Auth::user()->id.'-program-'.$file->hashName();
                $file->move(public_path('front/assets/img'), $fileName);
                
                $asset = new Asset();
                $asset->thumbnail = $fileName;
                $asset->content_id = $model->id;
                $asset->keterangan = $request->keterangan[$key];
                $asset->save();
            }
        }
        if ($model->save()) {
            return redirect()->route('administrator.program.index')->with('alert.success', 'Program telah Disimpan');
        } else {
            return redirect()->route('administrator.program.create')->with('alert.failed', 'Something Wrong');
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
        $data['model'] = Content::find($id);
        $data['informasi'] = Informasi::all();
        
        return view('back.program.form', $data);
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
            'title' => 'Judul Program Wajib Diisi',
            'active.required' => 'Keterangan Wajib Diisi',
        ]);

        $id = base64_decode($id);
        $model = Content::find($id);

        $model->title = $request->title;
        $model->subtitle = $request->subtitle;
        $model->short_description = $request->short_description;
        $model->slug = $this->textToSlug($request->title);
        $model->section_id = 3;
        $model->active = $request->active;
        $model->informasi_detail = implode(',',$request->informasi);
        $model->category_detail = implode(',',$request->category);
        $model->save();

        $thumbnail = Asset::where('content_id', $model->id)->where('keterangan', 'thumbnail')->first();
        $bg_image = Asset::where('content_id', $model->id)->where('keterangan', 'background_image')->first();

        if($request->hasFile('thumbnail')) {
            if(file_exists(public_path('front/assets/img/'.$thumbnail->thumbnail))) {
                unlink(public_path('front/assets/img/'.$thumbnail->thumbnail));
            }

            $time = time();
            $fileName = $time.'-'.Auth::user()->id.'-program.'.$request->thumbnail->extension();

            $request->thumbnail->move(public_path('front/assets/img'), $fileName);
            $asset = Asset::find($thumbnail->id);
            $asset->thumbnail = $fileName;
            $asset->content_id = $model->id;
            $asset->keterangan = "thumbnail";
            $asset->save();
        }

        if($request->hasFile('background_image')) {
            if(file_exists(public_path('front/assets/img/'.$bg_image->thumbnail))) {
                unlink(public_path('front/assets/img/'.$bg_image->thumbnail));
            }

            $time = time();
            $fileName = $time.'-'.Auth::user()->id.'-bg-program.'.$request->background_image->extension();

            $request->background_image->move(public_path('front/assets/img'), $fileName);
            $asset = Asset::find($bg_image->id);
            $asset->thumbnail = $fileName;
            $asset->content_id = $model->id;
            $asset->keterangan = "background_image";
            $asset->save();
        }
        
        

        if ($model->save()) {
            return redirect()->route('administrator.program.index')->with('alert.success', 'Program telah Diperbaharui');
        } else {
            return redirect()->route('administrator.program.create')->with('alert.failed', 'Something Wrong');
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
        $assets = Asset::where('content_id',$model->id)->get();

        foreach($assets as $asset) {
            if(file_exists(public_path('front/assets/img/'.$asset->thumbnail))) {
                unlink(public_path('front/assets/img/'.$asset->thumbnail));
            }
            $asset_model = Asset::find($asset->id);
            $asset_model->deleted_at = date('Y-m-d H:i:s');
            $asset_model->deleted_by = Auth::user()->id;
            $asset_model->save();
        }
        
        $model->deleted_at = date('Y-m-d H:i:s');
        $model->deleted_by = Auth::user()->id;
        $model->save();
    }

    public function datatable(Request $request)
    {
        $query = Content::where('section_id',3)->orderBy('id','asc');
        return DataTables::of($query)
            ->addColumn('informasi', function($model) {
                $arr_informasi = explode(',', $model->informasi_detail);
                $string = '<ul>';
                for($i = 0; $i < count($arr_informasi); $i++) {
                    $informasi = Informasi::find($arr_informasi[$i]);
                    $string .= "<li>".$informasi->title."</li>";
                }
                $string .= '</ul>';

                return $string;
            })
            ->addColumn('value_program', function($model) {
                $arr_category = explode(',', $model->category_detail);
                $string = '<ul>';
                for($i = 0; $i < count($arr_category); $i++) {
                    $category = Informasi::find($arr_category[$i]);
                    $string .= "<li>".$category->title."</li>";
                }
                $string .= '</ul>';

                return $string;
            })
            ->addColumn('action', function ($model) {
                $string = '<div class="btn-group">';
                $string .= '<a href="' . route('administrator.program.edit', ['id' => base64_encode($model->id)]) . '" type="button"  class="btn btn-sm btn-info" title="Edit Program"><i class="fas fa-edit"></i></a>';
                $string .= '&nbsp;&nbsp;<a href="' . route('administrator.program.destroy', ['id' => base64_encode($model->id)]) . '" type="button" class="btn btn-sm btn-danger btn-delete" title="Remove"><i class="fa fa-trash"></i></a>';
                $string .= '</div>';
                return
                    $string;
            })
            ->addIndexColumn()
            ->rawColumns(['action','informasi','value_program'])
            ->make(true);
    }

    private function textToSlug($text='') {
        $text = trim($text);
        if (empty($text)) return '';
          $text = preg_replace("/[^a-zA-Z0-9\-\s]+/", "", $text);
          $text = strtolower(trim($text));
          $text = str_replace(' ', '-', $text);
          $text = $text_ori = preg_replace('/\-{2,}/', '-', $text);
          return $text;
    }
}
