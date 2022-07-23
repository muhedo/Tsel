<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Revenue;
use App\Models\Revenue_Dls;
use App\Models\Kecamatan;
use App\Models\Product;
use Maatwebsite\Excel\Facades\Excel;
use App\Helpers\Helper;

class RevenueCtrl extends Controller
{
    //Detail Revenue
  function detail(Request $req){
      $product =  DB::select("SELECT * FROM table_product WHERE id_product NOT IN (select id_product FROM table_revenue WHERE id_kecamatan=".$req->id_kecamatan." And tahun=".$req->tahun." And bulan_new =".(int)$req->bulan.")");

      $revenue = DB::table("table_revenue")
      ->join("table_kecamatan","table_revenue.id_kecamatan","=","table_kecamatan.id_kecamatan")
      ->join("table_product","table_revenue.id_product","=","table_product.id_product")
      ->select("table_revenue.*","table_kecamatan.nm_kecamatan","table_product.nm_product")
      ->where("table_kecamatan.id_kecamatan",$req->id_kecamatan)
      ->where("table_revenue.bulan_new",(int)$req->bulan)
      ->where("table_revenue.tahun",$req->tahun)
      ->get(); 

      $rsbulan = DB::table("table_revenue")
      ->select("table_revenue.bulan_old","table_revenue.bulan_new")
      ->where("table_revenue.id_kecamatan",$req->id_kecamatan)
      ->where("table_revenue.bulan_new",(int)$req->bulan)
      ->where("table_revenue.tahun",$req->tahun)
      ->groupBy("table_revenue.bulan_old","table_revenue.bulan_new")
      ->first();     

        $bulan = [1=>"Januari",2=>"Februari",3=>"Maret",4=>"April",5=>"Mei",6=>"Juni",7=>"Juli",8=>"Agustus",9=>"September",10=>"Oktober",11=>"November",12=>"Desember"];

        //Data Revenue
        $data=[
            "title"=>"Data Revenue",
            "page_title"=>"Data Revenue",
            "product"=>$product,
            "revenue"=>$revenue,
            "id_kecamatan"=>$req->id_kecamatan,
            "tahun"=>$req->tahun,
            "bulan_new"=>$req->bulan,
            "t_bulan_old"=>isset($rsbulan->bulan_old) ? $bulan[$rsbulan->bulan_old] : "Bulan Lama",
            "t_bulan_new"=>isset($rsbulan->bulan_new) ? $bulan[$rsbulan->bulan_new] : "Bulan Baru",
        ];
        return view("revenue.data_revenue",$data);
    }

    //Form Tahun
    function form(Request $req){
      $data=[
            "title"=>"Input Bulan dan Tahun",
            "page_title"=>"Input Bulan dan Tahun",
            "rsRev"=>Revenue::where("id_revenue",$req->id)->first()
        ];
        return view("revenue.form_tahun",$data);
    }

    //Form Input Revenue
    function form_rev(Request $req){
      $data=[
            "title"=>"Data Revenue",
            "page_title"=>"Data Revenue",
            "rsRev"=>Revenue::where("id_revenue",$req->id)->first()
        ];
        return view("revenue.form_revenue",$data);
    }

    //Import Excel
    function import(){
        $data=[
            "title"=>"Import Data Kecamatan",
            "page_title"=>"Import Data  Kecamatan"
        ];
       return view("revenue.import",$data);
    }

    //Pilih Kecamatan
    function rev_kec(Request $req){
        $date = explode("-",$req->input("month"));
        $kec =  DB::table("table_kecamatan")
        ->select("table_kecamatan.*")
        ->get();
        //Data Revenue
        $data=[
            "title"=>"Data Kecamatan",
            "page_title"=>"Data Kecamatan",
            "kecamatan"=>$kec,
            "tahun"=>$date[0],
            "bulan"=>$date[1]
        ];
        return view("revenue.data_kecamatan",$data);
    }

