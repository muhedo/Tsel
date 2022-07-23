@extends('layouts.template')

@section('title',$title)
    
@section('page_title',$page_title)

@section('content')
{{-- <p>Revenue : {{ $tahun."-".$bulan }}</p> --}}
<table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
          {{-- <th>Tahun</th>
          <th>Bulan</th> --}}
          <th></th>
          {{-- <th>Target</th>
          <th>Revenue</th> --}}
          <th width="18%">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($product as $Prod)
            <tr>
                {{-- <td>{{ $tahun }}</td>
                <td>{{ $bulan }}</td> --}}
                <td>{{ $Prod->nm_product}}</td>
                <td style="text-align: center">
                    {{-- <a href="{{ url('revenue/kec/'.$Kec->id_kecamatan."/".$tahun."/".$bulan) }}" class="btn btn-warning btn-flat btn-sm"><i class="fa fa-edit"></i></a> --}}
                    <a href="{{ url ('/revenue') }}"></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection