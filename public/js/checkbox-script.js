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
/******/ 	return __webpack_require__(__webpack_require__.s = 8);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/checkbox-script.js":
/*!*****************************************!*\
  !*** ./resources/js/checkbox-script.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var check_buku = document.querySelector('#check-buku');
var check_ebook = document.querySelector('#check-ebook');
var check_member = document.querySelector('#check-member');
var check_librarian = document.querySelector('#check-librarian');
var check_publisher = document.querySelector('#check-publisher');
var check_category = document.querySelector('#check-category');
var check_report = document.querySelector('#check-report');
check_buku.addEventListener('click', function () {
  var wrapper_buku = document.querySelector('#wrapper-buku');

  if (check_buku.checked == true) {
    wrapper_buku.classList.remove('checkbox-wrapper-unchecked');
    wrapper_buku.classList.add('checkbox-wrapper-checked');
  } else {
    wrapper_buku.classList.remove('checkbox-wrapper-checked');
    wrapper_buku.classList.add('checkbox-wrapper-unchecked');
  }
});
check_ebook.addEventListener('click', function () {
  var wrapper_ebook = document.querySelector('#wrapper-ebook');

  if (check_ebook.checked == true) {
    wrapper_ebook.classList.remove('checkbox-wrapper-unchecked');
    wrapper_ebook.classList.add('checkbox-wrapper-checked');
  } else {
    wrapper_ebook.classList.remove('checkbox-wrapper-checked');
    wrapper_ebook.classList.add('checkbox-wrapper-unchecked');
  }
});
check_member.addEventListener('click', function () {
  var wrapper_member = document.querySelector('#wrapper-member');

  if (check_member.checked == true) {
    wrapper_member.classList.remove('checkbox-wrapper-unchecked');
    wrapper_member.classList.add('checkbox-wrapper-checked');
  } else {
    wrapper_member.classList.remove('checkbox-wrapper-checked');
    wrapper_member.classList.add('checkbox-wrapper-unchecked');
  }
});
check_librarian.addEventListener('click', function () {
  var wrapper_librarian = document.querySelector('#wrapper-librarian');

  if (check_librarian.checked == true) {
    wrapper_librarian.classList.remove('checkbox-wrapper-unchecked');
    wrapper_librarian.classList.add('checkbox-wrapper-checked');
  } else {
    wrapper_librarian.classList.remove('checkbox-wrapper-checked');
    wrapper_librarian.classList.add('checkbox-wrapper-unchecked');
  }
});
check_publisher.addEventListener('click', function () {
  var wrapper_publisher = document.querySelector('#wrapper-publisher');

  if (check_publisher.checked == true) {
    wrapper_publisher.classList.remove('checkbox-wrapper-unchecked');
    wrapper_publisher.classList.add('checkbox-wrapper-checked');
  } else {
    wrapper_publisher.classList.remove('checkbox-wrapper-checked');
    wrapper_publisher.classList.add('checkbox-wrapper-unchecked');
  }
});
check_category.addEventListener('click', function () {
  var wrapper_category = document.querySelector('#wrapper-category');

  if (check_category.checked == true) {
    wrapper_category.classList.remove('checkbox-wrapper-unchecked');
    wrapper_category.classList.add('checkbox-wrapper-checked');
  } else {
    wrapper_category.classList.remove('checkbox-wrapper-checked');
    wrapper_category.classList.add('checkbox-wrapper-unchecked');
  }
});
check_report.addEventListener('click', function () {
  var wrapper_report = document.querySelector('#wrapper-report');

  if (check_report.checked == true) {
    wrapper_report.classList.remove('checkbox-wrapper-unchecked');
    wrapper_report.classList.add('checkbox-wrapper-checked');
  } else {
    wrapper_report.classList.remove('checkbox-wrapper-checked');
    wrapper_report.classList.add('checkbox-wrapper-unchecked');
  }
});

/***/ }),

/***/ 8:
/*!***********************************************!*\
  !*** multi ./resources/js/checkbox-script.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! F:\My Projects\Project Work\PerpustakaanOnline\resources\js\checkbox-script.js */"./resources/js/checkbox-script.js");


/***/ })

/******/ });