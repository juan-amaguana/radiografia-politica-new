

(function($){
  $(function(){

    $('.collapsible').collapsible({accordion: true});
    $('.modal').modal({opacity:0.5})

  });

})(jQuery);

const perfil = new Vue({
    el: '#fcd-rp-search-perfil',
    data:{
      mostrar_datos_principales: true,
    },
});
