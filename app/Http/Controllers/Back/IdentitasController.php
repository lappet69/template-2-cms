<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Identitas;
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
        return view('back.identitas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Identitas();
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
            'alamat_kantor' => 'required',
            'no_telp' => 'required',
            'no_wa' => 'required',
            'email' => 'required',
            'active' => 'required',
        ],
        [
            'nama_website.required' => 'Nama Website Wajib Diisi',
            'alamat_kantor.required' => 'Alamat Kantor Wajib Diisi',
            'no_telp.required' => 'No. Telp Wajib Diisi',
            'no_wa.required' => 'No. WA Wajib Diisi',
            'email.required' => 'Email Wajib Diisi',
            'active.required' => 'Keterangan Wajib Diisi',
        ]);

        $model = new Identitas();

        $model->nama_website = $request->nama_website;
        $model->nama_gedung = $request->nama_gedung;
        $model->alamat_kantor = $request->alamat_kantor;
        $model->no_telp = $request->no_telp;
        $model->no_wa = $request->no_wa;
        $model->email = $request->email;
        $model->facebook = $request->facebook;
        $model->instagram = $request->instagram;
        $model->linkedin = $request->linkedin;
        $model->active = $request->active;

        if($request->hasFile('img_address_1')) {
            $time = time();
            $fileName = $time.'-'.$request->img_address_1->hashName().'-address.'.$request->img_address_1->extension();

            $request->img_address_1->move(public_path('front/assets/img'), $fileName);
            $model->img_address_1 = $fileName;
        }

        if($request->hasFile('img_address_2')) {
            $time = time();
            $fileName = $time.'-'.$request->img_address_2->hashName().'-address.'.$request->img_address_2->extension();

            $request->img_address_2->move(public_path('front/assets/img'), $fileName);
            $model->img_address_2 = $fileName;
        }

        if($request->hasFile('img_address_3')) {
            $time = time();
            $fileName = $time.'-'.$request->img_address_3->hashName().'-address.'.$request->img_address_3->extension();

            $request->img_address_3->move(public_path('front/assets/img'), $fileName);
            $model->img_address_3 = $fileName;
        }

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
        $model = Identitas::find($id);
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
        $model = Identitas::find($id);
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
            'alamat_kantor' => 'required',
            'no_telp' => 'required',
            'no_wa' => 'required',
            'email' => 'required',
            'active' => 'required',
        ],
        [
            'nama_website.required' => 'Nama Website Wajib Diisi',
            'alamat_kantor.required' => 'Alamat Kantor Wajib Diisi',
            'no_telp.required' => 'No. Telp Wajib Diisi',
            'no_wa.required' => 'No. WA Wajib Diisi',
            'email.required' => 'Email Wajib Diisi',
            'active.required' => 'Keterangan Wajib Diisi',
        ]);

        $id = base64_decode($id);
        $model = Identitas::find($id);

        $model->nama_website = $request->nama_website;
        $model->nama_gedung = $request->nama_gedung;
        $model->alamat_kantor = $request->alamat_kantor;
        $model->no_telp = $request->no_telp;
        $model->no_wa = $request->no_wa;
        $model->email = $request->email;
        $model->facebook = $request->facebook;
        $model->instagram = $request->instagram;
        $model->linkedin = $request->linkedin;
        $model->active = $request->active;

        if($request->hasFile('img_address_1')) {
            if(file_exists(public_path('front/assets/img/'.$model->img_address_1))) {
                unlink(public_path('front/assets/img/'.$model->img_address_1));
            }

            $time = time();
            $fileName = $time.'-'.Auth::user()->id.'-address.'.$request->img_address_1->extension();

            $request->img_address_1->move(public_path('front/assets/img'), $fileName);
            $model->img_address_1 = $fileName;
        }

        if($request->hasFile('img_address_2')) {
            if(file_exists(public_path('front/assets/img/'.$model->img_address_2))) {
                unlink(public_path('front/assets/img/'.$model->img_address_2));
            }

            $time = time();
            $fileName = $time.'-'.Auth::user()->id.'-address.'.$request->img_address_2->extension();

            $request->img_address_2->move(public_path('front/assets/img'), $fileName);
            $model->img_address_2 = $fileName;
        }

        if($request->hasFile('img_address_3')) {
            if(file_exists(public_path('front/assets/img/'.$model->img_address_3))) {
                unlink(public_path('front/assets/img/'.$model->img_address_3));
            }

            $time = time();
            $fileName = $time.'-'.Auth::user()->id.'-address.'.$request->img_address_3->extension();

            $request->img_address_3->move(public_path('front/assets/img'), $fileName);
            $model->img_address_3 = $fileName;
        }

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
        $model = Identitas::find($id);
        $model->deleted_at = date('Y-m-d H:i:s');
        $model->deleted_by = Auth::user()->id;
        $model->save();
    }

    public function datatable(Request $request)
    {
        $query = Identitas::all();
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
}
