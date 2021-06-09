<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Évaluation-Arbre</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{url('/')}}/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{url('/')}}/css/style.css" rel="stylesheet">




    <!-- Js -->
    <script src="{{url('/')}}/js/jquery-3.6.0.min.js"></script>
    <script src="{{url('/')}}/js/bootstrap.min.js"></script>
    <script src="{{url('/')}}/js/bootstrap.bundle.js"></script>


</head>

<body>

    <!-- navbar -->

    <nav class="navbar navbar-dark bg-dark shadow p-3 mb-5">
        <div class="container-fluid">

            <a class="navbar-brand" href="{{url('/')}}">Évaluation-Arbre</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{url('/')}}"><i class="fa fa-home"></i> page d'accueil</a>
                        <a class="nav-link" aria-current="page" href="{{url('add-tree')}}"><i class="fa fa-tree"></i> Ajouter un nouvel arbre</a>
                        <a class="nav-link" aria-current="page" href="{{url('all-trees')}}"><i class="fa fa-list"></i> Tous les arbres</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <!-- navbar -->

    <div class="container-fluid p-4">
        @yield('content')
    </div>

</body>

</html>