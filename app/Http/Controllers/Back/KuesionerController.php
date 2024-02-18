<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Jawaban;
use App\Models\Kuesioner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Response as res;

class KuesionerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.kuesioner.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Kuesioner();
        return view('back.kuesioner.form', ['model' => $model]);
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
            'pertanyaan' => 'required',
            'active' => 'required',
        ],
        [
            'pertanyaan.required' => 'Pertanyaan Wajib Diisi',
            'active.required' => 'Keterangan Wajib Diisi'
        ]);

        $model = new Kuesioner();
        $model->pertanyaan = $request->pertanyaan;
        $model->opsi_jawaban = json_encode($request->jawaban);
        $model->active = $request->active;
        $model->save();

        // foreach ($request->jawaban as $key => $value) {
        //     Jawaban::create([
        //         'id_pertanyaan' => $model->id,
        //         'jawaban' => $request->jawaban[$key],
        //     ]);
        // }
    
        if ($model->save()) {
            return redirect()->route('administrator.kuesioner.index')->with('alert.success', 'Kuesioner Berhasil Tersimpan');
        } else {
            return redirect()->route('administrator.kuesioner.create')->with('alert.failed', 'Something Wrong');
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
        $model = Kuesioner::find($id);
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
        $model = Kuesioner::find($id);
        return view('back.kuesioner.form', ['model' => $model]);
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
            'pertanyaan' => 'required',
            'active' => 'required',
        ],
        [
            'pertanyaan.required' => 'Pertanyaan Wajib Diisi',
            'active.required' => 'Keterangan Wajib Diisi'
        ]);

        $id = base64_decode($id);
        $model = Kuesioner::findOrFail($id);
        $model->pertanyaan = $request->pertanyaan;
        $model->opsi_jawaban = json_encode($request->jawaban);
        $model->active = $request->active;
        

        // foreach ($request->id as $key => $value) {
        //     $ids = $request->id[$key];
        //     $jawaban = Jawaban::find($ids);

        //     if($jawaban) {
        //         Jawaban::where('id', $ids)
        //             ->update(['jawaban' => $request->jawaban[$key]]);
        //     } else {
        //         Jawaban::create([
        //             'id_pertanyaan' => $id,
        //             'jawaban' => $request->jawaban[$key],
        //         ]);
        //     }
        // }

        if ($model->save()) {
            return redirect()->route('administrator.kuesioner.index')->with('alert.success', 'Kuesioner telah Diperbaharui');
        } else {
            return redirect()->route('administrator.kuesioner.create')->with('alert.failed', 'Something Wrong');
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
        $model = Kuesioner::find($id);
        $model->deleted_at = date('Y-m-d H:i:s');
        $model->deleted_by = Auth::user()->id;
        $model->save();
    }

    public function datatable(Request $request)
    {
        $query = Kuesioner::orderBy('id','asc');
        return DataTables::of($query)
            ->addColumn('action', function ($model) {
                $string = '<div class="btn-group">';
                $string .= '<a href="' . route('administrator.kuesioner.edit', ['id' => base64_encode($model->id)]) . '" type="button"  class="btn btn-sm btn-info" title="Edit Kuesioner"><i class="fas fa-edit"></i></a>';
                $string .= '&nbsp;&nbsp;<a href="' . route('administrator.kuesioner.destroy', ['id' => base64_encode($model->id)]) . '" type="button" class="btn btn-sm btn-danger btn-delete" title="Hapus Kuesioner"><i class="fa fa-trash"></i></a>';
                $string .= '</div>';
                return $string;
            })
            ->addColumn('jawaban', function($model) {
                $opsi = json_decode($model->opsi_jawaban, true);
                $string = '<ul>';
                foreach($opsi as $j) {
                    $string .= '<li>'.$j.'</li>';
                }
                return $string;
            })
            ->addIndexColumn()
            ->rawColumns(['action','jawaban'])
            ->make(true);
    }
}