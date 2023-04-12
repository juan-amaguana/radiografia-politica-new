@extends('template.landing')



@section('content')

<div class="row" id="graficas_posiciones">
    <div class="col-5">
      <div>
        <div class="chart" id="dataviz"></div>
      </div>
    </div>
    
    <div class="col-6">
      <button @click="cambiar_datos">Greet</button>
    </div>
    
</div>

  


@endsection

@section('footer_scripts')
<script>

    new Vue({
      el:"#graficas_posiciones",
      data: {
        array: [
          {"value": 100, "name": "alpha"},
          {"value": 70, "name": "beta"},
          {"value": 40, "name": "gamma"},
          {"value": 15, "name": "delta"},
          {"value": 5, "name": "epsilon"},
          {"value": 1, "name": "zeta"}
        ]
      },
      mounted(){
        this.dibujar_treemap();            
      },
      methods: {
                cambiar_datos: function (event) {
                  alert('Hello ')
                  this.array= [
                    {"value": 30, "name": "xxx"},
                    {"value": 70, "name": "jjj"},
                    {"value": 40, "name": "yyy"},
                    {"value": 15, "name": "llll"},
                    {"value": 5, "name": "nnn"},
                    {"value": 1, "name": "ooo"}
                  ]
                  $("#dataviz").html('')
                  this.dibujar_treemap();   
                },
                dibujar_treemap: function (event) {
                  var visualization = d3plus.viz()
                  .container("#dataviz")  
                  .data(this.array)  
                  .type("tree_map")   
                  .id("name")         
                  .size("value")      
                  .mouse({                
                    "move": false,                        // key will also take custom function
                    "click": function(){alert("Click!")}   
                  })          
                  .draw()
                },
      } ,
    })
</script>


@endsection









