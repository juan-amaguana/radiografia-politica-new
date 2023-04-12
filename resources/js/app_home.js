/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./js_landing');
require('./common_functions');

window.Vue = require('vue');



import 'datatables.net';
import 'datatables.net-dt/css/jquery.dataTables.css';

// Vue.config.devtools = false;
// Vue.config.debug = false;
// Vue.config.silent = true;
// Vue.config.productionTip = false;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

 //https://www.npmjs.com/package/vuejs-paginate

//Vue.component('perfiles', require('./components/perfiles.vue').default);

(function($){
  $(function(){

    $('.sidenav').sidenav();
    $('.materialboxed').materialbox();

    $('.collapsible').collapsible({accordion: true});
    

     $(".dropdown-trigger-nested").dropdown({ inDuration: 300,
      outDuration: 225,
      constrain_width: false, // Does not change width of dropdown to that of the activator
      hover: true,belowOrigin: false});

     var nesteddropdowninstance = M.Dropdown.getInstance($('.dropdown-trigger-nested'));

     $(".dropdown-trigger-nested1").dropdown({ hover: true});
     var nesteddropdowninstance1 = M.Dropdown.getInstance($('.dropdown-trigger-nested1'));


     $(".dropdown-trigger").dropdown({coverTrigger: false, hover: true, constrainWidth: false, onCloseEnd: function() { nesteddropdowninstance.close(); nesteddropdowninstance1.close(); } });

     $('.slider').slider();
     $('.modal').modal();

    $('select').formSelect();
    $('.parallax').parallax();
    $('.scrollspy').scrollSpy();

    var header = $(".fcd-nav-sticky");
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 10) {
            header.removeClass("fcd-nav-sticky-color").addClass('fcd-nav-sticky-color-scroll');
            $('.fcd-radiografia-logo').removeClass("change-no-scroll-properties-width").addClass('change-on-scroll-properties-width');
            $('.fcd-main-menu').removeClass("change-no-scroll-properties-padding-top").addClass('change-on-scroll-properties-padding-top');
        } else {
            header.removeClass('fcd-nav-sticky-color-scroll').addClass("fcd-nav-sticky-color");
            $('.fcd-radiografia-logo').removeClass("change-on-scroll-properties-width").addClass('change-no-scroll-properties-width');
            $('.fcd-main-menu').removeClass("change-on-scroll-properties-padding-top").addClass('change-no-scroll-properties-padding-top');
        }

    });

  });

})(jQuery);
