@extends('layouts.panel')

@section('content')




   
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h4 class="mb-0">Registrar nueva Cita</h4>
                </div>
                <div class="col text-right">
                <a href="{{ url('/patients') }}" class="btn btn-sm btn-success">Cancelar y volver</a>
                </div>
              </div>
            </div>

            <div class="card body">
            @if ($errors->any())
      <div class="alert alert-danger" role="alert">
        <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
     </div>
     @endif

<form role="form" method="POST" action="{{url('appointments') }}">
           @csrf
<div class="form-group">
  <label for="description">Descripción</label>
              <input name="description" value="{{old('description')}}" class="form-control" placeholder="Describe brevemente la consulta" 
        id="description" type="text"  required>
           
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="specialty">Especialidad</label>
  <select name="specialty_id" id="specialty" class="form-control" required>
                <option value="">Seleccionar especialidad</option> 
                @foreach($specialties as $specialty)
  <option value="{{ $specialty->id }}" @if(old('specialty_id') == $specialty->id) selected @endif>{{ $specialty->name }}</option>
                @endforeach 
                </select>
     </div>
     
      <div class="form-group col-md-6">
             <label form="doctor">Médico</label>
  <select name="doctor_id" id="doctor" class="form-control" required>
                  @foreach($doctors as $doctor)
  <option value="{{ $doctor->id }}" @if(old('doctor_id') == $doctor->id) selected @endif>{{ $doctor->name }}</option>
                @endforeach 
                </select>
      
    </div>
</div>

          
            
             <div class="form-group">
                <label form="dni">Fecha</label>
                 <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
        </div>
        <input class="form-control datepicker" placeholder="Seleccionar Fecha" 
        id="date" name="scheduled_date" type="text" value="{{old('scheduled_date'), date('Y-m-d')}}" 
        data-date-format="yyyy-mm-d"
        data-date-start-date="{{date('Y-m-d')}}" 
        data-date-end-date="+30d">
    </div>
</div>
       <div class="form-group">
                <label form="address">Hora de atencion</label>
                <div id="hours">
                @if($intervals)
                @foreach($intervals['morning'] as $key => $interval)
    <div class="custom-control custom-radio mb-3">
   <input type="radio" id="intervalMorning{{$key}}" name="scheduled_time" value="{{$interval['start']}}" class="custom-control-input"  required>
   <label class="custom-control-label" for="intervalMorning{{$key}}"> {{$interval['start']}} - {{$interval['end']}}</label>
 </div>
                @endforeach
                    @foreach($intervals['afternoon'] as $key => $interva)
                     <div class="custom-control custom-radio mb-3">
   <input type="radio" id="intervalAfternoon{{$key}}" name="scheduled_time" value="{{$interval['start']}}" class="custom-control-input"  required>
   <label class="custom-control-label" for="intervalAfternoon{{$key}}"> {{$interval['start']}} - {{$interval['end']}}</label>
 </div>
                      @endforeach
                @else
                 <div class="alert alert-warning" role="alert">
    selecciona un medico y una fecha para ver sus horas disponibles
</div> @endif
                </div>
            </div>
            <div class="form-group">
   <label form="phone">tipo de consulta</label>
                
   <div class="custom-control custom-radio mb-3">
                 
  <input  id="type1" name="type"  class="custom-control-input" type="radio"
    @if(old('type','consulta') == 'consulta') checked @endif value="consulta">
  <label class="custom-control-label" for="type1">consulta</label>
</div>
  <div class="custom-control custom-radio mb-3">
                 
  <input  id="type2" name="type" class="custom-control-input" type="radio"
     @if(old("type") == 'examen') checked @endif value="examen">
  <label class="custom-control-label" for="type2">examen</label>
</div> 
                         <div class="custom-control custom-radio mb-3">
                 
  <input  id="type3" name="type" class="custom-control-input" type="radio"
     @if(old("type") == 'operacion') checked @endif value="operacion">
  <label class="custom-control-label" for="type3">operacion</label>
</div>
            </div>
         
 
            <button type="submit" class="btn btn-sm btn-default">Guardar</button>
            </form>
          
        </div>
      </div>
@endsection
@section('scripts')

<script src="{{asset('/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('/js/appointments/create.js')}}"></script>


@endsection