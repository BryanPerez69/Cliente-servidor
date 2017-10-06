@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{route('cal.store')}}" method="POST" role="form">
        {{csrf_field()}}
        <legend>
            Crear evento
        </legend>
        <div class="form-group">
            <label for="title">
                Título
            </label>
            <input class="form-control" name="title" placeholder="Título" type="text">
        </div>
        <div class="form-group">
            <label for="description">
                Descripción
            </label>
            <input class="form-control" name="description" placeholder="Descripción" type="text">
        </div>
        <div class="form-group">
            <label for="start_date">
                Fecha de inicio
            </label>
            <input class="form-control" name="start_date" placeholder="Fecha de inicio" type="text">
        </div>
        <div class="form-group">
            <label for="end_date">
                Fecha de cierre
            </label>
            <input class="form-control" name="end_date" placeholder="Fecha de cierre" type="text">
        </div>
        <button class="btn btn-primary" type="submit">
            Subir
        </button>
    </form>
  </div>
@endsection
