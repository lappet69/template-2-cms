<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response as res;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Protection;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.promo.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['model'] = new Content();
        return view('back.promo.form', $data);
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
            'thumbnail'      => 'required|mimes:jpeg,bmp,png,gif,svg,pdf,jpg|max:20480',
        ],
        [
            'title.required' => 'Nama Promo Wajib Diisi',
            'thumbnail.required' => 'File Gambar Wajib Dilampirkan',
        ]);

        $model = new Content();
        if($request->hasFile('thumbnail')) {
            $time = time();
            $fileName = $time.'-'.Auth::user()->id.'-promo.'.$request->thumbnail->extension();

            $request->thumbnail->move(public_path('front/assets/img'), $fileName);
            $model->thumbnail = $fileName;
        }

        $model->title = $request->title;
        $model->slug = $this->textToSlug($request->title);
        $model->section_id = 9;
        $model->active = $request->active;
        $model->save();
        if ($model->save()) {
            return redirect()->route('administrator.promo.index')->with('alert.success', 'Promo telah Disimpan');
        } else {
            return redirect()->route('administrator.promo.create')->with('alert.failed', 'Something Wrong');
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
        
        return view('back.promo.form', $data);
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
            'title' => 'Nama Promo Wajib Diisi',
        ]);

        $id = base64_decode($id);
        $model = Content::find($id);

        if($request->hasFile('thumbnail')) {
            if(file_exists(public_path('front/assets/img/'.$model->thumbnail))) {
                unlink(public_path('front/assets/img/'.$model->thumbnail));
            }

            $time = time();
            $fileName = $time.'-'.Auth::user()->id.'-promo.'.$request->thumbnail->extension();

            $request->thumbnail->move(public_path('front/assets/img'), $fileName);
            $model->thumbnail = $fileName;
        }
        
        $model->title = $request->title;
        $model->slug = $this->textToSlug($request->title);
        $model->section_id = 9;
        $model->active = $request->active;

        if ($model->save()) {
            return redirect()->route('administrator.promo.index')->with('alert.success', 'Promo telah Diperbaharui');
        } else {
            return redirect()->route('administrator.promo.create')->with('alert.failed', 'Something Wrong');
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
        if(file_exists(public_path('front/assets/img/'.$model->thumbnail))) {
            unlink(public_path('front/assets/img/'.$model->thumbnail));
        }
        $model->deleted_at = date('Y-m-d H:i:s');
        $model->deleted_by = Auth::user()->id;
        $model->save();
    }

    public function datatable(Request $request)
    {
        $query = Content::where('section_id',9);
        return DataTables::of($query)
            ->addColumn('action', function ($model) {
                $string = '<div class="btn-group">';
                $string .= '<a href="' . route('administrator.promo.edit', ['id' => base64_encode($model->id)]) . '" type="button"  class="btn btn-sm btn-info" title="Edit Promo"><i class="fas fa-edit"></i></a>';
                $string .= '&nbsp;&nbsp;<a href="' . route('administrator.promo.destroy', ['id' => base64_encode($model->id)]) . '" type="button" class="btn btn-sm btn-danger btn-delete" title="Hapus Promo"><i class="fa fa-trash"></i></a>';
                $string .= '</div>';
                return
                    $string;
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
