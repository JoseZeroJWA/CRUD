<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD - Jose A. Alas</title>

    <!-- Styles Assets -->
 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
</head>
<body class="d-flex flex-column h-100">

    <header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">CRUD - Jose Alas</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

            </div>
        </nav>
    </header>

    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container mt-5 pt-5">
            @if(session('message'))
                <div class="row">
                    <div class="col mx-auto">
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    </div>
                </div>
            @endif
            @if ($errors->any())
                <div class="row">
                    <div class="col mx-auto">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-2 mx-auto">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalP">Agregar <i class="bi bi-plus"></i></button>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col">
                    <div class="">
                        <div class="table-responsive">
                            <table class="table table-primary">
                                <thead>
                                    <tr>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $key => $user)
                                        <tr class="">
                                            <td scope="row">{{$user->nombre}}</td>
                                            <td>
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalE" onclick="edit({{json_encode($user->nombre)}}, {{json_encode($user->id)}})">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <a type="button" class="btn btn-danger" href="{{url('/destroy/'.$user->id)}}">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal Agregar -->
        <div class="modal fade" id="modalP" tabindex="-1" aria-labelledby="modalP" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalP">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{url('/store')}}" id="pForm">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="nameP" placeholder="Nombre" name="nombre">
                                        <label for="nameP">Nombre</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" form="pForm">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Agregar FIN -->

        <!-- Modal Actualizar -->
        <div class="modal fade" id="modalE" tabindex="-1" aria-labelledby="modalE" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalE">ACTUALIZAR</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="" id="eForm">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="nameE" placeholder="Nombre" name="nombre">
                                        <label for="nameE">Nombre</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" form="eForm">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">Jose Antonio Alas Alvarenga.</span>
        </div>
    </footer>


    <!-- Scripts Assets -->
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        'use strict';

        let edit = (value, id) => {
            const inp = document.getElementById('nameE');
            const form = document.getElementById('eForm');
            inp.value = value;

            form.action = '/edit/'+id;
        };
    </script>
</body>
</html>
