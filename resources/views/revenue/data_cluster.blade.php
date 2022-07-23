@extends('layouts.template')

@section('title',$title)
    
@section('page_title',$page_title)

@section('content')
<p>Revenue : {{ $tahun."-".$bulan }}</p>
<div class="card">
    <div class="card-body m-0">

    </div>
   <div class="col-sm-12">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
              <th>Nama Cluster</th>
              <th width="18%">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($cluster as $Clus)
                <tr>
                    <td>{{ $Clus->nm_cluster}}</td>
                    <td style="text-align: center">
                        {{-- <a href="{{ url('revenue/kec/'.$Kec->id_kecamatan."/".$tahun."/".$bulan) }}" class="btn btn-warning btn-flat btn-sm"><i class="fa fa-edit"></i></a> --}}
                    <a href="{{ url ('/revenue/dls'."/".$Clus->id_cluster."/".$tahun."/".$bulan) }}"  class="btn btn-warning btn-flat btn-sm"><i class="fa fa-edit"></i>detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
   </div>
</div>
@endsection