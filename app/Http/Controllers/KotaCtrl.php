<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kota;
use App\Models\Cluster;

class KotaCtrl extends Controller
{
    //
    function index(){
        //Data Kota
        $kota = DB::table("table_kota")
        ->join("table_cluster","table_kota.id_cluster","=","table_cluster.id_cluster")
        ->select("table_kota.*","table_cluster.nm_cluster")
        ->get();
        $data = [
            "title" => "Data Kota",
            "page_title" => "Data Kota",
            "kota" => $kota,
            "cluster" =>Cluster::All()

        ];

        return view("kota.data_kota",$data);
    }

    function form(Request $req){
        // $mode = $req->id!= "" ? "Edit " : " Tambah ";
        $data = [
            "title" => $mode."Kota",
            "page_title" => $mode."Kota",
            "rsKota" => Kota::where("id_kota",$req->id)->first()
        ];
        // return view("kota.data_kota",$data);
    }

    function save(Request $req){
        //Validasi
        $req->validate(
            //Rule
            [
                "nm_kota"=>"required",
            ],
            [
              //Message Error
                "nm_kota.required"=>"Nama Kota Harus Diisi !!!",
            ]
        );
        try {
            //Save Process
            Kota::UpdateorCreate(
                [
                   "id_kota" =>$req->input("id_kota")
                ],
                [
                    "nm_kota" =>$req->input("nm_kota"),
                    "id_cluster" =>$req->input("id_cluster"),
                ]
            );
            //Message Success
            $mess=["type"=>"Selamat !!!","text"=>"Data Berhasil Disimpan !!!","icon"=>"success","button"=>"Oke"];
        } catch(Exception $err){
            //Message Error
            $mess=["type"=>"Maaf !!!","text"=>"Data Gagal Disimpan !!!","icon"=>"error","button"=>"Oke"];
        }
        // Redirect
        return redirect('kota')->with($mess);
    }

    function delete(Request $req){
        try{
            Kota::where("id_kota",$req->id)->delete();
            //Message Success
            $mess=["type"=>"Selamat !!!","text"=>"Data Berhasil Disimpan !!!","icon"=>"success","button"=>"Oke"];
        }catch(Exception $err){
            //Message Error
            $mess=["type"=>"Maaf !!!","text"=>"Data Gagal Disimpan !!!","icon"=>"error","button"=>"Oke"];
        }
        //Redirect
        return redirect('kota')->with($mess);
    }
}
