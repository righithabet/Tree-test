@extends('master')

@section('content')

@php
use App\Models\Tree;
use App\Models\TreeRoot;
@endphp

<div class="card shadow">
    <div class="card-body">
        <h3 class="card-title text-center">{{$name}}</h3>
        <h6 class="card-subtitle mb-2 text-muted text-center">Nombre de nœuds: {{$count}}</h6>
        <div class="card-text mt-5">

            <div class="form-group row">
                <div class="col-sm-10 col-md-6">
                    <div class="alert alert-danger" role="alert" id="error" style="display:none">
                    </div>
                    <div class="alert alert-success" role="alert" id="success" style="display:none">
                    </div>
                </div>
            </div>

            <div class="tree offset-1 col-6">
                {!!$data!!}
            </div>

        </div>
    </div>
</div>

@stop