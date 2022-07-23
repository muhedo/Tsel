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
            <button type="button" class="btn btn-primary" id="button" data-toggle="modal" data-target="#modal-tambah" onclick="clear_cluster()">
              <i class="fa fa-plus"></i> Tambah Data
            </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body" id="form">
            <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Nama Cluster</th>
                <th>Kategori</th>
                <th width="18%">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($cluster as $rsCluster)
                    <tr>
                        <td>{{ $rsCluster["nm_cluster"]}}</td>
                        <td>{{ $rsCluster["kat_cluster"]}}</td>
                        <td style="text-align: center">
                        <a href="javascript:void(0)" class="btn btn-warning btn-flat btn-sm" data-toggle="modal" data-target="#modal-tambah" onclick="edit_cluster('{{ $rsCluster["id_cluster"] }}','{{ $rsCluster["nm_cluster"] }}','{{ $rsCluster["kat_cluster"]}}')"><i class="fa fa-edit"></i> edit</a>
                        <a href="{{ url('cluster/delete/'.$rsCluster["id_cluster"]) }}" class="btn btn-danger btn-flat btn-sm" onclick="return confirmDelete(this)"><i class="fa fa-trash"></i> delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>    
    <!-- /.card-body -->
    <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{$rsCluster->id_cluster!= "" ? "Edit" : "Tambah"}} Data Cluster</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{url('cluster/save')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nm_cluster">Nama Cluster</label>
                                <input type="hidden" name="id_cluster" id="id_cluster">
                                <input type="text" class="form-control @error("nm_cluster") is-invalid  @enderror" id="nm_cluster" name="nm_cluster" placeholder="Nama Cluster">
                                @error("nm_cluster")
                                    <span id="error-nm_cluster" class="error invalid-feedback">
                                        {{ $errors->first("nm_cluster") }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="kat_cluster">Kategori Cluster</label>
                                <input type="text" class="form-control @error("kat_cluster") is-invalid  @enderror" id="kat_cluster" name="kat_cluster" placeholder="Kategori Cluster">
                                @error("kat_cluster")
                                    <span id="error-kat_cluster" class="error invalid-feedback">
                                        {{ $errors->first("kat_cluster") }}
                                    </span>
                                @enderror
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
