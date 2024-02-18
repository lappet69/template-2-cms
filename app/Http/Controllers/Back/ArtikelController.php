<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Asset;
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

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.artikel.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Artikel();
        return view('back.artikel.form', ['model' => $model]);
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
            'content' => 'required',
            'gambar.*'      => 'required|mimes:jpeg,bmp,png,gif,svg,pdf,jpg|max:20480',
            'active' => 'required',
        ],
        [
            'title.required' => 'Judul Artikel Wajib Diisi',
            'content.required' => 'Konten Artikel Wajib Diisi',
            'gambar.required' => 'File Gambar Wajib Dilampirkan',
            'active.required' => 'Keterangan Wajib Diisi'
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

        $section = Section::where('slug',request()->segment(2))->first();
    

        $model = new Content();

        $model->title = $request->title;
        $model->subtitle = $request->subtitle;
        $model->slug = $this->textToSlug($request->title);
        $model->short_description = $request->short_description;
        $model->content = $content;
        $model->section_id = $section->id;
        $model->active = $request->active;
        $model->save();
        
        if($request->file('gambar')) {
            foreach($request->file('gambar') as $key => $file) {
                $fileName =  time().'-'.Auth::user()->id.'-artikel-'.$file->hashName();
                $file->move(public_path('front/assets/img'), $fileName);

                $asset = new Asset();
                $asset->thumbnail = $fileName;
                $asset->content_id = $model->id;
                $asset->keterangan = $request->keterangan[$key];
                $asset->save();
            }
            // $request->image->move(public_path('front/assets/img'), $fileName);
            // $model->thumbnail = $fileName;
        }

        // if($request->hasFile('background_image')) {
        //     foreach($request->file('background_image') as $key => $file) {
        //         $fileName = time().'-'.Auth::user()->id.'-bg-artikel.'.$file->hashName();
        //         $file->move(public_path('front/assets/img'), $fileName);

        //         $asset = new Asset();
        //         $asset->thumbnail = $fileName;
        //         $asset->content_id = $model->id;
        //         $asset->keterangan = $request->keterangan[$key];
        //         $asset->save();
        //     }

        //     $model->background_image = $fileName;
        // }

        
    
        // dd($content);

        if ($model->save()) {
            return redirect()->route('administrator.artikel.index')->with('alert.success', 'Artikel Has Been Saved');
        } else {
            return redirect()->route('administrator.artikel.create')->with('alert.failed', 'Something Wrong');
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
        $model = Artikel::find($id);
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
        return view('back.artikel.form', ['model' => $model]);
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
            'content' => 'required',
        ],
        [
            'title' => 'Judul Artikel Wajib Diisi',
            'content' => 'Konten Artikel Wajib Diisi',
        ]);

        $content = $request->content;
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
        
        // $files = $request->file('image');
        // if ($files) {
        //     $hashName = $files->hashName();
        //     $folderName = 'artikel';
        //     $fileName = $hashName;
        //     $file = storage_path() . '/app/artikel/' . $hashName;
        //     if (file_exists($file)) {
        //         Storage::delete($folderName . '/' . $fileName);
        //     }
        //     $files->store($folderName);
        //     // Storage::move($folderName . '/' . $hashName, $folderName . '/' . $fileName);

        //     // Storage::move('uploads/'.$filename, $file);
        //     $model->image = $hashName;
        // }

        $id = base64_decode($id);
        $model = Content::find($id);

        $model->title = $request->title;
        $model->subtitle = $request->subtitle;
        $model->slug = $this->textToSlug($request->title);
        $model->short_description = $request->short_description;
        $model->content = $content;
        $model->section_id = 2;
        $model->active = $request->active;
        $model->save();

        if($request->file('gambar')) {
            foreach($request->file('gambar') as $key => $file) {
                $asset = Asset::where('content_id',$model->id)->where('keterangan',$request->keterangan[$key])->first();

                if(file_exists(public_path('front/assets/img/'.$asset->thumbnail))) {
                    unlink(public_path('front/assets/img/'.$asset->thumbnail));
                }
                
                $time = time();
                $fileName =  $time.'-'.Auth::user()->id.'-artikel-'.$file->hashName();
                $file->move(public_path('front/assets/img'), $fileName);

                $asset_model = Asset::find($asset->id);
                $asset_model->thumbnail = $fileName;
                $asset_model->keterangan = $request->keterangan[$key];
                $asset_model->save();
            }

            // $time = time();
            // $fileName = $time.'-'.Auth::user()->id.'-bg-artikel.'.$request->background_image->extension();

            // $request->background_image->move(public_path('front/assets/img'), $fileName);
            // $model->background_image = $fileName;
        }

        // if($request->hasFile('image')) {
        //     if(file_exists(public_path('front/assets/img/'.$model->thumbnail))) {
        //         unlink(public_path('front/assets/img/'.$model->thumbnail));
        //     }

        //     $time = time();
        //     $fileName = $time.'-'.Auth::user()->id.'-artikel.'.$request->image->extension();

        //     $request->image->move(public_path('front/assets/img'), $fileName);
        //     $model->thumbnail = $fileName;
        // }
        
        

        if ($model->save()) {
            return redirect()->route('administrator.artikel.index')->with('alert.success', 'Artikel Has Been Updated');
        } else {
            return redirect()->route('administrator.artikel.create')->with('alert.failed', 'Something Wrong');
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
        $query = Content::where('section_id','=',2)->orderBy('id','asc');
        return DataTables::of($query)
            ->addColumn('action', function ($model) {
                $string = '<div class="btn-group">';
                $string .= '<a href="' . route('administrator.artikel.edit', ['id' => base64_encode($model->id)]) . '" type="button"  class="btn btn-sm btn-info" title="Edit Artikel"><i class="fas fa-edit"></i></a>';
                $string .= '&nbsp;&nbsp;<a href="' . route('administrator.artikel.destroy', ['id' => base64_encode($model->id)]) . '" type="button" class="btn btn-sm btn-danger btn-delete" title="Remove"><i class="fa fa-trash"></i></a>';
                $string .= '</div>';
                return $string;
            })
            ->addColumn('informasi', function ($model) {
                $string = 'informasi';
                return $string;
            })
            ->addColumn('value_program', function ($model) {
                $string = 'value program';
                return $string;
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
