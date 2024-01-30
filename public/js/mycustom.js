/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/mycustom.js":
/*!**********************************!*\
  !*** ./resources/js/mycustom.js ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

window.livewire.on('Storefinished', function () {
  $("#fileControl").val('');
  $('#createModal').modal('hide');
  $("html, body").animate({
    scrollTop: 0
  }, "fast");
  $('.alert').delay(7000).slideUp('slow', 'linear');
});
window.livewire.on('storecouldnotbeconpletedbecauseofduplicate', function () {
  $('#createModal').modal('hide');
  $('.alert').delay(5000).slideUp('slow', 'linear');
});
window.livewire.on('userDeleted', function () {
  $('.alert').delay(5000).slideUp('slow', 'linear');
});
window.livewire.on('showDeleteConfirmBox', function () {
  $('#deleteModal').modal('show');
});
window.livewire.on('DeleteFinished', function () {
  $('#deleteModal').modal('hide');
  $("html, body").animate({
    scrollTop: 0
  }, "fast");
  $('.alert').delay(5000).slideUp('slow', 'linear');
});
window.livewire.on('showModalAgainForUpdate', function () {
  $("#fileControl").val('');
  $('#createModal').modal('show');
});
window.livewire.on('finishedImporting', function () {
  $("#fileControl").val('');
  $('#uploadExcelModal').modal('hide');
  $('.alert').delay(8000).slideUp('slow', 'linear');
}); // jquery to show table coloumns based on button selection

$(document).on('turbolinks:load', function () {
  $('.dropdown-toggle').dropdown(); //this reinitializes the dropdown states of bootstrap dropdown

  $(".table .toggleDisplay1").show();
  $(".table .toggleDisplay2").show();
  $("#click-me").click(function () {
    $(".table  .toggleDisplay1").hide();
    $(".table .toggleDisplay2").show();
  });
  $("#click-me2").click(function () {
    $(".table  .toggleDisplay1").show();
    $(".table .toggleDisplay2").hide();
  });
  $("#click-meForAll").click(function () {
    $(".table  .toggleDisplay1").show();
    $(".table .toggleDisplay2").show();
  });
  $("#clickmetoshowconfirmationdialog").click(function () {
    $('#deleteModalwithOptions').modal('hide');
  });

  (function ($) {
    "use strict"; // Add active state to sidbar nav links

    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path

    $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function () {
      if (this.href === path) {
        $(this).addClass("active");
      }
    }); // Toggle the side navigation

    $("#sidebarToggle").on("click", function (e) {
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

/***/ }),

/***/ 2:
/*!****************************************!*\
  !*** multi ./resources/js/mycustom.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\laragon\www\studentmanagementsystem\resources\js\mycustom.js */"./resources/js/mycustom.js");


/***/ })

/******/ });