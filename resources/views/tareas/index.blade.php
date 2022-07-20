@extends('app')

@section('content')
    <div class="container w-25 border p-4 mt-4">
        <form action="{{route('tareas')}}" method="post">
            @csrf

            @if (session('success'))
            <h6 class="alert alert-success">{{session('success')}}</h6>   
            @endif

            @error('title')
                <h6 class="alert alert-danger">{{$message}}</h6>      
            @enderror
            <div class="mb-3">
                <label for="title" class="form-label">Titulo de la tarea</label>
                <input type="text"  name="title" class="form-control"> 
            </div>
            <label for="category_id" class="form-label">Categoria de la tarea</label>
            <select name="category_id" class="form-select">
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>        
                @endforeach

            </select>
            <button type="submit" class="btn btn-primary">Nueva tarea</button>
        </form>

        <div class="container mt-4">
            @foreach ($tareas as $tarea)
                <div class="row py-1">
                    <div class="col-md-9 d-flex align-items-center">
                        <a href="{{route('tareas-edit', ['id' => $tarea->id])}}">{{$tarea->title}}</a>
                    </div>
                    <div class="col-md-3 d-flex justify-content-end">
                        <form action="{{route('tareas-destroy', [$tarea->id])}}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </form>

                    </div>
                </div>   
            @endforeach
        </div>
    </div>
    
@endsection