<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tareas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-3">
        @if (session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
        @endif
        <h1 class="mb-3">Lista de tareas</h1>
        <a href="{{url('ver_formulario')}}" class="btn btn-success">Nueva tarea</a>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Materia</th>
                    <th>Fecha de Entrega</th>
                    <th>Creado</th>
                    <th>Actualizado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tareas as $tarea)
                <tr>
                    <td>{{$tarea->id}}</td>
                    <td>{{$tarea->nombre}}</td>
                    <td>{{$tarea->descripcion}}</td>
                    <td>{{$tarea->materia}}</td>
                    <td>{{$tarea->fecha_entrega}}</td>
                    <td>{{$tarea->created_at}}</td>
                    <td>{{$tarea->updated_at}}</td>
                    <td class="d-flex gap-3">
                        <!-- Botón para abrir el modal de edición -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{$tarea->id}}">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </button>

                        <!-- Modal de edición -->
                        <div class="modal fade" id="editModal{{$tarea->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Editar Tarea</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('update_tarea', $tarea->id)}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="nombre">Nombre:</label>
                                                <input type="text" value="{{$tarea->nombre}}" name="nombre" id="nombre" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="descripcion">Descripción:</label>
                                                <textarea name="descripcion" id="descripcion" class="form-control">{{$tarea->descripcion}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="materia">Materia:</label>
                                                <input type="text" value="{{$tarea->materia}}" name="materia" id="materia" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="fecha_entrega">Fecha de Entrega:</label>
                                                <input type="date" value="{{$tarea->fecha_entrega}}" name="fecha_entrega" id="fecha_entrega" class="form-control">
                                            </div>
                                            <button type="submit" class="btn btn-primary mt-3">Guardar</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="{{route('delete_tarea', $tarea->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button>
                        </form>
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewModal{{$tarea->id}}">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </button>

                        <!-- Modal de vista de detalles -->
                        <div class="modal fade" id="viewModal{{$tarea->id}}" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel{{$tarea->id}}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewModalLabel{{$tarea->id}}">Detalles de la tarea</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Nombre:</strong> {{$tarea->nombre}}</p>
                                        <p><strong>Descripción:</strong> {{$tarea->descripcion}}</p>
                                        <p><strong>Materia:</strong> {{$tarea->materia}}</p>
                                        <p><strong>Fecha de Entrega:</strong> {{$tarea->fecha_entrega}}</p>
                                        <p><strong>Creado:</strong> {{$tarea->created_at}}</p>
                                        <p><strong>Actualizado:</strong> {{$tarea->updated_at}}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{$tareas->links()}}
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>