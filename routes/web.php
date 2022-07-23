<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardCtrl;
use App\Http\Controllers\ClusterCtrl;
use App\Http\Controllers\KotaCtrl;
use App\Http\Controllers\KecamatanCtrl;
use App\Http\Controllers\ProductCtrl;
use App\Http\Controllers\DlsCtrl;
use App\Http\Controllers\RevenueCtrl;
use App\Http\Controllers\UserCtrl;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('dashboard');
// });

//Dls
Route::match(["get","post"],'/',[DashboardCtrl::class,'index']);

//Cluster
Route::get('/cluster',[ClusterCtrl::class,'index']);
Route::get('/cluster/form/{id?}',[ClusterCtrl::class,'form']);
Route::post('/cluster/save',[ClusterCtrl::class,'save']);
Route::get('/cluster/delete/{id?}',[ClusterCtrl::class,'delete']);

//Kota
Route::get('/kota',[KotaCtrl::class,'index']);
Route::post('/kota/save',[KotaCtrl::class,'save']);
Route::get('/kota/delete/{id?}',[KotaCtrl::class,'delete']);

//Kecamatan
Route::get('/kecamatan',[KecamatanCtrl::class,'index']);
Route::post('/kecamatan/save',[KecamatanCtrl::class,'save']);
Route::get('/kecamatan/delete/{id}',[KecamatanCtrl::class,'delete']);

//Product
Route::get('/product',[ProductCtrl::class,'index']);
Route::post('/product/save',[ProductCtrl::class,'save']);
Route::get('/product/delete/{id?}',[ProductCtrl::class,'delete']);

//Dls
// Route::get('/dls',[DlsCtrl::class,'index']);
// Route::post('/dls/save',[DlsCtrl::class,'save']);
// Route::get('/dls/delete/{id?}',[DlsCtrl::class,'delete']);

//Revenue Kecamatan
Route::get('/revenue/form_tahun',[RevenueCtrl::class,'form']);
Route::get('/revenue/kec',[RevenueCtrl::class,'rev_kec']);
Route::get('/revenue/{id_kecamatan}/{tahun}/{bulan}',[RevenueCtrl::class,'detail']);
Route::get('/revenue/rev_detail',[RevenueCtrl::class,'rev_detail']);
Route::get('/revenue/form_revenue',[RevenueCtrl::class,'form_revenue']);
Route::post('/revenue/save',[RevenueCtrl::class,'save']);
Route::get('/revenue/delete/{id?}',[RevenueCtrl::class,'delete']);

//Revenue DLS
Route::get('/revenue/form_tahun_dls',[RevenueCtrl::class,'form_dls']);
Route::get('/revenue/cluster',[RevenueCtrl::class,'rev_clus']);
Route::get('/revenue/dls/{id_cluster}/{tahun}/{bulan}',[RevenueCtrl::class,'detail_dls']);
Route::get('/revenue/rev_detail',[RevenueCtrl::class,'rev_detail']);
Route::get('/revenue/form_revenue',[RevenueCtrl::class,'form_revenue']);
Route::post('/revenue/dls/save',[RevenueCtrl::class,'save_dls']);
Route::get('/rev/hapus/delete/{id?}',[RevenueCtrl::class,'deletedls']);

//User
Route::get('/user',[UserCtrl::class,'index']);
Route::post('/user/save',[UserCtrl::class,'save']);
Route::get('/user/delete/{id?}',[UserCtrl::class,'delete']);

//Import Kecamatan
Route::get('revenue/import',[RevenueCtrl::class,'import']);
Route::post('revenue/import/save',[RevenueCtrl::class,'import_save']);

//Import DLS
Route::get('revenue/import/dls',[RevenueCtrl::class,'import_dls']);
Route::post('revenue/import/cluster',[RevenueCtrl::class,'import_cluster']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
