@extends('layouts.template')

@section('title',$title)
    
@section('page_title',$page_title)
    
@section('content')
    <form action="{{url('revenue/cluster')}}" method="get">
        <div class="row">
            <div class="col-md-5">
                            
            </div>
            @csrf
            <div class="card">
                <div class="card-body mb-0">
                    <div class="form-group">
                        <label for="month">Bulan</label>
                        <input type="month" name="month" id="month">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-center ml-5 mt-0">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
@endsection