    function import_save(Request $req){
        $data = Excel::toArray([],$req->file("data_revenue"));
    //    dd($data[0]);
        $rev = $data[0]; // Sheet 1
        $row = 0;
        $month = ["Januari"=>1,"Februari"=>2,"Maret"=>3,"April"=>4,"Mei"=>5,"Juni"=>6,"Juli"=>7,"Agustus"=>8,"September"=>9,"Oktober"=>10,"November"=>11,"Desember"=>12];
        foreach($rev as $rsRev){
            if($row>0){
                // echo $rsRev[0]."|".$rsRev[1]."|".Helper::get_id_kecamatan($rsRev[2])."|".Helper::get_id_product($rsRev[3])."|<br/>";
                $cek = Revenue::where("bulan_new",$month[$rsRev[1]])
                ->where("tahun",$rsRev[2])
                ->where("id_kecamatan",Helper::get_id_kecamatan($rsRev[4],$rsRev[3]))
                ->where("id_product",Helper::get_id_product($rsRev[5]))
                ->first();

                if($cek==null){
                    $result = Revenue::create(
                        [
                            "id_kecamatan" => Helper::get_id_kecamatan($rsRev[4],$rsRev[3]),
                            "id_product" => Helper::get_id_product($rsRev[5]),
                            "jml_target" => $rsRev[6],
                            "jml_revenue_old" => $rsRev[7],
                            "jml_revenue_new" => $rsRev[8],
                            "MoM" => $rsRev[9],
                            "YoY" => $rsRev[10],
                            "YtD" => $rsRev[11],
                            "tahun" => $rsRev[2],
                            "bulan_old" => $month[$rsRev[0]],
                            "bulan_new" => $month[$rsRev[1]]

                        ]
                    );
                }else{
                    $result = Revenue::where("id_revenue",$cek->id_revenue)->update(
                        [
                            "jml_target" => $rsRev[6],
                            "jml_revenue_old" => $rsRev[7],
                            "jml_revenue_new" => $rsRev[8],
                            "MoM" => $rsRev[9],
                            "YoY" => $rsRev[10],
                            "YtD" => $rsRev[11],
                        ]
                    );
                }
                // $r =  Helper::get_id_kecamatan($rsRev[3],$rsRev[2]);
                // echo "Line $row : $r  <br/>";

            }
            $row++;
        }
        //Message Success
        $mess = ["type"=>"Data Berhasil Diimport !!!","icon"=>"success","button"=>"Oke"];
        return back()->with($mess);
    }

    function save(Request $req){
        //dd($req->all());
         //Validasi
         $req->validate(
            [
                //Rule
                "jml_target"=>"numeric",
                "jml_revenue_old"=>"required|numeric",
                "jml_revenue_new"=>"required|numeric",
                "MoM"=>"required|numeric",
                "YoY"=>"required|numeric",
                "YtD"=>"required|numeric",
            ],
            [
                //Massage Error
                "jml_target.numeric"=>"Jumlah Target Harus Angka !!!",
                "jml_revenue_old.required"=>"Jumlah Revenue Awal Harus Diisi !!!",
                "jml_revenue_old_.numeric"=>"Jumlah Revenue Awal Harus Angka !!!",
                "jml_revenue_new.required"=>"Jumlah Revenue Akhir Harus Diisi !!!",
                "jml_revenue_new.numeric"=>"Jumlah Revenue Akhir Harus Angka !!!",
                "MoM.required"=>"MoM Harus Diisi !!!",
                "MoM.numeric"=>"MoM Harus Angka !!!",
                "YoY.required"=>"YoY Harus Diisi !!!",
                "YoY.numeric"=>"YoY Harus Angka !!!",
                "YtD.required"=>"YtD Harus Diisi !!!",
                "YtD.numeric"=>"YtD Harus Angka !!!",
            ]
         );
        try{
            //Save Process
            Revenue::UpdateorCreate(
                [
                    "id_revenue"=>$req->input("id_revenue")
                ],
                [
                    "jml_target"=>$req->input("jml_target"),
                    "jml_target"=>$req->input("jml_target"),
                    "jml_revenue_old"=>$req->input("jml_revenue_old"),
                    "jml_revenue_new"=>$req->input("jml_revenue_new"),
                    "id_kecamatan"=>$req->input("id_kecamatan"),
                    "id_product"=>$req->input("id_product"),
                    "MoM"=>$req->input("MoM"),
                    "YoY"=>$req->input("YoY"),
                    "YtD"=>$req->input("YtD"),
                    "tahun"=>$req->input("tahun"),
                    "bulan_old"=>(int)$req->input("bulan_new")-1,
                    "bulan_new"=>$req->input("bulan_new")
                ]
            );
            //Message Success
            $mess=["type"=>"Selamat !!!","text"=>"Data Berhasil Disimpan !!!","icon"=>"success","button"=>"Oke"];
        } catch(Exception $err){
            //Message Error
            $mess=["type"=>"Maaf !!!","text"=>"Data Gagal Disimpan !!!","icon"=>"error","button"=>"Oke"];
        }
        //Redirect
        return back()->with($mess);
    }

    //Delete Data
    function delete(Request $req){
        try{
            Revenue::where("id_revenue",$req->id)->delete();
            //Message Success
            $mess=["type"=>"Selamat !!!","text"=>"Data Berhasil Dihapus !!!","icon"=>"success","button"=>"Oke"];
        } catch(Exception $err){
            //Message Error
            $mess=["type"=>"Maaf !!!","text"=>"Data Gagal Dihapus !!!","icon"=>"error","button"=>"Oke"];
        }
        //Redirect
        return back()->with($mess);
    }

