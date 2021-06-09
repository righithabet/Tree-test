@extends('master')

@section('content')
<div class="card shadow text-dark bg-light mb-3">
    <div class="card-header card-header-home">Évaluation-Arbre</div>
    <div class="card-body">
        <h5 class="card-title">Opérations</h5>
        <p class="card-text p-2">Pour effectuer n'importe quelle opération sur un arbre
            Veuillez cliquer sur l'icône dans le coin supérieur droit <i class="fa fa-bars"></i>
            Un menu apparaît, sélectionnez l'opération à effectuer</p>
    </div>
</div>

<div class="card shadow text-dark bg-light mb-3">
    <div class="card-header card-header-home">API Téléchargement de fichier d'arbre</div>
    <div class="card-body">
        <h5 class="card-title">Il renvoie un fichier texte avec l'arbre</h5>
        <p class="card-text p-2">
        <ul>
            <li><b>URL</b></li>
            api/get-tree/:id

            <li class="mt-2"><b>Method</b></li>
            GET
            <li class="mt-2"><b>URL Params</b></li>
            Required
            id=[integer]
            <li class="mt-2"><b>Data Params</b></li>
            None
            <li class="mt-2"><b>Success Response:</b></li>
            Code: 200 </br>
            Télécharger le fichier texte
            <li class="mt-2"><b>Error Response:</b></li>
            Code: 200 </br>
            {"result":0,"message":"Arbre introuvable !"}
        </ul>
        </p>
    </div>
</div>

<div class="card shadow text-dark bg-light mb-3">
    <div class="card-header card-header-home">Détails sur le script</div>
    <div class="card-body">
        <h5 class="card-title">langages de programmation</h5>
        <p class="card-text p-2">
        <ul>
            <li><b>Base de données:</b></li>
            Mysql

            <li class="mt-2"><b>Frontend</b></li>
            HTML, Css,
            <li class="mt-2"><b>Frameworks Frontend</b></li>
            bootstrap,jquery, fontawesome(Library)
            <li class="mt-2"><b>Backend</b></li>
            PHP
            <li class="mt-2"><b>Frameworks Backend</b></li>
            Laravel
        </ul>
        </p>
        <h5 class="card-title mt-5">GITHUB</h5>
        <p class="card-text p-2">
        <ul>
            <li><b>Link</b></li>
            <a href="#"> here</a>
            <li class="mt-2"><b>Documentation</b></li>
            <a href="#"> README.MD</a>
        </ul>
        </p>
    </div>
</div>
@stop