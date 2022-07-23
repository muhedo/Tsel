<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dls;

class DlsCtrl extends Controller{
    
}
// {
//     //
//     //Data Dls
//     function index(){
//         $data = [
//             "title"=>"Data Dls",
//             "page_title"=>"Data Dls",
//             "dls"=>Dls::All()
//         ];
//         return view("dls.data_dls",$data);
//     }

//     function form(Request $req){
//         $data=[
//             "title"=>"Dls",
//             "page_title"=>"Dls",
//             "rsDls"=>Dls::where("id_dls",$req->id)->first()
//         ];
//     }

    // function save(Request $req){
    //     //Validasi
    //     $req->validate(
    //         //Rule
    //         [
    //             "bulan"=>"required",
    //         ],
    //         [
    //             //Message Error
    //             "bulan.required"=>"Nama Bulan Harus Diisi!!!",
    //         ]
    //     );
    //     try{
    //         //Save Process
    //         Dls::UpdateorCreate(
    //             [
    //                 "id_dls"=>$req->input("id_dls")
    //             ],
    //             [
    //                 "bulan"=>$req->input("bulan")
    //             ]
    //         );
    //         // Message Success
    //         $mess=["type"=>"success","text"=>"Data Berhasil Disimpan !!!"];
    //     } catch(Exception $err){
    //         //Message Error
    //         $mess=["type"=>"error","text"=>"Data Gagal Disimpan !!!"];
    //     }
    //     //Redirect
    //     return redirect('dls')->with($mess);
    // }

//     function delete(Request $req){
//         try{
//             Dls::where("id_dls",$req->id)->delete();
//             //Message Success
//             $mess=["type"=>"success","text"=>"Data Berhasil Dihapus !!!"];
//         } catch(Exception $err){
//             //Message Error
//             $mess=["type"=>"error","text"=>"Data Gagal Dihapus !!!"];
//         }
//         //Redirect
//         return redirect('dls')->with($mess);
//     }
// }