    //Detail Revenue
    function detail_dls(Request $req){
        $product =  DB::select("SELECT * FROM table_product WHERE id_product NOT IN (select id_product FROM table_revenue_cluster WHERE id_cluster=".$req->id_cluster." And tahun=".$req->tahun." And bulan_new =".(int)$req->bulan.")");

        $revenue_dls = DB::table("table_revenue_cluster")
        ->join("table_cluster","table_revenue_cluster.id_cluster","=","table_cluster.id_cluster")
        ->join("table_product","table_revenue_cluster.id_product","=","table_product.id_product")
        ->select("table_revenue_cluster.*","table_cluster.nm_cluster","table_product.nm_product")
        ->where("table_cluster.id_cluster",$req->id_cluster)
        ->where("table_revenue_cluster.bulan_new",(int)$req->bulan)
        ->where("table_revenue_cluster.tahun",$req->tahun)
        ->get(); 

        $rsbulan = DB::table("table_revenue_cluster")
        ->select("table_revenue_cluster.bulan_old","table_revenue_cluster.bulan_new")
        ->where("table_revenue_cluster.id_cluster",$req->id_cluster)
        ->where("table_revenue_cluster.bulan_new",(int)$req->bulan)
        ->where("table_revenue_cluster.tahun",$req->tahun)
        ->groupBy("table_revenue_cluster.bulan_old","table_revenue_cluster.bulan_new")
        ->first();  
        // dd($rsbulan);   

        $bulan = [1=>"Januari",2=>"Februari",3=>"Maret",4=>"April",5=>"Mei",6=>"Juni",7=>"Juli",8=>"Agustus",9=>"September",10=>"Oktober",11=>"November",12=>"Desember"];

        //Data Revenue
        $data=[
            "title"=>"Data Revenue Cluster",
            "page_title"=>"Data Revenue Cluster",
            "product"=>$product,
            "revenue_dls"=>$revenue_dls,
            "id_cluster"=>$req->id_cluster,
            "tahun"=>$req->tahun,
            "bulan_new"=>$req->bulan,
            "t_bulan_old"=>isset($rsbulan->bulan_old) ? $bulan[$rsbulan->bulan_old] : "Bulan Lama",
            "t_bulan_new"=>isset($rsbulan->bulan_new) ? $bulan[$rsbulan->bulan_new] : "Bulan Baru",
        ];
        return view("revenue.data_revenue_dls",$data);
    }

    //Form Input Tanggal Dls
    function form_dls(Request $req){
        $data=[
            "title"=>"Input Bulan dan Tahun",
            "page_title"=>"Input Bulan dan Tahun",
            "rsRev"=>Revenue_Dls::where("id_revenue",$req->id)->first()
        ];
        return view("revenue.form_tahun_dls",$data);
    }

    //Form Import
    function import_dls(){
        $data=[
            "title"=>"Import Data Cluster",
            "page_title"=>"Import Data  Cluster"
        ];
       return view("revenue.import_dls",$data);
    }

    //Pilih Cluster
    function rev_clus(Request $req){
        $date = explode("-",$req->input("month"));
        $clus =  DB::table("table_cluster")
        ->select("table_cluster.*")
        ->get();

        //Data Revenue
        $data=[
            "title"=>"Data Cluster",
            "page_title"=>"Data Cluster",
            "cluster"=>$clus,
            "tahun"=>$date[0],
            "bulan"=>$date[1]
        ];
        return view("revenue.data_cluster",$data);
    }

