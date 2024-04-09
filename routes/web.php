<?php

use App\Http\Controllers\Back\AboutController;
use App\Http\Controllers\Back\AreaPraktekController;
use App\Http\Controllers\Back\ArtikelController;
use App\Http\Controllers\Back\AssetController;
use App\Http\Controllers\Back\BannerController;
use App\Http\Controllers\Back\CallToActionController;
use App\Http\Controllers\Back\ClientController;
use App\Http\Controllers\Back\ContentController;
use App\Http\Controllers\Back\CoursesController;
use App\Http\Controllers\Back\HomeController as BackHomeController;
use App\Http\Controllers\Back\HubungiKamiController;
use App\Http\Controllers\Back\IdentitasController;
use App\Http\Controllers\Back\LawyerController;
use App\Http\Controllers\Back\InformasiController;
use App\Http\Controllers\Back\KuesionerController;
use App\Http\Controllers\Back\LoginController;
use App\Http\Controllers\Back\MengapaController;
use App\Http\Controllers\Back\PengunjungWebsiteController;
use App\Http\Controllers\Back\ProgramController;
use App\Http\Controllers\Back\PromoController;
use App\Http\Controllers\Back\RegistrasiController as BackRegistrasiController;
use App\Http\Controllers\Back\SectionController;
use App\Http\Controllers\Back\TestimoniController;

use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\RegistrasiController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Artisan::call('route:clear');
Artisan::call('cache:clear');
Artisan::call('config:clear');

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');
Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/tentang-kami', [HomeController::class, 'about'])->name('tentang-kami');
Route::get('/kategori', [HomeController::class, 'kategori'])->name('kategori');
Route::get('/kategori/{any}', [HomeController::class, 'kategorilist'])->name('kategorilist');
Route::get('/area-praktek', [HomeController::class, 'areapraktek'])->name('area-praktek');
Route::get('/area-praktek/{any}', [HomeController::class, 'detailAreaPraktek'])->name('detailAreaPraktek');
Route::get('/tim-kami', [HomeController::class, 'timkami'])->name('tim-kami');
Route::get('/artikel-publikasi', [HomeController::class, 'artikelpublikasi'])->name('artikel-publikasi');
Route::get('/kontak-kami', [HomeController::class, 'kontakkami'])->name('kontak-kami');
Route::get('/artikel/{any}', [HomeController::class, 'articledetails'])->name('article-details');
Route::get('/program/course-details/{any}', [HomeController::class, 'coursedetails'])->name('coursedetails');
Route::post('/store-pengunjung-website', [HomeController::class, 'storePengunjungwebsite'])->name('pengunjung-website.store');

