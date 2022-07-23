<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserCtrl extends Controller
{
    //Data User
    function index(){
        $data=[
            "title"=>"Data User",
            "page_title"=>"Data User",
            "users"=>User::All()
        ];
        return view("user.data_user",$data);
    }

    //Form User
    function form(Request $req){
        $data=[
            "title"=>"Tambah User",
            "title_page"=>"Tambah User",
            "rsUser"=>User::where("id",$req->id)->first()
        ];
    }

    function save(Request $req){
        // dd($req->all());
        // Validation
         $req->validate(
            // Rule
            [
                "name" => "required",
                "email" =>"required|email|unique:users,email,".$req->input("id").",id",
            ],
            // Message Error
            [
                "name.required" => "Nama User Wajib diisi !!",            
                "email.required" => "Email Wajib diisi !!",            
                "email.email" => "Email Invalid !!",
                "email.unique" => "Email Sudah Terdaftar !!",
            ]
        );

        try{
            //Proses Save
            User::UpdateorCreate(
                [
                    "id"=>$req->input("id")
                ],
                [
                    "name"=>$req->input("name"),
                    "email"=>$req->input("email"),
                    "password"=> $req->input("password") == "" ? $req->input("old_password") : Hash::make($req->input("password")),
                ]
            );
            //Message Success
            $mess=["type"=>"Selamat !!!","text"=>"Data Berhasil Disimpan !!!","icon"=>"success","button"=>"Oke"];

        }catch(Exception $err){
            $mess=["type"=>"Maaf !!!","text"=>"Data Gagal Disimpan !!!","icon"=>"error","button"=>"Oke"];
        }
        return redirect('user')->with($mess);
    
    }

    function delete(Request $req){
        try {
            User::where("id",$req->id)->delete();
            $mess=["type"=>"Selamat !!!","text"=>"Data Gagal Dihapus !!!","icon"=>"success","button"=>"Oke"];
        } catch(Exception $err){
            $mess=["type"=>"Maaf !!!","text"=>"Data Gagal Dihapus !!!","icon"=>"error","button"=>"Oke"];
        }
        // Redirect
        return redirect('user')->with($mess);
    }

}
