<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Response as res;
class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.informasi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Informasi();
        return view('back.informasi.form', ['model' => $model]);
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
        ],
        [
            'title.required' => 'Title Wajib Diisi',
        ]);

        $model = new Informasi();

        $model->title = $request->title;
        $model->subtitle = $request->subtitle;
        $model->save();
    
        if ($model->save()) {
            return redirect()->route('administrator.informasi.index')->with('alert.success', 'Informasi Berhasil Tersimpan');
        } else {
            return redirect()->route('administrator.informasi.create')->with('alert.failed', 'Something Wrong');
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
        $model = Informasi::find($id);
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
        $model = Informasi::find($id);
        return view('back.informasi.form', ['model' => $model]);
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
            'title' => 'Title Wajib Diisi',
        ]);

        $id = base64_decode($id);
        $model = Informasi::find($id);

        $model->title = $request->title;
        $model->subtitle = $request->subtitle;
        $model->save();

        if ($model->save()) {
            return redirect()->route('administrator.informasi.index')->with('alert.success', 'Informasi telah Diperbaharui');
        } else {
            return redirect()->route('administrator.informasi.create')->with('alert.failed', 'Something Wrong');
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
        $model = Informasi::find($id);
        $model->deleted_at = date('Y-m-d H:i:s');
        $model->deleted_by = Auth::user()->id;
        $model->save();
    }

    public function datatable(Request $request)
    {
        $query = Informasi::all();
        return DataTables::of($query)
            ->addColumn('action', function ($model) {
                $string = '<div class="btn-group">';
                $string .= '<a href="' . route('administrator.informasi.edit', ['id' => base64_encode($model->id)]) . '" type="button"  class="btn btn-sm btn-info" title="Edit Informasi"><i class="fas fa-edit"></i></a>';
                $string .= '&nbsp;&nbsp;<a href="' . route('administrator.informasi.destroy', ['id' => base64_encode($model->id)]) . '" type="button" class="btn btn-sm btn-danger btn-delete" title="Hapus Informasi"><i class="fa fa-trash"></i></a>';
                $string .= '</div>';
                return
                    $string;
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getInformasi(Request $request)
    {
        $id = $request->informasiId;
        $informasi = Informasi::all();
        $html = '<option value="">Pilih Informasi</option>';
        foreach($informasi as $info) {
            $selected = $info->id == $id ? 'selected' : '';
            $html .= '<option value="'.$info->id.'" '.$selected.'>'.$info->title.'</option>';
        }
        return response()->json($html);
    }

    public function data(Request $request)
    {
        // $id = trim($request->q);

        $datas = Informasi::all();
        foreach ($datas as $data) {
            // $selected = $data->id == $id ? true : false;
            $res[] = ['id' => $data->id, 'text' => $data->title];
        }
        return response()->json($res);
    }
}