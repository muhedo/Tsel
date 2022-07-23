{{-- @extends('layouts.template')

@section('title',$title)
    
@section('page_title',$page_title)
    
@section('content')
    <script>
        $(function(){
            @if(session("type"))
                showMessage('{{ session("type") }}','{{ session("text") }}');
            @endif
        });
    </script>
    <div class="card">
        <div class="card-body">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah" onclick="clear_dls()">
              <i class="fa fa-plus"></i> Tambah Data
            </button>
        </div>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Bulan</th>
                <th width="18%">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($dls as $rsDls)
                    <tr>
                        <td>{{ $rsDls["bulan"]}}</td>
                        <td style="text-align: center">
                          <a href="javascript:void(0)" class="btn btn-warning btn-flat btn-sm" data-toggle="modal" data-target="#modal-tambah" onclick="edit_dls('{{ $rsDls["id_dls"] }}','{{ $rsDls["bulan"] }}')"><i class="fa fa-edit"></i> edit</a>
                          <a href="{{ url('dls/delete/'.$rsDls["id_dls"]) }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-trash"></i> delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>  
    <div class="modal fade" id="modal-tambah">
        <script>
          $(function(){
              @if($errors->any())
              showMessage("error","Terjadi Kesalahan !");
              @endif
          });
        </script>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{$rsDls->id_dls!= "" ? "Edit" : "Tambah"}} Data Dls</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{url('dls/save')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body">
                          <div class="form-group">
                            <label for="bulan">Bulan</label>
                            <input type="hidden" name="id_dls" id="id_dls">
                            <input type="text" class="form-control @error("bulan") is-invalid  @enderror" id="bulan" name="bulan" placeholder="Nama Bulan">
                            @error("bulan")
                                <span id="error-bulan" class="error invalid-feedback">
                                    {{ $errors->first("bulan") }}
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

@endsection --}}
