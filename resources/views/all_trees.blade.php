@extends('master')

@section('content')

@php
use App\Models\Tree;
use App\Models\TreeRoot;
@endphp

<div class="card shadow">
    <div class="card-body">
        <h3 class="card-title text-center">Tous les arbres</h3>
        <div class="card-text mt-5">

            <div class="form-group row">
                <div class="col-sm-10 col-md-6">
                    @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('success') !!}</li>
                        </ul>
                    </div>
                    @endif
                    @if (\Session::has('error'))
                    <div class="alert alert-danger">
                        <ul>
                            <li>{!! \Session::get('error') !!}</li>
                        </ul>
                    </div>
                    @endif
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Nom de l'arbre</th>
                            <th scope="col">Premier nom racine</th>
                            <th scope="col">Nombre de nœuds</th>
                            <th scope="col">Date créée</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Tree::all() as $tree)
                        <tr>
                            <th scope="row">{{$tree->id}}</th>
                            <td>{{$tree->name}}</td>
                            <td>{{TreeRoot::where([['tree', '=', $tree->id], ['level', '=', 0], ['parent_order', '=', 0]])->first()['root']}}</td>
                            <td>{{TreeRoot::where([['tree', '=', $tree->id]])->count()}}</td>
                            <td>{{$tree->created_at}}</td>
                            <td>
                                <a href="{{url('show-tree')}}/{{$tree->id}}" class="btn btn-primary btn-sm m-1"><i class="fa fa-tree"></i></a>
                                <a href="{{url('edit-tree')}}/{{$tree->id}}" class="btn btn-warning btn-sm m-1"><i class="fa fa-edit"></i></a>
                                <button id="btn-delete-tree" type="button" class="btn btn-danger btn-sm m-1" data-bs-toggle="modal" data-bs-target="#delete-tree" data-id="{{$tree->id}}" data-name="{{$tree->name}}"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="delete-tree">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Supprimer l'arbre <span id="tree-name"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Voulez-vous vraiment supprimer cet arbre de la base de données ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <a href="" class="btn btn-danger" id="btn-confirm-delete-tree">Supprimer</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '#btn-delete-tree', function() {
        console.log($(this).data('id'))
        $('#btn-confirm-delete-tree').attr('href', "{{url('delete-tree')}}/" + $(this).data('id'));
        $('#tree-name').text($(this).data('name'));
    });
</script>

@stop