// Role Superadmin
Route::middleware(['auth','role:superadmin'])->group(function() {
    Route::name('administrator.')->prefix('administrator')->group(function () {
        Route::get('/', [BackHomeController::class, 'index'])->name('index');

        Route::get('home', [BackHomeController::class, 'home'])->name('home');        
        
        Route::name('about.')->prefix('about')->group(function () {
            Route::post('/datatable', [AboutController::class, 'datatable'])->name('datatable');
            Route::resource('', AboutController::class, ['parameters' => ['' => 'id']]);
        });

        Route::name('artikel.')->prefix('artikel')->group(function () {
            Route::post('/datatable', [ArtikelController::class, 'datatable'])->name('datatable');
            Route::resource('', ArtikelController::class, ['parameters' => ['' => 'id']]);
        });

        Route::name('asset.')->prefix('asset')->group(function () {
            Route::post('/datatable', [AssetController::class, 'datatable'])->name('datatable');
            Route::resource('', AssetController::class, ['parameters' => ['' => 'id']]);
        });
        
        Route::name('banner.')->prefix('banner')->group(function () {
            Route::post('/datatable', [BannerController::class, 'datatable'])->name('datatable');
            Route::resource('', BannerController::class, ['parameters' => ['' => 'id']]);
        });

        Route::name('area-praktek.')->prefix('area-praktek')->group(function () {
            Route::post('/datatable', [AreaPraktekController::class, 'datatable'])->name('datatable');
            Route::resource('', AreaPraktekController::class, ['parameters' => ['' => 'id']]);
        });

        Route::name('call-to-action.')->prefix('call-to-action')->group(function () {
            Route::post('/datatable', [CallToActionController::class, 'datatable'])->name('datatable');
            Route::resource('', CallToActionController::class, ['parameters' => ['' => 'id']]);
        });

        Route::name('client.')->prefix('client')->group(function () {
            Route::post('/datatable', [ClientController::class, 'datatable'])->name('datatable');
            Route::resource('', ClientController::class, ['parameters' => ['' => 'id']]);
        });

        Route::name('mengapa-memilih-kami.')->prefix('mengapa-memilih-kami')->group(function () {
            Route::post('/datatable', [MengapaController::class, 'datatable'])->name('datatable');
            Route::resource('', MengapaController::class, ['parameters' => ['' => 'id']]);
        });

        Route::name('courses.')->prefix('courses')->group(function () {
            Route::post('/datatable', [CoursesController::class, 'datatable'])->name('datatable');
            Route::resource('', CoursesController::class, ['parameters' => ['' => 'id']]);
            Route::get('add-Entry', [CoursesController::class, 'addEntry'])->name('addEntry');
            Route::post('saveSubContent', [CoursesController::class, 'saveSubContent'])->name('saveSubContent');
        });

        Route::name('hubungi-kami.')->prefix('hubungi-kami')->group(function () {
            Route::post('/datatable', [HubungiKamiController::class, 'datatable'])->name('datatable');
            Route::resource('', HubungiKamiController::class, ['parameters' => ['' => 'id']]);
        });

        Route::name('identitas.')->prefix('identitas')->group(function () {
            Route::post('/datatable', [IdentitasController::class, 'datatable'])->name('datatable');
            Route::resource('', IdentitasController::class, ['parameters' => ['' => 'id']]);
        });

        Route::name('lawyer.')->prefix('lawyer')->group(function () {
            Route::post('/datatable', [LawyerController::class, 'datatable'])->name('datatable');
            Route::resource('', LawyerController::class, ['parameters' => ['' => 'id']]);
        });

        Route::name('kuesioner.')->prefix('kuesioner')->group(function () {
            Route::post('/datatable', [KuesionerController::class, 'datatable'])->name('datatable');
            Route::resource('', KuesionerController::class, ['parameters' => ['' => 'id']]);
        });
        
        Route::name('pengunjung-website.')->prefix('pengunjung-website')->group(function () {
            Route::post('/datatable', [PengunjungWebsiteController::class, 'datatable'])->name('datatable');
            Route::resource('', PengunjungWebsiteController::class, ['parameters' => ['' => 'id']]);
        });
        
        Route::name('program.')->prefix('program')->group(function () {
            Route::post('/datatable', [ProgramController::class, 'datatable'])->name('datatable');
            Route::resource('', ProgramController::class, ['parameters' => ['' => 'id']]);
        });

        Route::name('promo.')->prefix('promo')->group(function () {
            Route::post('/datatable', [PromoController::class, 'datatable'])->name('datatable');
            Route::resource('', PromoController::class, ['parameters' => ['' => 'id']]);
        });

        Route::name('registrasi.')->prefix('registrasi')->group(function () {
            Route::post('/datatable', [BackRegistrasiController::class, 'datatable'])->name('datatable');
            Route::resource('', BackRegistrasiController::class, ['parameters' => ['' => 'id']]);
            Route::get('/export/{date}', [BackRegistrasiController::class, 'exportRegistrasi',])->name('exportRegistrasi');
        });

        Route::name('section.')->prefix('section')->group(function () {
            Route::post('/datatable', [SectionController::class, 'datatable'])->name('datatable');
            Route::resource('', SectionController::class, ['parameters' => ['' => 'id']]);
        });

        Route::name('testimoni.')->prefix('testimoni')->group(function () {
            Route::post('/datatable', [TestimoniController::class, 'datatable'])->name('datatable');
            Route::resource('', TestimoniController::class, ['parameters' => ['' => 'id']]);
        });

        Route::name('content.')->prefix('content')->group(function () {
            Route::post('/datatable', [ContentController::class, 'datatable'])->name('datatable');
            Route::resource('', ContentController::class, ['parameters' => ['' => 'id']]);
        });

        Route::name('informasi.')->prefix('informasi')->group(function () {
            Route::post('/getInformasi', [InformasiController::class, 'getInformasi'])->name('getInformasi');
            Route::get('/data', [InformasiController::class, 'data'])->name('data');
            Route::post('/datatable', [InformasiController::class, 'datatable'])->name('datatable');
            Route::resource('', InformasiController::class, ['parameters' => ['' => 'id']]);
        });
    });
});





