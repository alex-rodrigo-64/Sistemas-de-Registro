@extends('layouts.app')

@section('content')


    
    <form action="{{url('/personalAcademico')}}" class="form-horizontal" method="post" enctype="multipart/form-data">

        {{ csrf_field()}}

        <div class="form-group">
            <label for="Nombre" class="control-label">{{'Nombre'}}</label>
            <input type="text" class="form-control" name="nombre" id="nombre" 
            value="{{ isset($personal->nombre)?$personal->nombre:old('Nombre') }}"
            >
        
        <div class="form-group">
            <label for="Apellido"class="control-label">{{'Apellido'}}</label>
            <input type="text" class="form-control" name="apellido" id="apellido" 
            value="{{ isset($personal->apellido)?$personal->apellido:'' }}"
            >
        </div>
        
        <div class="form-group">
            <label for="CodigoSis"class="control-label">{{'Codigo sis'}}</label>
            <input type="text" class="form-control" name="codigoSis" id="codigoSis" 
            value="{{ isset($personal->codigoSis)?$personal->codigoSis:'' }}"
            >
        </div>
            
            
            <div class="form-group">
                <label for="Correo"class="control-label">{{'Correo'}}</label>
                <input type="email" class="form-control" name="email" id="email" 
                value="{{ isset($personal->email)?$personal->email:'' }}"
                >
            </div>

            <div class="form-group">
                <label for="Cargo">Cargo</label>
                <select name="rol" class="form-control">
                <option selected disabled>Elige un rol para este Usuario</option>
                @foreach ($roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="Telefono"class="control-label">{{'Telefono'}}</label>
                <input type="text" class="form-control" name="telefono" id="telefono" 
                value="{{ isset($personal->telefono)?$personal->telefono:'' }}"
                >
            </div>

            <div class="form-group">
                <label for="Contraseña"class="control-label">{{'Contraseña'}}</label>
                <input type="text" class="form-control" name="password" id="password" 
                value="{{ isset($personal->password)?$personal->password:'' }}"
                >
            </div>
            
            <input type="submit" class="btn btn-success" >
            <a href="{{url('personalAcademico')}}"class="btn btn-primary">Regresar</a>

    </form>


@endsection