@extends('master')

@section('content')
<div class="card shadow">
    <div class="card-body">
        <h3 class="card-title text-center">Ajouter un nouvel élément dans un arbre</h3>
        <h6 class="card-subtitle mb-2 text-muted text-center">{{$name}}</h6>
        <div class="card-text mt-5">

            <div class="form-group row">
                <div class="col-sm-10 col-md-6">
                    <div class="alert alert-danger" role="alert" id="error" style="display:none">
                    </div>
                    <div class="alert alert-success" role="alert" id="success" style="display:none">
                    </div>
                </div>
            </div>

            <div class="mt-5" id="tree_roots">

                <div class="form-group row">
                    <div class="col-sm-6 col-md-6">
                        <div class="input-group mb-3">
                            <div class="alert alert-primary d-flex align-items-center" role="alert">
                                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                    </symbol>
                                </svg>
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">
                                    <use xlink:href="#info-fill" />
                                </svg>
                                <div>
                                    Remarque : Pour ajouter un nœud à la racine
                                    Vous devez d'abord choisir la racine dans la liste des racines, puis écrire le nœud dans le champ d'écriture, puis cliquer sur Ajouter
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="roots" class="col-sm-2 col-form-label">Les racines</label>
                    <div class="col-sm-10 col-md-4">
                        <div class="input-group mb-3">
                            <select class="form-select" aria-label="" id="roots">
                                {!!$data!!}
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="node" class="col-sm-2 col-form-label">Nœud</label>
                    <div class="col-sm-10 col-md-4">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa fa-first-order"></i></i></span>
                            <input id="node" name="node" placeholder="nœud" type="text" class="form-control" required="required">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-2 col-4">
                        <button type="button" id="add_tree_root" class="btn btn-primary">Ajouter un nœud</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    var tree_id = "{{$id}}";
    var level = 0;
    var parent_order = 0;
    var order = 0;
    var grandfather_order = 0;
    var list_node = [];

    $('#add_tree_root').click(function() {

        $('#error').hide();
        $('#success').hide();

        var value_root = $('#roots option:selected').val();
        var value_root_array = value_root.split('-');
        var i = 0;
        var symbole = '';

        level = parseInt(value_root_array[0]) + 1;
        parent_order = parseInt(value_root_array[2]);
        order = 0;
        grandfather_order = parseInt(value_root_array[1]);

        while (true) {
            if (list_node.includes(level + '-' + parent_order + '-' + parseInt(order + i) + '-' + grandfather_order)) {
                i++;
            } else {
                order = i;
                break;
            }
        }

        for (var i = 0; i < level; i++) {
            symbole += "______";
        }

        list_node.push(level + '-' + parent_order + '-' + order + '-' + grandfather_order);
        $('#' + $('#roots option:selected').val()).after('<option value="' + level + '-' + parent_order + '-' + order + '-' + grandfather_order + '" id="' + level + '-' + parent_order + '-' + order + '-' + grandfather_order + '">' + symbole + ' ' + $('#node').val() + '</option>')

        $.ajax({
            url: "{{url('add-tree-node')}}",
            type: "post",
            data: {
                tree: tree_id,
                node: $('#node').val(),
                value: level + '-' + parent_order + '-' + order + '-' + grandfather_order,
                _token: "{{csrf_token()}}",
            },
            success: function(result) {
                if (result['result'] == 1) {

                    $('#success').text(result['message']);
                    $('#success').show();

                } else {
                    $('#error').text(result['message']);
                    $('#error').show();
                }
                console.log(result['result'])
            }
        })
    });
</script>
@stop