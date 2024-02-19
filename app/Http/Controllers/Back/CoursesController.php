<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Content;
use App\Models\Informasi;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response as res;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Protection;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.courses.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['model'] = new Content();
        $section = Section::where('slug',request()->segment(2))->first();
        $data['program'] = Content::where('section_id','=',$section->parent_section_id)->where('active',1)->get();
        $data['informasi'] = Informasi::all();
        return view('back.courses.form', $data);
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
            'active' => 'required',
        ],
        [
            'title.required' => 'Judul Artikel Wajib Diisi',
            'gambar.required' => 'File Gambar Wajib Dilampirkan',
            'active.required' => 'Keterangan Wajib Diisi'
        ]);

        // dd($request->all());
        
        $time_id = $request->id;

        $title = isset($time_id) ? array_values(array_unique($time_id)) : [];
        $jumlah_title = count($title);
        $content_title = $request->content_title;
        $content_title = isset($content_title) ? array_values(array_unique($content_title)) : [];

        $sub_konten_array = [];
        
        for ($i=0; $i < $jumlah_title; $i++) {
            $sub_konten_data = [];
            // echo $request->sub_konten_index[$i];
            // $index = $request->sub_konten_index[$i];
            // echo $index."<br>";
            for ($j=0; $j < count($request->sub_content_index[$title[$i]]); $j++) { 
                $sub_konten_data[] = [
                    "sub_konten_index" => $request->sub_content_index[$title[$i]][$j],
                    "sub_konten_title" => $request->sub_content_title[$title[$i]][$j],
                    "sub_konten_image" => $request->sub_content_upload_image[$title[$i]][$j],
                    "sub_konten_description" => $request->sub_content_short_description[$title[$i]][$j]
                ];
            }

            $konten_data = [
                "konten_index" => $title[$i],
                "konten_title" => $content_title[$i],
                "konten_description" => $sub_konten_data
            ];
            // // Tambahkan data konten ke array sub_konten_array
            $sub_konten_array[] = $konten_data;
        }

        // Kumpulkan data sub_konten ke dalam array
        $data_array = [
            "sub_konten" => $sub_konten_array
        ];

        $content = isset($sub_konten_array) ? json_encode($data_array) : null;

        $section = Section::where('slug',request()->segment(2))->first();
        
        $model = new Content();

        $model->title = $request->title;
        $model->subtitle = $request->subtitle;
        $model->slug = $this->textToSlug($request->title);
        $model->short_description = $request->short_description;
        $model->content = $content;
        $model->section_id = $section->id;
        $model->parent_content_id = $request->program;
        $model->active = $request->active;
        $model->save();

        if($request->file('gambar')) {
            foreach($request->file('gambar') as $key => $file) {
                $time = time();
                $fileName = $time.'-'.Auth::user()->id.'-course-'.$file->hashName();
                $file->move(public_path('front/assets/img'), $fileName);

                $asset = new Asset();
                $asset->thumbnail = $fileName;
                $asset->content_id = $model->id;
                $asset->keterangan = $request->keterangan[$key];
                $asset->save();
            }
        }

        if ($model->save()) {
            return redirect()->route('administrator.courses.index')->with('alert.success', 'Courses Telah Berhasil Disimpan');
        } else {
            return redirect()->route('administrator.courses.create')->with('alert.failed', 'Something Wrong');
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
        $data['program'] = Content::where('section_id','=',3)->where('active',1)->get();
        $data['informasi'] = Informasi::all();
        
        return view('back.courses.form', $data);
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
            'active' => 'required',
        ],
        [
            'title' => 'Judul Artikel Wajib Diisi',
            'active.required' => 'Keterangan Wajib Diisi'
        ]);

        // dd($request->all());

        // $content_index = $request->id;
        $content_index = isset($request->id) && is_array($request->id) ? array_values(array_unique($request->id)) : [];
        $jumlah_title = count($content_index);

        $content_title = $request->content_title;
        $content_title = isset($content_title) ? array_values(array_unique($content_title)) : [];
       
        $sub_konten_array = [];

        for($i  = 0; $i < $jumlah_title; $i++) {
            $sub_konten_data = [];

            for ($j=0; $j < count($request->sub_content_index[$content_index[$i]]); $j++) { 
                $sub_konten_data[] = [
                    'sub_konten_index' => $request->sub_content_index[$content_index[$i]][$j],
                    'sub_konten_title' => $request->sub_content_title[$content_index[$i]][$j],
                    'sub_konten_image' => $request->sub_content_upload_image[$content_index[$i]][$j],
                    'sub_konten_description' => $request->sub_content_short_description[$content_index[$i]][$j]
                ];
            }

            $konten_data = [
                'konten_index' => $content_index[$i],
                'konten_title' => $content_title[$i],
                'konten_description' => $sub_konten_data
            ];

            $sub_konten_array[] = $konten_data;
        }

        $data_array = [
            "sub_konten" => $sub_konten_array
        ];

        $content = isset($sub_konten_array) ? json_encode($data_array) : null;

        // echo json_encode($data_array);

        $section = Section::where('slug',request()->segment(2))->first();

        $id = base64_decode($id);
        $model = Content::find($id);

        $model->title = $request->title;
        $model->subtitle = $request->subtitle;
        $model->slug = $this->textToSlug($request->title);
        $model->short_description = $request->short_description;
        $model->content = $content;
        $model->section_id = $section->id;
        $model->parent_content_id = $request->program;
        $model->active = $request->active;
        $model->save();

        if($request->file('gambar')) {
            foreach($request->file('gambar') as $key => $file) {
                $time = time();
                $fileName =  $time.'-'.Auth::user()->id.'-course-'.$file->hashName();
                $file->move(public_path('front/assets/img'), $fileName);

                $asset = Asset::where('content_id',$model->id)->where('keterangan',$request->keterangan[$key])->first();
                if($asset) {
                    if(file_exists(public_path('front/assets/img/'.$asset->thumbnail))) {
                        unlink(public_path('front/assets/img/'.$asset->thumbnail));
                    }
                   
                    $asset_model = Asset::find($asset->id);
                    $asset_model->thumbnail = $fileName;
                    $asset_model->keterangan = $request->keterangan[$key];
                    $asset_model->save();
                } else {
                    $asset = new Asset();
                    $asset->thumbnail = $fileName;
                    $asset->content_id = $model->id;
                    $asset->keterangan = $request->keterangan[$key];
                    $asset->save();
                }
            }
        }
        
        if ($model->save()) {
            return redirect()->route('administrator.courses.index')->with('alert.success', 'Course Berhasil Diperbaharui');
        } else {
            return redirect()->route('administrator.courses.create')->with('alert.failed', 'Something Wrong');
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
        $section = Section::where('slug',request()->segment(2))->first();
        $query = Content::leftJoin('contents as c','c.id','=','contents.parent_content_id')->where('contents.section_id','=',$section->id)
        ->select('contents.id','contents.title','c.title as program','contents.active');
        return DataTables::of($query)
            ->addColumn('action', function ($model) {
                $string = '<div class="btn-group">';
                $string .= '<a href="' . route('administrator.courses.edit', ['id' => base64_encode($model->id)]) . '" type="button"  class="btn btn-sm btn-info" title="Edit Course"><i class="fas fa-edit"></i></a>';
                $string .= '&nbsp;&nbsp;<a href="' . route('administrator.courses.destroy', ['id' => base64_encode($model->id)]) . '" type="button" class="btn btn-sm btn-danger btn-delete" title="Hapus Course"><i class="fa fa-trash"></i></a>';
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

    function getCourse(Request $request)
    {
        $id = $request->id;
        $data = Content::where('parent_section_id',$id)->get();
        return res::json($data);
    }

    public function saveSubContent(Request $request)
    {
        $id = time();
        $time_id = $request->time_id;
        $sub_time_id = $request->sub_time_id;
        $konten_title = $request->konten_title;
        $sub_konten_title = $request->sub_konten_title;
        $sub_konten_upload_image = $request->sub_konten_upload_image;
        $sub_konten_short_description = $request->sub_konten_short_description;
        $data['row'] = '';

        // if ($id_mpr) {
        //     $mpr = Mpr::find($id_mpr);

        //     $mpr['basic_data'] = json_decode($mpr->basic_data, true);

        //     foreach ($mpr['basic_data']['function_of_role'] as $f) {
        //         $data['row'] .= '<tr id="' . $id . '">
        //                     <td>
        //                         <span>' . $f['title'] . '</span>
        //                         <input type="hidden" name="FoR_index[]" value="' . time() . '">
        //                         <input type="hidden" name="FoR_title[]" value="' . $f['title'] . '">
        //                     </td>
        //                     <td><span>' . $f['description'] . '</span><input type="hidden" name="FoR_description[]" value="' . $f['description'] . '"></td>
        //                     <td><button type="button" class="btn btn-xs btn-danger" onClick="deleteFoR(this)"><i class="fas fa-trash"></i></button></td>
        //         </tr>';
        //     }
        // } else {
            // $validated = $request->validate([
            //     'title_sub_konten' => 'required',
            //     'short_description_sub_konten' => 'required',
            //     'upload_image_sub_konten' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            // ], [
            //     'title_sub_konten.required' => 'Judul Sub Konten wajib diisi',
            //     'short_description_sub_konten.required' => 'Deskripsi Singkat Sub Konten wajib diisi',
            //     'upload_image_sub_konten.max' => 'Ukuran Maksimal Gambar Sub Konten adalah 2 MB',
            // ]);



            if($request->hasFile('sub_konten_upload_image')) {
                $time = time();
                $fileName = $time.'-'.Auth::user()->id.'-subkonten.'.$request->sub_konten_upload_image->extension();
                $request->sub_konten_upload_image->move(public_path('front/assets/img'), $fileName);
            } else {
                $fileName = null;
            }
            
            $title = '<span>' . $sub_konten_title . '</span>';
            $title .= '<input type="hidden" name="time_id[]" value="' . $time_id . '">';
            $title .= '<input type="hidden" name="id[]" value="' . $time_id . '">';
            $title .= '<input type="hidden" name="content_title[]" value="' . $konten_title . '">';
            $title .= '<input type="hidden" name="sub_content_index['.$time_id.'][]" value="' . time() . '">';
            $title .= '<input type="hidden" name="sub_content_title['.$time_id.'][]" value="' . $sub_konten_title . '">';
            $image =  isset($fileName) ? '<img src="'.asset('front/assets/img/'.$fileName).'" width="150px" height="100px">' : '';
            $image .= '<input type="hidden" name="sub_content_upload_image['.$time_id.'][]" value="' . $fileName . '">';
            $description = '<span>' . $sub_konten_short_description . '</span>';
            $description .= '<input type="hidden" name="sub_content_short_description['.$time_id.'][]" value="' . $sub_konten_short_description . '">';

            $data['row'] .= '<tr id="' . $id . '">
                            <td>' . $konten_title . '</td>
                            <td>' . $title . '</td>
                            <td>' . $image . '</td>
                            <td>' . $description . '</td>
                            <td><button type="button" class="btn btn-xs btn-danger" onClick="deleteFoR(this, '.$time_id.')"><i class="fas fa-trash"></i></button></td>
                </tr>';


        return response()->json($data);
    }
}
