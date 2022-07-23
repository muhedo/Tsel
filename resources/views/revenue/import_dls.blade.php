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
    <form action="{{url('revenue/import/cluster')}}" method="post" enctype="multipart/form-data" onsubmit="showPreload()">
        @csrf
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="data_revenue_dls" id="file">
            <label class="custom-file-label" for="file">Pilih File</label>
        </div>
        <button type="submit" class="btn btn-primary mt-3" style="float: right">Simpan</button>
    </form>
    <a href="{{ asset ('Template/Template.xlsx') }}" class="btn btn-primary mt-3"><i class="fas fa-download"></i> Download Template</a>
@endsection