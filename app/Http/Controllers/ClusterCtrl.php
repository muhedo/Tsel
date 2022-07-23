<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cluster;

class ClusterCtrl extends Controller
{
    //
    function index(){
        //Data Cluster
        $data = [
            "title" => "Data Cluster",
            "page_title" => "Data Cluster",
            "cluster" => Cluster::All()
        ];

        return view("cluster.data_cluster",$data);
    }

    function form(Request $req){
        $mode = $req->id!= "" ? "Edit " : " Tambah ";
        $data = [
            "title" => $mode."Cluster",
            "page_title" => $mode."Cluster",
            "rsCluster" => Cluster::where("id_cluster",$req->id)->first()
        ];
        return view("cluster.data_cluster",$data);
    }

    function save(Request $req){
        //Validasi
        $req->validate(
            //Rule
            [
                "nm_cluster"=>"required",
                "kat_cluster"=>"required",
            ],
            [
              //Message Error
                "nm_cluster.required"=>"Nama Cluster Harus Diisi !!!",
                "kat_cluster.required"=>"Kategori Cluster Harus Diisi !!!",
            ]
        );
        try {
            //Save Process
            Cluster::UpdateorCreate(
                [
                   "id_cluster" =>$req->input("id_cluster")
                ],
                [
                    "nm_cluster" =>$req->input("nm_cluster"),
                    "kat_cluster" =>$req->input("kat_cluster"),
                ]
            );
            //Message Success
            $mess=["type"=>"Selamat !!!","text"=>"Data Berhasil Disimpan !!!","icon"=>"success","button"=>"Oke"];
        } catch(Exception $err){
            //Message Error
            $mess=["type"=>"Maaf !!!","text"=>"Data Gagal Disimpan !!!","icon"=>"error","button"=>"Oke"];
        }
        // Redirect
        return redirect('cluster')->with($mess);
    }

    function delete(Request $req){
        try{
            Cluster::where("id_cluster",$req->id)->delete();
            //Message Success
            $mess=["type"=>"Selamat !!!","text"=>"Data Berhasil Dihapus !!!","icon"=>"success","button"=>"Oke"];
        } catch(Exception $err){
            //Message Error
            $mess=["type"=>"Maaf !!!","text"=>"Data Gagal Dihapus !!!","icon"=>"error","button"=>"Oke"];
        }
        // Redirect
        return redirect('cluster')->with($mess);
    }
}
