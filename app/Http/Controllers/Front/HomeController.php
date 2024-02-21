<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Content;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['banner'] = Asset::leftJoin('contents as c','c.id','=','assets.content_id')->where('c.section_id', 1)
        ->select('assets.id','assets.thumbnail','c.title')->orderBy('assets.id','asc')->get();
        
        $data['articles'] = Content::where('section_id','=',2)->where('active',1)->get();
        $data['program'] = Content::where('section_id','=',3)->where('active',1)->get();
        
        $data['why_bootcamp_phincon'] = Content::where('section_id','=',5)->where('active',1)->get();
        $data['clients'] = Asset::leftJoin('contents as c','c.id','=','assets.content_id')->where('c.section_id', 7)->where('c.active',1)
        ->select('assets.id','assets.thumbnail','c.title','c.active')->orderBy('assets.id','asc')->limit(12)->get();
        $jml_client = Content::where('section_id','=',7)->count();

        $data['more_client'] = Asset::leftJoin('contents as c','c.id','=','assets.content_id')->where('c.section_id', 7)->where('c.active',1)
        ->select('assets.id','assets.thumbnail','c.title','c.active')->skip(12)->take($jml_client-12)->orderBy('assets.id','asc')->get();
        
        $data['testimonies'] = Content::leftJoin('assets as a','a.content_id','=','contents.id')->where('contents.section_id','=',8)
        ->where('contents.active',1)->select('contents.id','contents.title','contents.short_description','a.thumbnail')->get();
        $data['promos'] = Content::where('section_id','=',9)->where('active',1)->get();
        $data['konsultasi'] = Content::leftJoin('assets as a','a.content_id','=','contents.id')->where('contents.section_id','=',13)
                        ->where('contents.active',1)->limit(1)->first();
        return view('front.index', $data);
    }

    public function about()
    {
        $data['about'] = Content::leftJoin('assets as a','a.content_id','=','contents.id')->where('contents.section_id','=',10)->where('contents.slug','=','about-phincon-academy')->where('contents.active','=',1)
                        ->select('contents.*','a.thumbnail as thumbnail')->limit(1)->first();
        $data['vision'] = Content::leftJoin('assets as a','a.content_id','=','contents.id')->where('contents.section_id','=',10)->where('contents.slug','=','vission-thumbnail')->where('contents.active','=',1)
                        ->select('contents.id','contents.title','contents.subtitle','contents.short_description','a.thumbnail as thumbnail')->limit(1)->first();
        $data['mission'] = Content::leftJoin('assets as a','a.content_id','=','contents.id')->where('contents.section_id','=',10)->where('contents.slug','=','mission-thumbnail')->where('contents.active','=',1)
                        ->select('contents.id','contents.title','contents.subtitle','contents.short_description','a.thumbnail as thumbnail')->limit(1)->first();
        $data['kilasbalik'] = Content::leftJoin('assets as a','a.content_id','=','contents.id')->where('contents.section_id','=',10)->where('contents.slug','=','kilas-balik-pendiri')->where('contents.active','=',1)
                        ->select('contents.id','contents.title','contents.subtitle','contents.short_description','a.thumbnail as thumbnail')->limit(1)->first();
        $data['program'] = Content::where('section_id','=',3)->where('active',1)->get();
        $data['konsultasi'] = Content::leftJoin('assets as a','a.content_id','=','contents.id')->where('contents.section_id','=',13)
                        ->where('contents.active',1)->limit(1)->first();
        return view('front.about',$data);
    }
    public function articledetails($slug)
    {
        $artikel = Content::where('slug','=',$slug)->firstOrFail();
        $artikel->counter = $artikel->counter + 1;
        $artikel->save();

        $data['artikel'] = $artikel;
        $data['other_article'] = Content::where('section_id',2)->where('active',1)->limit(3)->orderBy('id','asc')->get();
        $data['program'] = Content::where('section_id','=',3)->where('active',1)->get();
        $data['konsultasi'] = Content::leftJoin('assets as a','a.content_id','=','contents.id')->where('contents.section_id','=',13)
                        ->where('contents.active',1)->limit(1)->first();
        return view('front.article_details',$data);
    }
    public function beasiswaprogram()
    {
        $data['program'] = Content::where('section_id','=',3)->where('active',1)->get();
        $data['konsultasi'] = Content::leftJoin('assets as a','a.content_id','=','contents.id')->where('contents.section_id','=',13)
                        ->where('contents.active',1)->limit(1)->first();

        return view('front.beasiswa_program', $data);
    }
    public function coursedetails($slug)
    {
        $data['detailcourse'] = Content::where('slug','=',$slug)->firstOrFail();
        $data['program'] = Content::where('section_id','=',3)->where('active',1)->get();
        $data['konsultasi'] = Content::leftJoin('assets as a','a.content_id','=','contents.id')->where('contents.section_id','=',13)
                        ->where('contents.active',1)->limit(1)->first();
        return view('front.course_details', $data);
    }
    public function program()
    {
        $data['konsultasi'] = Content::where('section_id','=',13)->where('active',1)->limit(1)->first();
        $data['program'] = Content::where('section_id','=',3)->where('active',1)->orderBy('id','asc')->get();
        return view('front.program', $data);
    }
    
    public function registrasi()
    {
        return view('front.registrasi');
    }

    public function beasiswaregister()
    {
        return view('front.beasiswa_register');
    }
}
