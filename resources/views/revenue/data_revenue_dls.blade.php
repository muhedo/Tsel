@extends('layouts.template')

@section('title',$title)
    
@section('page_title',$page_title)
    
@section('content')
    <script>
        $(function(){
            @if(session("type"))
            showMessage('{{ session("type") }}','{{ session("text") }}','{{ session("icon") }}','{{ session("button") }}');
            @endif
        });
    </script>
    <div class="card">
        <div class="card-body">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah" onclick="clear_target()">
              <i class="fa fa-plus"></i> Tambah Data
            </button>
        </div>
        <div class="col-sm-12">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    {{-- <th>Nama Kecamatan</th> --}}
                    <th>Nama Product</th>
                    <th>Jumlah Target</th>
                    <th>{{ $t_bulan_old }}</th>
                    <th>{{ $t_bulan_new }}</th>
                    <th>%MoM</th>
                    <th>%YoY</th>
                    <th>%YtD</th>
                    <th width="18%">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($revenue_dls as $Revenue)
                        <tr>
                            {{-- <td>{{ $Revenue->nm_kecamatan }}</td> --}}
                            <td>{{ $Revenue->nm_product }}</td>
                            <td>{{  number_format($Revenue->jml_target,"0",",",".") }}</td>
                            <td>{{  number_format($Revenue->jml_revenue_old,"0",",",".") }}</td>
                            <td>{{  number_format($Revenue->jml_revenue_new,"0",",",".") }}</td>
                            <td class="{{$Revenue->MoM > 0 ? 'text-success' : 'text-danger' }}">{{  number_format((float)$Revenue->MoM * 100,"1",",",".") . '%' }}</td>
                            <td  class="{{$Revenue->YoY > 0 ? 'text-success' : 'text-danger' }}">{{  number_format((float)$Revenue->YoY * 100,"1",",",".") . '%' }}</td>
                            <td  class="{{$Revenue->YtD > 0 ? 'text-success' : 'text-danger' }}">{{ number_format((float)$Revenue->YtD * 100,"1",",",".") . '%' }}</td>
                            <td style="text-align: center">
                              <a href="javascript:void(0)" class="btn btn-warning btn-flat btn-sm" data-toggle="modal" data-target="#modal-tambah" onclick="edit_target('{{ $Revenue->id_revenue }}','{{ $Revenue->id_product }}','{{ $Revenue->jml_target }}','{{ $Revenue->jml_revenue_new }}','{{ $Revenue->MoM}}','{{ $Revenue->YoY }}','{{ $Revenue->YtD }}')"><i class="fa fa-edit"></i> edit</a>
                              <a href="{{ url('rev/hapus/delete/'.$Revenue->id_revenue) }}" class="btn btn-danger btn-flat btn-sm" onclick="return confirmDelete(this)"><i class="fa fa-trash"></i> delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>  

    <div class="modal fade" id="modal-tambah" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Data Revenue DLS</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{url('/revenue/dls/save')}}" method="post" id="form_rev">
                    @csrf
                    <input type="hidden" name="id_cluster" value="{{$id_cluster}}">
                    <input type="hidden" name="tahun" value="{{$tahun}}">
                    <input type="hidden" name="bulan_new" value="{{@$bulan_new}}">
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="form-group" id="list_product">
                                <label for="nm_product">Nama Product</label>
                                <select class="custom-select rounded-0" id="id_product" name="id_product" value="">
                                    <option value="">- Pilih Product -</option>
                                    @foreach ($product as $Productku)
                                        <option value="{{ $Productku->id_product }}">{{ $Productku->nm_product }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="jml_target">Jumlah Target</label>
                                        <input type="number" class="form-control @error("jml_target") is-invalid  @enderror" id="jml_target" name="jml_target" placeholder="Jumlah Target">
                                        @error("jml_target")
                                            <span id="error-jml_target" class="error invalid-feedback">
                                                {{ $errors->first("jml_target") }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="jml_revenue_new">Jumlah Revenue Awal</label>
                                        <input type="number" class="form-control @error("jml_revenue_new") is-invalid  @enderror" id="jml_revenue_new" name="jml_revenue_new" placeholder="Jumlah Revenue">
                                        @error("jml_revenue_new")
                                            <span id="error-jml_revenue_new" class="error invalid-feedback">
                                                {{ $errors->first("jml_revenue_new") }}
                                            </span>
                                        @enderror
                                  </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="jml_revenue_old">Jumlah Revenue Akhir</label>
                                        <input type="number" class="form-control @error("jml_revenue_old") is-invalid  @enderror" id="jml_revenue_old" name="jml_revenue_old" placeholder="Jumlah Revenue">
                                        @error("jml_revenue_old")
                                            <span id="error-jml_revenue_old" class="error invalid-feedback">
                                                {{ $errors->first("jml_revenue_old") }}
                                            </span>
                                        @enderror
                                  </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="MoM">%MoM</label>
                                        <input type="number" class="form-control @error("MoM") is-invalid  @enderror" id="MoM" name="MoM" placeholder="%MoM">
                                        @error("MoM")
                                            <span id="error-MoM" class="error invalid-feedback">
                                                {{ $errors->first("MoM") }}
                                            </span>
                                        @enderror
                                  </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="YoY">%YoY</label>
                                        <input type="number" class="form-control @error("YoY") is-invalid  @enderror" id="YoY" name="YoY" placeholder="%YoY">
                                        @error("YoY")
                                            <span id="error-YoY" class="error invalid-feedback">
                                                {{ $errors->first("YoY") }}
                                            </span>
                                        @enderror
                                  </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="YtD">%YtD</label>
                                        <input type="number" class="form-control @error("YtD") is-invalid  @enderror" id="YtD" name="YtD" placeholder="%YtD">
                                        @error("YtD")
                                            <span id="error-YtD" class="error invalid-feedback">
                                                {{ $errors->first("YtD") }}
                                            </span>
                                        @enderror
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
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
