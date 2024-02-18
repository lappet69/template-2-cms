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

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.asset.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['content'] = Content::orderBy('section_id','asc')->get();
        $data['model'] = new Asset();
        return view('back.asset.form', $data);
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
            'content_id' => 'required',
        ],
        [
            'thumbnail.required' => 'File Asset Wajib Dilampirkan',
            'content_id.required' => 'ID Konten Wajib Diisi',
        ]);

        $model = new Asset();

        if($request->hasFile('thumbnail')) {
            $time = time();
            $fileName = $time.'-'.Auth::user()->id.'-asset.'.$request->img->extension();

            $request->img->move(public_path('front/assets/img'), $fileName);
            $model->thumbnail = $fileName;
        }

        $model->content_id = $request->content_id;
        $model->save();
    
        if ($model->save()) {
            return redirect()->route('administrator.asset.index')->with('alert.success', 'Asset Baru Berhasil Tersimpan');
        } else {
            return redirect()->route('administrator.asset.create')->with('alert.failed', 'Something Wrong');
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
        $data['content'] = Content::orderBy('section_id','asc')->get();
        $data['model'] = Asset::find($id);
        return view('back.asset.form', $data);
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
            'content' => 'required',
        ],
        [
            'content.required' => 'ID Konten Diisi',
        ]);

        $id = base64_decode($id);
        $model = Content::find($id);

        if($request->hasFile('thumbnail')) {
            if(file_exists(public_path('front/assets/img/'.$model->thumbnail))) {
                unlink(public_path('front/assets/img/'.$model->thumbnail));
            }

            $time = time();
            $fileName = $time.'-'.Auth::user()->id.'-asset.'.$request->img->extension();

            $request->img->move(public_path('front/assets/img'), $fileName);
            $model->thumbnail = $fileName;
        }

        $model->content_id = $request->content_id;
        $model->save();

        if ($model->save()) {
            return redirect()->route('administrator.asset.index')->with('alert.success', 'Asset telah Diperbaharui');
        } else {
            return redirect()->route('administrator.asset.create')->with('alert.failed', 'Something Wrong');
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
        $model->deleted_at = date('Y-m-d H:i:s');
        $model->deleted_by = Auth::user()->id;
        $model->save();
    }

    public function datatable(Request $request)
    {
        $query = Asset::orderBy('id','asc');
        return DataTables::of($query)
            // ->editColumn('thumbnail', function($model) {
            //     $string = '<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#showBanner" title="Lihat Banner">'.$model->thumbnail.'</a>';
            //     return $string;
            // })
            ->addColumn('action', function ($model) {
                $string = '<div class="btn-group">';
                $string .= '<a href="' . route('administrator.asset.edit', ['id' => base64_encode($model->id)]) . '" type="button"  class="btn btn-sm btn-info" title="Edit Asset"><i class="fas fa-edit"></i></a>';
                $string .= '&nbsp;&nbsp;<a href="' . route('administrator.asset.destroy', ['id' => base64_encode($model->id)]) . '" type="button" class="btn btn-sm btn-danger btn-delete" title="Hapus Asset"><i class="fa fa-trash"></i></a>';
                $string .= '</div>';
                return
                    $string;
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }
}
