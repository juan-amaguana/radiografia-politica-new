@extends('template.landing')

@section('nav_extras')
@endsection

@section('content')
<div class="row section grey lighten-3">
    <div class="container">
    <div class="col  m10  l9 "><h5 class="flow-text">Contáctanos</h5></div>
    </div>
</div>


<div id="fcd-rp-page" class="container">
  <div class="row">



  <div class="row">

    <div class="col s12 m10 offset-m1 l10 offset-l1 section">
        <div class="section">

          <div id="grid-mision">

            <div class="descripcion"><p>¿Quieres obtener información adicional de Fundación Ciudadanía y Desarrollo, compartir una idea con nosotros o hacer un comentario? Envíanos un correo electrónico o info@ciudadaniaydesarrollo.org.</p></div>
          </div>
        </div>

      </div>

  </div>

    <div class="row">

      <div class="col s12 m12 l5 offset-l1">
        <h6 class="subtitulo"><i class="material-icons">perm_phone_msg</i>&nbsp;Teléfono</h6>
        <div class="descripcion ">
          <p>

           <?php echo nl2br($administracion->telefono); ?>
         </p>
       </div>

       <h6 class="subtitulo"><i class="material-icons">email</i>&nbsp;Correo electrónico</h6>
       <div class="descripcion">
        <p>

          <a href="#">{{$administracion->email}}</a>

        </p>
      </div>

    </div>

    <div class="col s12 m12 l5 ">
      <h6 class="subtitulo"><i class="material-icons">home</i>&nbsp;Dirección</h6>
      <div class="descripcion">
        <p>
          <?php echo nl2br($administracion->direccion); ?>
        </p>
      </div>



    </div>
  </div>


        <div class="row">

          <div class="col s12 m12  l11 offset-l1 notification section"> @include('flash::message')</div>
          <div class="col s12 m12  l11 offset-l1">
            <p >
        Llena el siguiente formulario para contactarte con Radiografía Política.
        </p>
          </div>

        </div>
        <div class="row ">
          <div class="col s12 m7 l8">

             <form  method="POST" action="/mensaje" class="col s12 l8 offset-l2">
            @csrf

            <div class="row">
              <div class="input-field col s12">
                <input id="nombre_contacto" type="text" name="nombre_contacto"  class="validate" value="{{ old('nombre_contacto') }}" required>
                <label for="nombre_contacto">Nombre <span class="red-text">*</span></label>
                <span class="helper-text" data-error="El campo nombre es requerido"></span>
                @if($errors->has('nombre_contacto'))
                <p class="red-text">{{$errors->first('nombre_contacto')}}</p>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="telefono_contacto" type="text" name="telefono_contacto" class="validate" >
                <label for="telefono_contacto">Telefono</label>
                @if($errors->has('telefono_contacto'))
                <p class="red-text">{{$errors->first('telefono_contacto')}}</p>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="email_contacto" type="email" name="email_contacto" class="validate" value="{{ old('email_contacto') }}" required>
                <label for="email_contacto">Email<span class="red-text"> *</span></label>
                <span class="helper-text" data-error="El campo email es requerido"></span>
                @if($errors->has('email_contacto'))
                <p class="red-text">{{$errors->first('email_contacto')}}</p>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="asunto_contacto" type="text" name="asunto_contacto" class="validate" value="{{ old('asunto_contacto') }}" required>
                <label for="asunto_contacto">Asunto<span class="red-text"> *</span></label>
                <span class="helper-text" data-error="El campo asunto es requerido"></span>
                @if($errors->has('asunto_contacto'))
                <p class="red-text">{{$errors->first('asunto_contacto')}}</p>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <textarea id="mensaje_contacto" name="mensaje_contacto" class="materialize-textarea"  required class="validate">{{ old('mensaje_contacto') }}</textarea>

                <label for="mensaje_contacto">Mensaje<span class="red-text"> *</span></label>
                <span class="helper-text" data-error="El campo mensaje es requerido"></span>
                @if($errors->has('mensaje_contacto'))
                <p class="red-text">{{$errors->first('mensaje_contacto')}}</p>
                @endif
              </div>
            </div>
            <button class="btn waves-effect waves-light" type="submit" name="action">Enviar
              <i class="material-icons right">send</i>
            </button>
          </form>
          </div>
          <div class=" col s12 m5 l4">
            <div class="fcd-button-footer-props fcd-btn-vermas" style="text-align: left;">
              <div class="row">
                <div class="col s12" style="margin-top: 10px"><a href="/quieres-ser-colaborador" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">arrow_forward</i>Eres funcionario público?</a></div>
                <div class="col s12" style="margin-top: 10px"><a href="/sumate-a-la-iniciativa" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">arrow_forward</i>Súmate a la iniciativa</a></div>

              </div>
            </div>
          </div>

        </div>
      </div>


</div>

@endsection
