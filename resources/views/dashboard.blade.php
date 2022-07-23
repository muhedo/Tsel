@extends("layouts.template")

@section("title",$title)
    
@section("page_title",$title)
    
@section('content')
<div class="d-flex justify-content-end py-2">
    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-tambah">
      <i class="fa fa-filter"></i> Filter
    </button>
</div>
@if($rev[0]["data"]->count()>0)
<div class="data-revenue-cluster" style="white-space:nowrap; overflow-x: scroll;
    overflow-y: hidden;">
    @foreach ($rev as $revItem)
    <div style="display: inline-block">
        <table class="table">
            <thead>
                <tr class="bg" style="background-color: #800000">
                    <th colspan="7" class="text-light text-center">{{ $revItem["title"] }}</th>
                </tr>
            <tr>
                {{-- <th>Nama Kecamatan</th> --}}
                @php
                    $dt = $loop->index;
                @endphp
                @if($dt==0)
                <th>Nama Cluster</th>
                @endif
                <th>Jumlah Target</th>
                <th>{{ $t_bulan_old }}</th>
                <th>{{ $t_bulan_new }}</th>
                <th>%MoM</th>
                <th>%YoY</th>
                <th>%YtD</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($revItem["data"] as $revenue)
                    <tr>
                        @if($dt==0)
                        <td>{{ $revenue->nm_cluster }}</td>
                        @endif
                        <td>{{  number_format($revenue->jml_target,"0",",",".") }}</td>
                        <td>{{  number_format($revenue->jml_revenue_old,"0",",",".") }}</td>
                        <td>{{  number_format($revenue->jml_revenue_new,"0",",",".") }}</td>
                        <td class="{{$revenue->MoM > 0 ? 'text-success' : 'text-danger' }}">{{  number_format((float)$revenue->MoM * 100,"1",",",".") . '%' }}</td>
                        <td class="{{$revenue->YoY > 0 ? 'text-success' : 'text-danger' }}">{{  number_format((float)$revenue->YoY * 100,"1",",",".") . '%' }}</td>
                        <td class="{{$revenue->YtD > 0 ? 'text-success' : 'text-danger' }}">{{ number_format((float)$revenue->YtD * 100,"1",",",".") . '%' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endforeach
</div>
@else

{{-- Jika Kosong --}}
    <div class="alert alert-danger d-flex align-items-center" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </svg>
        <div style="font-size: 20px">
         &nbsp; Data Kosong Masukkan Bulan dan Tahun Secara Benar !!!
        </div>
    </div>
@endif
<div class="modal fade" id="modal-tambah" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title">Filter Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{url('/')}}" method="post" id="form_rev">
                @csrf
                <div class="modal-body" style="background-color: beige">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h6><strong>Bulan</strong></h6>
                                <select class="custom-select rounded-0" name="bulan" value="" required>
                                    <option selected>-- Pilih Bulan --</option>
                                    @foreach($bulan as $k => $v)
                                    <option value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h6><strong>Tahun</strong></h6>
                                <select class="custom-select rounded-0" name="tahun" id="" required>
                                   <option value="">-- Pilih Tahun --</option>
                                        <?php
                                            $now=date('Y');
                                            for ($a=2012;$a<=$now;$a++)
                                            {
                                                echo "<option value='$a'>$a</option>";
                                            }
                                        ?>
                                </select>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between bg-danger">
                    <button type="submit" class="btn btn-warning">Load</button>
                </div>
            </form>
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>
    $(function(){
        @if($errors->any())
        showMessage("Terjadi Kesalahan !","Data Gagal Disimpan","error","Oke");
        var mymodal = new bootstrap.Modal(document.getElementById("modal-tambah"));
        mymodal.show();
        @endif
    });
  </script>
@endsection