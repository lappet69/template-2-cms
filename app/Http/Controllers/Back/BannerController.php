<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response as res;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Protection;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.banner.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Content();
        return view('back.banner.form', ['model' => $model]);
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
            'thumbnail'      => 'required|mimes:jpeg,bmp,png,gif,svg,pdf,jpg|max:20480',
            'active' => 'required',
        ],
        [
            'thumbnail.required' => 'File Banner Wajib Dilampirkan',
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
       
        $model->title = $request->title;
        $model->subtitle = $request->subtitle;
        $model->slug = $this->textToSlug($request->title);
        $model->short_description = $request->short_description;
        $model->content = $content;
        $model->section_id = 10;
        $model->active = $request->active;
        $model->save();

        if($request->file('thumbnail')) {
            $file_name = time().'-'.Auth::user()->id.'-banner-'.$request->file('thumbnail')->hashName();
            $request->file('thumbnail')->move(public_path('frontend/assets/img'), $file_name);

            $asset = new Asset();
            $asset->thumbnail = $file_name;
            $asset->content_id = $model->id;
            $asset->keterangan = "thumbnail";
            $asset->save();
        }

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
            'active' => 'required',
        ],
        [
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
        $asset = Asset::where('content_id',$model->id)->first();

        if($request->file('thumbnail')) {
            $fileName = time().'-'.Auth::user()->id.'-banner-.'.$request->file('thumbnail')->hashName();
            $request->file('thumbnail')->move(public_path('frontend/assets/img'), $fileName);

            if($asset) {
                if(file_exists(public_path('frontend/assets/img/'.$asset->thumbnail))) {
                    unlink(public_path('frontend/assets/img/'.$asset->thumbnail));
                }

                $asset_model = Asset::find($asset->id);
                $asset_model->thumbnail = $fileName;
                $asset_model->content_id = $model->id;
                $asset_model->save();
            } else {
                $asset_model = new Asset();
                $asset_model->thumbnail = $fileName;
                $asset_model->content_id = $model->id;
                $asset->keterangan = "thumbnail";
                $asset_model->save();
            }
        }

        $model->title = $request->title;
        $model->subtitle = $request->subtitle;
        $model->slug = $this->textToSlug($request->title);
        $model->short_description = $request->short_description;
        $model->content = $content;
        $model->section_id = 10;
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
        $asset = Asset::where('content_id',$model->id)->first();
        if($asset) {
            if(file_exists(public_path('frontend/assets/img/'.$asset->thumbnail))) {
                unlink(public_path('frontend/assets/img/'.$asset->thumbnail));
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
        $query = Content::leftJoin('assets as a','a.content_id','=','contents.id')
                    ->select('a.thumbnail','contents.id','contents.title','contents.subtitle','contents.short_description','contents.content')
                    ->where('contents.section_id',10)
                    ->orderBy('contents.id','desc');
        return DataTables::of($query)
            ->editColumn('thumbnail', function($model) {
                $thumbnail = '';
                if($model->thumbnail) {
                    $thumbnail = '<img src="'.asset('frontend/assets/img/'.$model->thumbnail).'" width="200px" height="75px">';
                }
                return $thumbnail;
            })
            ->addColumn('action', function ($model) {
                $string = '<div class="btn-group">';
                $string .= '<a href="' . route('administrator.banner.edit', ['id' => base64_encode($model->id)]) . '" type="button"  class="btn btn-sm btn-info" title="Edit Banner"><i class="fas fa-edit"></i></a>';
                $string .= '&nbsp;&nbsp;<a href="' . route('administrator.banner.destroy', ['id' => base64_encode($model->id)]) . '" type="button" class="btn btn-sm btn-danger btn-delete" title="Hapus Banner"><i class="fa fa-trash"></i></a>';
                $string .= '</div>';
                return $string;
            })
            ->addIndexColumn()
            ->rawColumns(['action','thumbnail'])
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
