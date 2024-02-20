<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Content;
use App\Models\Section;
use App\Services\Content as ServicesContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response as res;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Protection;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.client.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['model'] = new Content();
        return view('back.client.form', $data);
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
        ],
        [
            'title.required' => 'Nama Client Wajib Diisi',
            'gambar.required' => 'File Gambar Wajib Dilampirkan',
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
                $time = time();
                $fileName = $time.'-'.Auth::user()->id.'-client-'.$file->hashName();
                $file->move(public_path('front/assets/img'), $fileName);

                $asset = new Asset();
                $asset->thumbnail = $fileName;
                $asset->content_id = $model->id;
                $asset->keterangan = $request->keterangan[$key];
                $asset->save();
            }
        }

        if ($model->save()) {
            return redirect()->route('administrator.client.index')->with('alert.success', 'Client Berhasil Disimpan');
        } else {
            return redirect()->route('administrator.client.create')->with('alert.failed', 'Something Wrong');
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
        return view('back.client.form', ['model' => $model]);
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
        ],
        [
            'title' => 'Nama Client Wajib Diisi',
        ]);

        $id = base64_decode($id);
        $model = Content::find($id);

        if($request->hasFile('thumbnail')) {
            if(file_exists(public_path('front/assets/img/'.$model->thumbnail))) {
                unlink(public_path('front/assets/img/'.$model->thumbnail));
            }

            $time = time();
            $fileName = $time.'-'.Auth::user()->id.'-client.'.$request->thumbnail->extension();

            $request->thumbnail->move(public_path('front/assets/img'), $fileName);
            $model->thumbnail = $fileName;
        }
        
        $model->title = $request->title;
        $model->slug = $this->textToSlug($request->title);
        $model->section_id = 7;
        $model->active = $request->active;

        if ($model->save()) {
            return redirect()->route('administrator.client.index')->with('alert.success', 'Client telah Diperbaharui');
        } else {
            return redirect()->route('administrator.client.create')->with('alert.failed', 'Something Wrong');
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
        $model = Asset::find($id);
        
        if(file_exists(public_path('front/assets/img/'.$model->thumbnail))) {
            unlink(public_path('front/assets/img/'.$model->thumbnail));
        }

        $content = Content::find($model->content_id);
        $content->deleted_at = date('Y-m-d H:i:s');
        $content->deleted_by = Auth::user()->id;
        $content->save();
        
        $model->deleted_at = date('Y-m-d H:i:s');
        $model->deleted_by = Auth::user()->id;
        $model->save();
    }

    public function datatable(Request $request)
    {
        $section = Section::where('slug',request()->segment(2))->first();

        $query = ServicesContent::listClient($section->id);
        return DataTables::of($query)
            ->addColumn('action', function ($model) {
                $string = '<div class="btn-group">';
                // $string .= '<a href="' . route('administrator.client.edit', ['id' => base64_encode($model->id)]) . '" type="button"  class="btn btn-sm btn-info" title="Edit Client"><i class="fas fa-edit"></i></a>';
                $string .= '&nbsp;&nbsp;<a href="' . route('administrator.client.destroy', ['id' => base64_encode($model->id)]) . '" type="button" class="btn btn-sm btn-danger btn-delete" title="Hapus Client"><i class="fa fa-trash"></i></a>';
                $string .= '</div>';
                return $string;
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
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
