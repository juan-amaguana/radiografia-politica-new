@extends('template.landing')

@section('nav_extras')
@endsection

@section('content')

<div class="row section grey lighten-3">
    <div class="container">
    <div class="col  m10  l9 "><h5 class="flow-text">¿Quiéres ser colaborador?</h5></div>
    </div>
</div>

<div id="fcd-rp-page" class="container">
   <div class="row">

    <div class="col s12 m10 offset-m1 l10 offset-l1 section">
        <div class="section">

          <div id="grid-mision">
            <div class="col s12 m12  l11 offset-l1 notification section"> @include('flash::message')</div>
            <div class="descripcion"><p>Completa los datos en el siguiente enlace y descarga el archivo, para finalizar registralo en el siguiente formulario</p></div>
            <div class="fcd-button-footer-props fcd-btn-vermas" style="text-align: left;">
              <div class="row">
                <div class="col s12" style="margin-top: 10px"><a href="/quieres-ser-colaborador" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">arrow_forward</i>LLenar formulario</a></div>
              </div>
            </div>
          </div>
        </div>

      </div>

  </div>
  <div class="row ">
          <div class="col s12 m7 l8">

             <form  method="POST" action="/sumate-iniciativa-funcionario/vista-previa" files="true" enctype="multipart/form-data" class="col s12 l8 offset-l2">
            @csrf

            <div class="row">
              <div class="input-field col s12">
                <input id="nombre_aportante" type="text" name="nombre_aportante"  class="validate" value="{{ old('nombre_aportante') }}" required>
                <label for="nombre_aportante">Nombre <span class="red-text">*</span></label>
                <span class="helper-text" data-error="El campo nombre es requerido"></span>
                @if($errors->has('nombre_aportante'))
                <p class="red-text">{{$errors->first('nombre_aportante')}}</p>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="telefono_aportante" type="text" name="telefono_aportante" class="validate" >
                <label for="telefono_aportante">Telefono</label>
                @if($errors->has('telefono_aportante'))
                <p class="red-text">{{$errors->first('telefono_aportante')}}</p>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="email_aportante" type="email" name="email_aportante" class="validate" value="{{ old('email_aportante') }}" required>
                <label for="email_aportante">Email<span class="red-text"> *</span></label>
                <span class="helper-text" data-error="El campo email es requerido"></span>
                @if($errors->has('email_aportante'))
                <p class="red-text">{{$errors->first('email_aportante')}}</p>
                @endif
              </div>
            </div>

            <div class="row">
              <div class="file-field input-field">
      <div class="btn">
        <span>Selecciona el archivo</span>
        <input type="file" name="archivo_funcionario">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
            </div>




            <button class="btn waves-effect waves-light" type="submit" name="action">Enviar excel
              <i class="material-icons right">send</i>
            </button>
          </form>
          </div>


        </div>
      </div>
</div>

@endsection
