<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Registrasi;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response as res;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class RegistrasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.registrasi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Registrasi();
        return view('back.registrasi.form', ['model' => $model]);
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
            'image'      => 'required|mimes:jpeg,bmp,png,gif,svg,pdf,jpg|max:20480',
            'active' => 'required',
        ],
        [
            'title.required' => 'Judul Artikel Wajib Diisi',
            'content.required' => 'Konten Artikel Wajib Diisi',
            'image.required' => 'File Gambar Wajib Dilampirkan',
            'active.required' => 'Keterangan Wajib Diisi'
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

        $model = new Registrasi();
        if($request->hasFile('image')) {
            $time = time();
            $fileName = $time.'-'.Auth::user()->id.'-artikel.'.$request->image->extension();

            $request->image->move(public_path('front/assets/img'), $fileName);
            $model->thumbnail = $fileName;
        }

        $model->title = $request->title;
        $model->subtitle = $request->subtitle;
        $model->slug = $this->textToSlug($request->title);
        $model->short_description = $request->short_description;
        $model->content = $content;
        // $model->category_id = $request->category_id;
        $model->section_id = 2;
        $model->active = $request->active;
        $model->save();
    
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
        $model = Registrasi::find($id);
        return view('back.registrasi.form', ['model' => $model]);
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
        $model = Registrasi::find($id);

        if($request->hasFile('image')) {
            if(file_exists(public_path('front/assets/img/'.$model->thumbnail))) {
                unlink(public_path('front/assets/img/'.$model->thumbnail));
            }

            $time = time();
            $fileName = $time.'-'.Auth::user()->id.'-artikel.'.$request->image->extension();

            $request->image->move(public_path('front/assets/img'), $fileName);
            $model->thumbnail = $fileName;
        }
        
        $model->title = $request->title;
        $model->subtitle = $request->subtitle;
        $model->short_description = $request->short_description;
        $model->content = $content;
        $model->section_id = 2;
        $model->active = $request->active;

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
        $model = Registrasi::find($id);
        if(file_exists(public_path('front/assets/img/'.$model->thumbnail))) {
            unlink(public_path('front/assets/img/'.$model->thumbnail));
        }
        $model->deleted_at = date('Y-m-d H:i:s');
        $model->deleted_by = Auth::user()->id;
        $model->save();
    }

    public function datatable(Request $request)
    {
        $query = Registrasi::all();
        return DataTables::of($query)
            ->addColumn('action', function ($model) {
                $string = '<div class="btn-group">';
                $string .= '<a href="' . route('administrator.artikel.edit', ['id' => base64_encode($model->id)]) . '" type="button"  class="btn btn-sm btn-info" title="Edit Artikel"><i class="fas fa-edit"></i></a>';
                $string .= '&nbsp;&nbsp;<a href="' . route('administrator.artikel.destroy', ['id' => base64_encode($model->id)]) . '" type="button" class="btn btn-sm btn-danger btn-delete" title="Remove"><i class="fa fa-trash"></i></a>';
                $string .= '</div>';
                return $string;
            })
            
            ->editColumn('program_id', function ($model) {
                $string = $model->program->title;
                return $string;
            })
            ->editColumn('course_id', function ($model) {
                $string = $model->course->title;
                return $string;
            })
            ->editColumn('dob', function ($model) {
                $string = sqlindo_date($model->dob);
                return $string;
            })
            ->editColumn('kuesioner', function ($model) {
                $string = '';
                if($model->kuesioner) {
                    $kuesioner = json_decode($model->kuesioner);
                    $string = '<ul>';
                    foreach($kuesioner as $kues) {
                        $string .= '<li>'.$kues->pertanyaan.' : <b>'.$kues->jawaban.'</b></li>';
                    }
                    $string .= '</ul>';
                }
                return $string;
            })
            ->addIndexColumn()
            ->rawColumns(['action','program_id','course_id','dob','kuesioner'])
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

    public function exportRegistrasi($tanggal)
    {
        $tanggal = explode(' sd ', urldecode($tanggal));
        $start = tanggalDb($tanggal[0]).' 00:00:00';
        $end = tanggalDb($tanggal[1]).' 23:59:59';

        $data = Registrasi::whereBetween('created_at', [$start, $end])->get();

        // dd($data);
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'Gender');
        $sheet->setCellValue('E1', 'Birthday');
        $sheet->setCellValue('F1', 'No. WA');
        $sheet->setCellValue('G1', 'Kota Domisili');
        $sheet->setCellValue('H1', 'Alamat');
        $sheet->setCellValue('I1', 'Program');
        $sheet->setCellValue('J1', 'Course');
        $norow = 2;
        $no = 1;
        
        foreach ($data as $key => $item) {

            $sheet->setCellValue('A' . $norow, $no);
            $sheet->setCellValue('B' . $norow, $item->nama_ktp);
            $sheet->setCellValue('C' . $norow, $item->email);
            $sheet->setCellValue('D' . $norow, $item->gender);
            $sheet->setCellValue('E' . $norow, $item->dob);
            $sheet->setCellValue('F' . $norow, $item->no_wa);
            $sheet->setCellValue('G' . $norow, $item->kota_domisili);
            $sheet->setCellValue('H' . $norow, $item->alamat);
            $sheet->setCellValue('I' . $norow, $item->program->title);
            $sheet->setCellValue('J' . $norow, $item->course->title);
            $norow++;
            $no++;
        }

        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Daftar Registrasi ' . $tanggal[0] . ' - ' . $tanggal[1] . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
