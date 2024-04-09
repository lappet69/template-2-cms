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

class IdentitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $section = Section::where('slug', '=',request()->segment(2))->first();

        $identitas = Content::where('section_id','=',$section->id)->whereNull('deleted_at')->first();
        if($identitas) {
            $data['model'] = Content::find($identitas->id);
            $data['content'] = json_decode($data['model']->content);
        } else {
            $data['model'] = new Content();
        }
        return view('back.identitas.form', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Content();
        return view('back.identitas.form', ['model' => $model]);
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
            'nama_website' => 'required',
            'no_telp' => 'required',
            'no_wa' => 'required',
            'logo' => 'required',
            'email' => 'required',
        ],
        [
            'nama_website.required' => 'Nama Website Wajib Diisi',
            'no_telp.required' => 'No. Telp Wajib Diisi',
            'no_wa.required' => 'No. WA Wajib Diisi',
            'logo.required' => 'Logo Institusi Wajib Diisi',
            'email.required' => 'Email Wajib Diisi',
        ]);

        $section = Section::where('slug', '=',request()->segment(2))->first();

        if($request->hasFile('logo')) {
            $time = time();
            $fileName = $time.'-'.$request->logo->hashName().'-logo.'.$request->logo->extension();

            $request->logo->move(public_path('frontend/assets/img'), $fileName);
            $logo = $fileName;
        }

        $content['nama_website'] = isset($request->nama_website) ? $request->nama_website : '';
        $content['slogan'] = isset($request->slogan) ? $request->slogan : '';
        $content['email'] = isset($request->email) ? $request->email : '';
        $content['no_telp'] = isset($request->no_telp) ? $request->no_telp : '';
        $content['no_wa'] = isset($request->no_wa) ? $request->no_wa : '';
        $content['alamat_kantor'] = isset($request->alamat_kantor) ? $request->alamat_kantor : '';
        $content['logo'] = $logo;
        $content['meta_title'] = isset($request->meta_title) ? $request->meta_title : '';
        $content['meta_description'] = isset($request->meta_description) ? $request->meta_description : '';
        $content['facebook'] = isset($request->facebook) ? $request->facebook : '';
        $content['twitter'] = isset($request->twitter) ? $request->twitter : '';
        $content['youtube'] = isset($request->youtube) ? $request->youtube : '';
        $content['instagram'] = isset($request->instagram) ? $request->instagram : '';
        $content['linkedin'] = isset($request->linkedin) ? $request->linkedin : '';

        $model = new Content();

        $model->title = 'Identitas Website';
        $model->slug = $this->textToSlug($model->title.' '.$request->nama_website);
        $model->short_description = $request->short_description;
        $model->content = json_encode($content);
        $model->section_id = $section->id;
        $model->active = 1;

        if ($model->save()) {
            return redirect()->route('administrator.identitas.index')->with('alert.success', 'Identitas Baru Berhasil Tersimpan ');
        } else {
            return redirect()->route('administrator.identitas.create')->with('alert.failed', 'Something Wrong');
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
        return view('back.identitas.form', ['model' => $model]);
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
            'nama_website' => 'required',
            'no_telp' => 'required',
            'no_wa' => 'required',
            'email' => 'required',
        ],
        [
            'nama_website.required' => 'Nama Website Wajib Diisi',
            'no_telp.required' => 'No. Telp Wajib Diisi',
            'no_wa.required' => 'No. WA Wajib Diisi',
            'email.required' => 'Email Wajib Diisi',
        ]);

        $section = Section::where('slug', '=',request()->segment(2))->first();

        $id = base64_decode($id);
        $model = Content::find($id);

        $content_old = json_decode($model->content);

        if($request->hasFile('logo')) {
            if(file_exists(public_path('frontend/assets/img/'.$content_old->logo))) {
                unlink(public_path('frontend/assets/img/'.$content_old->logo));
            }

            $time = time();
            $fileName = $time.'-'.$request->logo->hashName().'-logo.'.$request->logo->extension();

            $request->logo->move(public_path('frontend/assets/img'), $fileName);
            $logo = $fileName;
        } else {
            $logo = $content_old->logo;
        }

        $content['nama_website'] = isset($request->nama_website) ? $request->nama_website : '';
        $content['slogan'] = isset($request->slogan) ? $request->slogan : '';
        $content['email'] = isset($request->email) ? $request->email : '';
        $content['no_telp'] = isset($request->no_telp) ? $request->no_telp : '';
        $content['no_wa'] = isset($request->no_wa) ? $request->no_wa : '';
        $content['alamat_kantor'] = isset($request->alamat_kantor) ? $request->alamat_kantor : '';
        $content['logo'] = $logo;
        $content['meta_title'] = isset($request->meta_title) ? $request->meta_title : '';
        $content['meta_description'] = isset($request->meta_description) ? $request->meta_description : '';
        $content['facebook'] = isset($request->facebook) ? $request->facebook : '';
        $content['twitter'] = isset($request->twitter) ? $request->twitter : '';
        $content['youtube'] = isset($request->youtube) ? $request->youtube : '';
        $content['instagram'] = isset($request->instagram) ? $request->instagram : '';
        $content['linkedin'] = isset($request->linkedin) ? $request->linkedin : '';

        $model->title = 'Identitas Website';
        $model->slug = $this->textToSlug($model->title.' '.$request->nama_website);
        $model->short_description = $request->short_description;
        $model->content = json_encode($content);
        $model->section_id = $section->id;
        $model->active = 1;

        if ($model->save()) {
            return redirect()->route('administrator.identitas.index')->with('alert.success', 'Identitas Berhasil Diperbaharui');
        } else {
            return redirect()->route('administrator.identitas.create')->with('alert.failed', 'Something Wrong');
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
        $model->deleted_at = date('Y-m-d H:i:s');
        $model->deleted_by = Auth::user()->id;
        $model->save();
    }

    public function datatable(Request $request)
    {
        $query = Content::all();
        return DataTables::of($query)
            ->addColumn('action', function ($model) {
                $string = '<div class="btn-group">';
                $string .= '<a href="' . route('administrator.identitas.edit', ['id' => base64_encode($model->id)]) . '" type="button"  class="btn btn-sm btn-info" title="Edit Identitas"><i class="fas fa-edit"></i></a>';
                $string .= '&nbsp;&nbsp;<a href="' . route('administrator.identitas.destroy', ['id' => base64_encode($model->id)]) . '" type="button" class="btn btn-sm btn-danger btn-delete" title="Hapus Identitas"><i class="fa fa-trash"></i></a>';
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
