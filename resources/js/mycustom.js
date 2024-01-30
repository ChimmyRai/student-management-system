

      window.livewire.on('Storefinished', () => {
        $("#fileControl").val('');
          $('#createModal').modal('hide');
            $("html, body").animate({ scrollTop: 0 }, "fast");
            $('.alert').delay(7000).slideUp('slow','linear');

      });

      window.livewire.on('storecouldnotbeconpletedbecauseofduplicate', () => {
          $('#createModal').modal('hide');
          $('.alert').delay(5000).slideUp('slow','linear');

      });
      window.livewire.on('userDeleted', () => {
          $('.alert').delay(5000).slideUp('slow','linear');

      });

      window.livewire.on('showDeleteConfirmBox', () => {
          $('#deleteModal').modal('show');
      });
      window.livewire.on('DeleteFinished', () => {
          $('#deleteModal').modal('hide');
          $("html, body").animate({ scrollTop: 0 }, "fast");
          $('.alert').delay(5000).slideUp('slow','linear');

      });

      window.livewire.on('showModalAgainForUpdate', () => {
        $("#fileControl").val('');
          $('#createModal').modal('show');


      });
      window.livewire.on('finishedImporting', () => {
        $("#fileControl").val('');
          $('#uploadExcelModal').modal('hide');
    $('.alert').delay(8000).slideUp('slow','linear');

      });



// jquery to show table coloumns based on button selection
$( document ).on('turbolinks:load', function() {
  $('.dropdown-toggle').dropdown();//this reinitializes the dropdown states of bootstrap dropdown
  $(".table .toggleDisplay1").show();
   $(".table .toggleDisplay2").show();

   $("#click-me").click(function() {
    $(".table  .toggleDisplay1").hide();
     $(".table .toggleDisplay2").show();
 });

 $("#click-me2").click(function() {
 $(".table  .toggleDisplay1").show();
 $(".table .toggleDisplay2").hide();
 });

 $("#click-meForAll").click(function() {
 $(".table  .toggleDisplay1").show();
 $(".table .toggleDisplay2").show();
 });

 $("#clickmetoshowconfirmationdialog").click(function() {
 $('#deleteModalwithOptions').modal('hide')
 });


 (function($) {
 "use strict";

 // Add active state to sidbar nav links
 var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
     $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
         if (this.href === path) {
             $(this).addClass("active");
         }
     });

 // Toggle the side navigation
 $("#sidebarToggle").on("click", function(e) {
     e.preventDefault();
     $("body").toggleClass("sb-sidenav-toggled");
 });
})(jQuery);


});



/*document.addEventListener('turbolinks:before-visit', function() {
    var $navbar = $('.navbar-collapse');

    if ( $navbar.hasClass('in') ) {
      $navbar.collapse('hide');
    }
  });*/





    /*  $(document).ready(function(){
        $(".table .toggleDisplay1").show();
         $(".table .toggleDisplay2").show();

      });

      $("#click-me").click(function() {
       $(".table  .toggleDisplay1").hide();
        $(".table .toggleDisplay2").show();
});

$("#click-me2").click(function() {
  $(".table  .toggleDisplay1").show();
   $(".table .toggleDisplay2").hide();
});

$("#click-meForAll").click(function() {
  $(".table  .toggleDisplay1").show();
   $(".table .toggleDisplay2").show();
});
$("input[type=date]").on('click', function() {
  return false;
});*/
