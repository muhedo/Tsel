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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah" onclick="clear_product()">
              <i class="fa fa-plus"></i> Tambah Data
            </button>
        </div>
       <div class="col-sm-12">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nama Product</th>
                <th width="18%">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($product as $rsProduct)
                    <tr>
                        <td>{{ $rsProduct["nm_product"]}}</td>
                        <td style="text-align: center">
                          <a href="javascript:void(0)" class="btn btn-warning btn-flat btn-sm" data-toggle="modal" data-target="#modal-tambah" onclick="edit_product('{{ $rsProduct["id_product"] }}','{{ $rsProduct["nm_product"] }}')"><i class="fa fa-edit"></i> edit</a>
                          <a href="{{ url('product/delete/'.$rsProduct["id_product"]) }}" class="btn btn-danger btn-flat btn-sm" onclick="return confirmDelete(this)"><i class="fa fa-trash"></i> delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
       </div>
    </div>  
    <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Data Product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{url('product/save')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body">
                          <div class="form-group">
                            <label for="nm_product">Nama Product</label>
                            <input type="hidden" name="id_product" id="id_product">
                            <input type="text" class="form-control @error("nm_product") is-invalid  @enderror" id="nm_product" name="nm_product" placeholder="Nama Product">
                            @error("nm_product")
                                <span id="error-nm_product" class="error invalid-feedback">
                                    {{ $errors->first("nm_product") }}
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
