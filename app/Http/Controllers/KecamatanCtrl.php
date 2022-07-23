<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kecamatan;
use App\Models\Kota;

class KecamatanCtrl extends Controller
{
    //
    function index(){
        // Data Kecamatan
        $kecamatan = DB::table("table_kecamatan")
        ->join("table_kota","table_kecamatan.id_kota","=","table_kota.id_kota")
        ->select("table_kecamatan.*","table_kota.nm_kota")
        ->get();
        $data = [
            "title"=>"Data Kecamatan",
            "page_title"=> "Data Kecamatan",
            "kecamatan"=> $kecamatan,
            "kota"=>Kota::All()
        ];

        return view("kecamatan.data_kecamatan",$data);
    }

    function form(Request $req){
        $data = [
            "title"=>"Kecamatan",
            "page_title"=>"Kecamatan",
            "rsKecamatan"=>Kecamatan::where("id_kecamatan",$req->id)->first()
        ];
    }

    function save(Request $req){
        //Validasi
        $req->validate(
            //Rule
            [
                "nm_kecamatan"=>"required",
            ],
            //Message Error
            [
                "nm_kecamatan.required"=>"Nama Kecamatan Harus Diisi !!!",
            ]
        );
        try {
            //Save Process
            Kecamatan::UpdateorCreate(
                [
                    "id_kecamatan"=>$req->input("id_kecamatan")
                ],
                [
                    "nm_kecamatan"=>$req->input("nm_kecamatan"),
                    "id_kota"=>$req->input("id_kota"),
                ]
            );
            //Message Success
            $mess=["type"=>"Selamat !!!","text"=>"Data Berhasil Disimpan !!!","icon"=>"success","button"=>"Oke"];
        } catch(Exception $err){
            //Message Error
            $mess=["type"=>"Maaf !!!","text"=>"Data Gagal Disimpan !!!","icon"=>"error","button"=>"Oke"];
        }
        //Redirect
        return redirect('kecamatan')->with($mess);
    }

    function delete(Request $req){
        try{
            Kecamatan::where("id_kecamatan",$req->id)->delete();
            //Message Success
            $mess=["type"=>"Selamat !!!","text"=>"Data Berhasil Disimpan !!!","icon"=>"success","button"=>"Oke"];
        } catch(Exception $err){
            //Message Error
            $mess=["type"=>"Maaf !!!","text"=>"Data Gagal Disimpan !!!","icon"=>"error","button"=>"Oke"];
        }
        //Redirect
        return redirect('kecamatan')->with($mess);
    }
}    