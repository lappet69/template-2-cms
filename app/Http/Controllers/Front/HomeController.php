<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Content;
use App\Models\Kategori;
use App\Models\PengunjungWebsite;
use App\Models\Section;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['title'] = "Beranda - Home";
        $data['banner'] = Content::leftJoin('assets as a', 'a.content_id', '=', 'contents.id')
            ->select('a.thumbnail', 'contents.id', 'contents.title', 'contents.subtitle', 'contents.short_description', 'contents.content')
            ->where('contents.section_id', 10)
            ->orderBy('contents.id', 'desc')->get();
        $data['about'] = Content::where('section_id', '=', 5)->limit(1)->first();
        $data['bidang_praktik_parent'] = Content::where('section_id', '=', 7)->whereNull('parent_content_id')->limit(1)->first();
        $data['mengapa_memilih_kami'] = Content::where('section_id', '=', 3)->whereNull('parent_content_id')->limit(1)->first();
        $data['call_to_action'] = Content::leftJoin('assets as a', 'a.content_id', '=', 'contents.id')
            ->select('a.thumbnail', 'contents.id', 'contents.title', 'contents.subtitle', 'contents.short_description', 'contents.content')
            ->where('contents.section_id', '=', 13)->limit(1)->first();
        $data['lawyer'] = Content::where('section_id', '=', 6)->whereNull('parent_content_id')->limit(1)->first();
        $data['artikel'] = Content::where('section_id', '=', 2)->whereNull('parent_content_id')->first();
        return view('frontend.index', $data);
    }

    public function about()
    {
        $data['title'] = 'Tentang Kami';
        $data['about'] = Content::where('section_id', '=', 5)->limit(1)->first();
        $data['call_to_action'] = Content::leftJoin('assets as a', 'a.content_id', '=', 'contents.id')
            ->select('a.thumbnail', 'contents.id', 'contents.title', 'contents.subtitle', 'contents.short_description', 'contents.content')
            ->where('contents.section_id', '=', 13)->limit(1)->first();
        $data['konsultasi'] = Content::leftJoin('assets as a', 'a.content_id', '=', 'contents.id')->where('contents.section_id', '=', 13)
            ->where('contents.active', 1)->limit(1)->first();
        $data['mengapa_memilih_kami'] = Content::where('section_id', '=', 3)->whereNull('parent_content_id')->limit(1)->first();
        $data['lawyer'] = Content::where('section_id', '=', 6)->whereNull('parent_content_id')->limit(1)->first();
        return view('frontend.tentang_kami', $data);
    }

    public function areapraktek()
    {
        $data['title'] = 'Area Praktek';
        $data['bidang_praktik_parent'] = Content::where('section_id', '=', 7)->whereNull('parent_content_id')->limit(1)->first();
        $data['mengapa_memilih_kami'] = Content::where('section_id', '=', 3)->whereNull('parent_content_id')->limit(1)->first();
        $data['call_to_action'] = Content::leftJoin('assets as a', 'a.content_id', '=', 'contents.id')
            ->select('a.thumbnail', 'contents.id', 'contents.title', 'contents.subtitle', 'contents.short_description', 'contents.content')
            ->where('contents.section_id', '=', 13)->limit(1)->first();
        return view('frontend.area_praktek', $data);
    }

    public function detailAreaPraktek($slug)
    {
        $area_praktek = Content::where('slug', '=', $slug)->firstOrFail();
        $data['title'] = $area_praktek->title;
        $data['area_praktek'] = $area_praktek;
        $data['area_praktik_parent'] = Content::where('section_id', '=', 7)->whereNull('parent_content_id')->limit(1)->first();
        $data['call_to_action'] = Content::leftJoin('assets as a', 'a.content_id', '=', 'contents.id')
            ->select('a.thumbnail', 'contents.id', 'contents.title', 'contents.subtitle', 'contents.short_description', 'contents.content')
            ->where('contents.section_id', '=', 13)->limit(1)->first();
        return view('frontend.detail_area_praktek', $data);
    }

    public function timkami()
    {
        $data['title'] = 'Tim Kami';
        $data['lawyer'] = Content::where('section_id', '=', 6)->whereNull('parent_content_id')->limit(1)->first();
        $data['call_to_action'] = Content::leftJoin('assets as a', 'a.content_id', '=', 'contents.id')
            ->select('a.thumbnail', 'contents.id', 'contents.title', 'contents.subtitle', 'contents.short_description', 'contents.content')
            ->where('contents.section_id', '=', 13)->limit(1)->first();
        return view('frontend.tim_kami', $data);
    }

    public function kategori()
    {
        return view('frontend.kategori');
    }

    public function kategorilist($slug)
    {
        $kategori = Kategori::where('slug', '=', $slug)->firstOrFail();
        $data['kategori'] = Kategori::where('slug', '=', $slug)->firstOrFail();
        $data['title'] = 'Artikel & Publikasi Kategori : ' . $kategori->name;
        $data['artikel_kategori'] = Content::where('kategori_id', $kategori->id)->get();
        $data['call_to_action'] = Content::leftJoin('assets as a', 'a.content_id', '=', 'contents.id')
            ->select('a.thumbnail', 'contents.id', 'contents.title', 'contents.subtitle', 'contents.short_description', 'contents.content')
            ->where('contents.section_id', '=', 13)->limit(1)->first();
        $data['artikel'] = Content::where('section_id', '=', 2)->whereNull('parent_content_id')->first();
        return view('frontend.kategori_artikel', $data);
    }

    public function artikelpublikasi()
    {
        $data['title'] = 'Artikel & Publikasi';
        $data['call_to_action'] = Content::leftJoin('assets as a', 'a.content_id', '=', 'contents.id')
            ->select('a.thumbnail', 'contents.id', 'contents.title', 'contents.subtitle', 'contents.short_description', 'contents.content')
            ->where('contents.section_id', '=', 13)->limit(1)->first();
        $data['artikel'] = Content::where('section_id', '=', 2)->whereNull('parent_content_id')->first();
        return view('frontend.artikel_publikasi', $data);
    }

    public function kontakkami()
    {
        $data['title'] = 'Kontak Kami';
        $data['kontak_kami'] = Content::where('section_id', '=', 4)->limit(1)->first();
        $data['call_to_action'] = Content::leftJoin('assets as a', 'a.content_id', '=', 'contents.id')
            ->select('a.thumbnail', 'contents.id', 'contents.title', 'contents.subtitle', 'contents.short_description', 'contents.content')
            ->where('contents.section_id', '=', 13)->limit(1)->first();
        return view('frontend.kontak_kami', $data);
    }

    public function articledetails($slug)
    {
        $artikel = Content::where('slug', '=', $slug)->firstOrFail();
        $artikel->counter = $artikel->counter + 1;
        $artikel->save();

        $data['title'] = $artikel->title;
        $data['artikel'] = $artikel;
        $data['kategori'] = Kategori::all();
        $data['call_to_action'] = Content::leftJoin('assets as a', 'a.content_id', '=', 'contents.id')
            ->select('a.thumbnail', 'contents.id', 'contents.title', 'contents.subtitle', 'contents.short_description', 'contents.content')
            ->where('contents.section_id', '=', 13)->limit(1)->first();
        $data['other_article'] = Content::where('section_id', 2)->whereNotNull('parent_content_id')->where('active', 1)->limit(3)->orderBy('id', 'desc')->get();
        return view('frontend.article_detail', $data);
    }

    public function beasiswaprogram()
    {
        $data['program'] = Content::where('section_id', '=', 3)->where('active', 1)->get();
        $data['konsultasi'] = Content::leftJoin('assets as a', 'a.content_id', '=', 'contents.id')->where('contents.section_id', '=', 13)
            ->where('contents.active', 1)->limit(1)->first();

        return view('front.beasiswa_program', $data);
    }
    public function coursedetails($slug)
    {
        $content = Content::where('slug', '=', $slug)->firstOrFail();
        $content->counter = $content->counter + 1;
        $content->save();

        $data['detailcourse'] = Content::where('slug', '=', $slug)->firstOrFail();
        $data['program'] = Content::where('section_id', '=', 3)->where('active', 1)->get();
        $data['konsultasi'] = Content::leftJoin('assets as a', 'a.content_id', '=', 'contents.id')->where('contents.section_id', '=', 13)
            ->where('contents.active', 1)->limit(1)->first();
        return view('front.course_details', $data);
    }


    public function registrasi()
    {
        return view('front.registrasi');
    }

    public function storePengunjungwebsite(Request $request)
    {
        $request->validate(
            [
                'nama_pengunjung' => 'required',
                'no_wa' => 'required',
                'tanggal_janji_temu' => 'required',
                'waktu_janji_temu' => 'required',
                'topik_janji_temu' => 'required',
            ],
            [
                'nama_pengunjung.required' => 'Nama Anda Wajib Diisi',
                'no_wa.required' => 'No. WhatsApp yang dapat Dihubungi Wajib Diisi',
                'tanggal_janji_temu.required' => 'Tanggal Janji Temu Wajib Diisi',
                'waktu_janji_temu.required' => 'Waktu Janji Temu Wajib Diisi',
                'topik_janji_temu.required' => 'Topik Janji Temu Wajib Diisi',
            ]
        );

        $model = new PengunjungWebsite();

        $model->nama_pengunjung = $request->nama_pengunjung;
        $model->no_wa = $request->no_wa;
        $model->tanggal_janji_temu = $request->tanggal_janji_temu;
        $model->waktu_janji_temu = $request->waktu_janji_temu;
        $model->topik_janji_temu = $request->topik_janji_temu;

        if ($model->save()) {
            return redirect()->route('index')->with('alert.success', 'Terima Kasih, Anda Akan Dihubungi Segera Dihubungi Tim Kami untuk Janji Temu');
        } else {
            return redirect()->route('index')->with('alert.failed', 'Something Wrong');
        }
    }
}