    //Import Data Dls
    function import_cluster(Request $req){
        $data =  Excel::toArray([],$req->file("data_revenue_dls"));
        // dd($data[1]);
        $rev_clus = $data[1]; // Sheet 2
        $row = 0;
        $month = ["Januari"=>1,"Februari"=>2,"Maret"=>3,"April"=>4,"Mei"=>5,"Juni"=>6,"Juli"=>7,"Agustus"=>8,"September"=>9,"Oktober"=>10,"November"=>11,"Desember"=>12];
        foreach($rev_clus as $rsCluster){
            if($row>0){
                // echo $rsRev[0]."|".$rsRev[1]."|".Helper::get_id_cluster($rsRev[2])."|".Helper::get_id_product($rsRev[3])."|<br/>";
                $cek = Revenue_Dls::where("bulan_new",$month[$rsCluster[1]])
                ->where("tahun",$rsCluster[2])
                ->where("id_cluster",Helper::get_id_cluster($rsCluster[3]))
                ->where("id_product",Helper::get_id_product($rsCluster[4]))
                ->first();
        
                if($cek==null){
                    $result = Revenue_Dls::create(
                        [
                            "id_cluster" => Helper::get_id_cluster($rsCluster[3]),
                            "id_product" => Helper::get_id_product($rsCluster[4]),
                            "jml_target" => $rsCluster[5],
                            "jml_revenue_old" => $rsCluster[6],
                            "jml_revenue_new" => $rsCluster[7],
                            "MoM" => $rsCluster[8],
                            "YoY" => $rsCluster[9],
                            "YtD" => $rsCluster[10],
                            "tahun" => $rsCluster[2],
                            "bulan_old" => $month[$rsCluster[0]],
                            "bulan_new" => $month[$rsCluster[1]]

                        ]
                    );
                }else{
                    $result = Revenue_Dls::where("id_revenue",$cek->id_revenue)->update(
                        [
                            "jml_target" => $rsCluster[5],
                            "jml_revenue_old" => $rsCluster[6],
                            "jml_revenue_new" => $rsCluster[7],
                            "MoM" => $rsCluster[8],
                            "YoY" => $rsCluster[9],
                            "YtD" => $rsCluster[10],
                        ]
                    );
                }
                // $r =  Helper::get_id_kecamatan($rsRev[3],$rsRev[2]);
                // echo "Line $row : $r  <br/>";

            }
            $row++;
        }
        //Message Success
        $mess=["type"=>"Data Berhasil Diimport !!!","icon"=>"success","button"=>"Oke"];
        
        return back()->with($mess);
    }

    function save_dls(Request $req){
        // dd($req->all());
         //Validasi
         $req->validate(
            [
                //Rule
                "jml_target"=>"numeric",
                "jml_revenue_old"=>"required|numeric",
                "jml_revenue_new"=>"required|numeric",
                "MoM"=>"required|numeric",
                "YoY"=>"required|numeric",
                "YtD"=>"required|numeric",
            ],
            [
                //Massage Error
                "jml_target.numeric"=>"Jumlah Target Harus Angka !!!",
                "jml_revenue_old.required"=>"Jumlah Revenue Awal Harus Diisi !!!",
                "jml_revenue_old.numeric"=>"Jumlah  Awal Harus Angka !!!",
                "jml_revenue_new.required"=>"Jumlah Revenue Akhir Harus Diisi !!!",
                "jml_revenue_new.numeric"=>"Jumlah  Akhir Harus Angka !!!",
                "MoM.required"=>"MoM Harus Diisi !!!",
                "MoM.numeric"=>"MoM Harus Angka !!!",
                "YoY.required"=>"YoY Harus Diisi !!!",
                "YoY.numeric"=>"YoY Harus Angka !!!",
                "YtD.required"=>"YtD Harus Diisi !!!",
                "YtD.numeric"=>"YtD Harus Angka !!!",
            ]
         );
        try{
            //Save Process
            Revenue_Dls::UpdateorCreate(
               
                [
                    "id_revenue"=>$req->input("id_revenue")
                ],
                [
                    "jml_target"=>$req->input("jml_target"),
                    "jml_target"=>$req->input("jml_target"),
                    "jml_revenue_old"=>$req->input("jml_revenue_old"),
                    "jml_revenue_new"=>$req->input("jml_revenue_new"),
                    "id_cluster"=>$req->input("id_cluster"),
                    "id_product"=>$req->input("id_product"),
                    "MoM"=>$req->input("MoM"),
                    "YoY"=>$req->input("YoY"),
                    "YtD"=>$req->input("YtD"),
                    "tahun"=>$req->input("tahun"),
                    "bulan_old"=>(int)$req->input("bulan_new")-1,
                    "bulan_new"=>$req->input("bulan_new")
                ]
            );
            //Message Success
            $mess=["type"=>"Selamat !!!","text"=>"Data Berhasil Disimpan !!!","icon"=>"success","button"=>"Oke"];
        } catch(Exception $err){
            //Message Error
            $mess=["type"=>"Maaf !!!","text"=>"Data Gagal Disimpan !!!","icon"=>"error","button"=>"Oke"];
        }
        //Redirect
        return back()->with($mess);
    }

    //Delete Data Dls
    function deletedls(Request $req){        
        try{
            Revenue_Dls::where("id_revenue",$req->id)->delete();
            //Message Success
            $mess=["type"=>"Selamat !!!","text"=>"Data Berhasil Dihapus !!!","icon"=>"success","button"=>"Oke"];
        } catch(Exception $err){
            //Message Error
            $mess=["type"=>"Maaf !!!","text"=>"DataGagal Disimpan !!!","icon"=>"error","button"=>"Oke"];
        }
        //Redirect
        return back()->with($mess);
    }
}
