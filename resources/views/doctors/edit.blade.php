@extends('layouts.panel')
@section('styles')  
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">


@endsection
@section('content')




   
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Editar Médico</h3>
                </div>
                <div class="col text-right">
                <a href="{{ url('/doctors') }}" class="btn btn-sm btn-success">Cancelar y volver</a>
                </div>
              </div>
            </div>

            <div class="card body">
            @if($errors->any())
      <div class="alert alert-danger" role="alert">
        <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
      </ul>
     </div>
     @endif
   

            <form role="form" method="POST" action="{{url('/doctors/'.$doctor->id) }}">
        
           
             @csrf
              @method('put')

            <div class="form-group">
           
                <label form="name">Nombre del médico</label>
                <input type="text" name="name" class="form-control" value="{{old('name', $doctor->name)}}" required>
            </div>
          
            <div class="form-group">
                <label form="email">E-mail</label>
                <input type="text" name="email" class="form-control" value="{{old('email',$doctor->email)}}">
            </div>
             <div class="form-group">
                <label form="dni">DNI</label>
                <input type="text" name="dni" class="form-control" value="{{old('dni',$doctor->dni)}}"required>
            </div>
             <div class="form-group">
                <label form="address">Direccion</label>
                <input type="text" name="address" class="form-control" value="{{old('address',$doctor->address)}}">
            </div>
            <div class="form-group">
                <label form="phone">telefono</label>
                <input type="text" name="phone" class="form-control" value="{{old('phone',$doctor->phone)}}">
            </div>
              <div class="form-group">
                <label form="password">Contraseña</label>
                
                <input type="text" name="password" class="form-control" value="">
                <p> Ingrese contraseña nueva si desea modificar </p>
            </div>
            
              <div class="form-group">
                <label form="password">especialidades</label>
                <select name="specialties[]" id="specialties" class="form-control selectpicker" data-style="btn-primary" multiple title=" seleccione una o varias">
                @foreach($specialties as $specialty)
                <option value="{{$specialty->id}}">{{$specialty->name}}</option>
                @endforeach
</select>
 </div>
 
            <button type="submit" class="btn btn-sm btn-default">Guardar</button>
            </form>
          
        </div>
      </div>
@endsection
@section('scripts')
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script>
$(document).ready(()=>{
$('#specialties').selectpicker('val', @json($specialty_ids));
});
</script>
@endsection