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
/******/ 	return __webpack_require__(__webpack_require__.s = 10);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/calendar-setting.js":
/*!******************************************!*\
  !*** ./resources/js/calendar-setting.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// import $ from "jquery";
// let cal = $('#calendar');
// let calendar = new Calendar(cal);
// let transactionGraphic = document.getElementById('transaction');
// let adminGraphic = document.getElementById('admin');
// let memberGraphic = document.getElementById('member');
// let TransactionGraphic = new Chart(transactionGraphic, {
//     type: 'bar',
//     data: {
//         labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at'],
//         datasets: [{
//             label: 'Jumlah transaksi',
//             data: [{{$monday_transaction}}, {{$tuesday_transaction}}, {{$wednesday_transaction}}, {{$thursday_transaction}}, {{$friday_transaction}}],
//             backgroundColor: [
//                 'rgba(255, 99, 132)',
//                 'rgba(54, 162, 235)',
//                 'rgba(255, 206, 86)',
//                 'rgba(75, 192, 192)',
//                 'rgba(153, 102, 255)',
//             ],
//         }]
//     },
//     options: {
//         scales: {
//             yAxes: [{
//                 ticks: {
//                     beginAtZero: true
//                 }
//             }]
//         },
//         legend: {
//             display: false
//         },
//         title: {
//             display: true,
//             text: 'Jumlah peminjaman minggu ini'
//         }
//     }
// });
// let AdminGraphic = new Chart(adminGraphic, {
//     type: 'doughnut',
//     data: {
//         labels: ['Admin', 'Pustakawan'],
//         datasets: [{
//             label: 'Jumlah',
//             data: [<?php echo $sum_adms; ?>, <?php echo $sum_libs; ?>],
//             backgroundColor: [
//                 'rgb(48, 141, 56)',
//                 'rgb(79, 207, 90)',
//             ],
//         }]
//     },
//     options: {
//         legend: {
//             display: false
//         },
//         title: {
//             display: true,
//             text: 'Jumlah pustakawan'
//         },
//         layout: {
//             padding: {
//                 left: 0,
//                 right: 0,
//                 top: 20,
//                 bottom: 20
//             }
//         }
//     }
// });
// let MemberGraphic = new Chart(memberGraphic, {
//     type: 'doughnut',
//     data: {
//         labels: ['Guru', 'Siswa'],
//         datasets: [{
//             label: 'Jumlah',
//             data: [<?php echo $sum_teacher; ?>, <?php echo $sum_student; ?>],
//             backgroundColor: [
//                 'rgb(79, 207, 90)',
//                 'rgb(48, 141, 56)',
//             ],
//         }]
//     },
//     options: {
//         legend: {
//             display: false
//         },
//         title: {
//             display: true,
//             text: 'Jumlah anggota'
//         },
//         layout: {
//             padding: {
//                 left: 0,
//                 right: 0,
//                 top: 20,
//                 bottom: 20
//             }
//         }
//     }
// });

/***/ }),

/***/ 10:
/*!************************************************!*\
  !*** multi ./resources/js/calendar-setting.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! F:\My Projects\Project Work\PerpustakaanOnline\resources\js\calendar-setting.js */"./resources/js/calendar-setting.js");


/***/ })

/******/ });