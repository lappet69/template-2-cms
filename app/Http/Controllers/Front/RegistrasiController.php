<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Registrasi;
use App\Models\Informasi;
use App\Models\Kuesioner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response as res;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Protection;

class RegistrasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['program'] = Content::where('section_id',3)->get();
        $data['kuesioner'] = Kuesioner::where('active',1)->get();
        return view('front.registrasi',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['model'] = new Registrasi();
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
            'program_id' => 'required',
            'course_type' => 'required',
            'nama_ktp' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'no_wa' => 'required',
            'kota_domisili' => 'required',
            'alamat' => 'required',
        ],
        [
            'program_id.required' => 'Program Wajib Diisi', 
            'course_type.required' => 'Program Wajib Diisi Terlebih Dahulu', 
            'nama_ktp.required' => 'Nama Lengkap Wajib Diisi', 
            'email.required' => 'Email Wajib Diisi', 
            'gender.required' => 'Jenis Kelamin Wajib Diisi', 
            'dob.required' => 'Tanggal Lahir Wajib Diisi', 
            'no_wa.required' => 'No. HP Wajib Diisi', 
            'kota_domisili.required' => 'Kota Domisili Wajib Diisi', 
            'alamat.required' => 'Alamat Wajib Diisi', 
        ]);
        
        // dd($request->all());

        $kuesioner_result = [];

        $kuesioner = Kuesioner::where('active',1)->get();
        foreach($kuesioner as $key => $value) {
            if($request->has("jawaban$value->id")) {
                $kuesioner_result[] = [
                    'pertanyaan' => $request->get("pertanyaan$value->id"),
                    'jawaban' => $request->get("jawaban$value->id")
                ];
            }
        }

        $model = new Registrasi();
        $model->course_id = $request->course_type;
        $model->program_id = $request->program_id;
        $model->nama_ktp = $request->nama_ktp;
        $model->email = $request->email;
        $model->gender = $request->gender;
        $model->dob = $request->dob;
        $model->no_wa = $request->no_wa;
        $model->kota_domisili = $request->kota_domisili;
        $model->alamat = $request->alamat;
        $model->kuesioner = json_encode($kuesioner_result);

        // echo json_encode($model);
        // dd($model);

        if ($model->save()) {
            return redirect()->route('index')->with('alert.success', 'Registrasi Berhasil');
        } else {
            return redirect()->route('index')->with('alert.failed', 'Something Wrong');
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
        $model = Registrasi::find($id);
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
        // $data['model'] = Content::find($id);
        
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
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
    }

    public function datatable(Request $request)
    {
        
    }

    private function textToSlug($text='') {
       
    }
}
