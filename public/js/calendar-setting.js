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
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/calendar-setting.js":
/*!******************************************!*\
  !*** ./resources/js/calendar-setting.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("// import $ from \"jquery\";\n// let cal = $('#calendar');\n// let calendar = new Calendar(cal);\n// let transactionGraphic = document.getElementById('transaction');\n// let adminGraphic = document.getElementById('admin');\n// let memberGraphic = document.getElementById('member');\n// let TransactionGraphic = new Chart(transactionGraphic, {\n//     type: 'bar',\n//     data: {\n//         labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\\'at'],\n//         datasets: [{\n//             label: 'Jumlah transaksi',\n//             data: [{{$monday_transaction}}, {{$tuesday_transaction}}, {{$wednesday_transaction}}, {{$thursday_transaction}}, {{$friday_transaction}}],\n//             backgroundColor: [\n//                 'rgba(255, 99, 132)',\n//                 'rgba(54, 162, 235)',\n//                 'rgba(255, 206, 86)',\n//                 'rgba(75, 192, 192)',\n//                 'rgba(153, 102, 255)',\n//             ],\n//         }]\n//     },\n//     options: {\n//         scales: {\n//             yAxes: [{\n//                 ticks: {\n//                     beginAtZero: true\n//                 }\n//             }]\n//         },\n//         legend: {\n//             display: false\n//         },\n//         title: {\n//             display: true,\n//             text: 'Jumlah peminjaman minggu ini'\n//         }\n//     }\n// });\n// let AdminGraphic = new Chart(adminGraphic, {\n//     type: 'doughnut',\n//     data: {\n//         labels: ['Admin', 'Pustakawan'],\n//         datasets: [{\n//             label: 'Jumlah',\n//             data: [<?php echo $sum_adms; ?>, <?php echo $sum_libs; ?>],\n//             backgroundColor: [\n//                 'rgb(48, 141, 56)',\n//                 'rgb(79, 207, 90)',\n//             ],\n//         }]\n//     },\n//     options: {\n//         legend: {\n//             display: false\n//         },\n//         title: {\n//             display: true,\n//             text: 'Jumlah pustakawan'\n//         },\n//         layout: {\n//             padding: {\n//                 left: 0,\n//                 right: 0,\n//                 top: 20,\n//                 bottom: 20\n//             }\n//         }\n//     }\n// });\n// let MemberGraphic = new Chart(memberGraphic, {\n//     type: 'doughnut',\n//     data: {\n//         labels: ['Guru', 'Siswa'],\n//         datasets: [{\n//             label: 'Jumlah',\n//             data: [<?php echo $sum_teacher; ?>, <?php echo $sum_student; ?>],\n//             backgroundColor: [\n//                 'rgb(79, 207, 90)',\n//                 'rgb(48, 141, 56)',\n//             ],\n//         }]\n//     },\n//     options: {\n//         legend: {\n//             display: false\n//         },\n//         title: {\n//             display: true,\n//             text: 'Jumlah anggota'\n//         },\n//         layout: {\n//             padding: {\n//                 left: 0,\n//                 right: 0,\n//                 top: 20,\n//                 bottom: 20\n//             }\n//         }\n//     }\n// });//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvY2FsZW5kYXItc2V0dGluZy5qcz80MjBmIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBO0FBRUE7QUFDQTtBQUVBO0FBQ0E7QUFDQTtBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EiLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvY2FsZW5kYXItc2V0dGluZy5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbIi8vIGltcG9ydCAkIGZyb20gXCJqcXVlcnlcIjtcclxuXHJcbi8vIGxldCBjYWwgPSAkKCcjY2FsZW5kYXInKTtcclxuLy8gbGV0IGNhbGVuZGFyID0gbmV3IENhbGVuZGFyKGNhbCk7XHJcblxyXG4vLyBsZXQgdHJhbnNhY3Rpb25HcmFwaGljID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ3RyYW5zYWN0aW9uJyk7XHJcbi8vIGxldCBhZG1pbkdyYXBoaWMgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnYWRtaW4nKTtcclxuLy8gbGV0IG1lbWJlckdyYXBoaWMgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnbWVtYmVyJyk7XHJcblxyXG4vLyBsZXQgVHJhbnNhY3Rpb25HcmFwaGljID0gbmV3IENoYXJ0KHRyYW5zYWN0aW9uR3JhcGhpYywge1xyXG4vLyAgICAgdHlwZTogJ2JhcicsXHJcbi8vICAgICBkYXRhOiB7XHJcbi8vICAgICAgICAgbGFiZWxzOiBbJ1NlbmluJywgJ1NlbGFzYScsICdSYWJ1JywgJ0thbWlzJywgJ0p1bVxcJ2F0J10sXHJcbi8vICAgICAgICAgZGF0YXNldHM6IFt7XHJcbi8vICAgICAgICAgICAgIGxhYmVsOiAnSnVtbGFoIHRyYW5zYWtzaScsXHJcbi8vICAgICAgICAgICAgIGRhdGE6IFt7eyRtb25kYXlfdHJhbnNhY3Rpb259fSwge3skdHVlc2RheV90cmFuc2FjdGlvbn19LCB7eyR3ZWRuZXNkYXlfdHJhbnNhY3Rpb259fSwge3skdGh1cnNkYXlfdHJhbnNhY3Rpb259fSwge3skZnJpZGF5X3RyYW5zYWN0aW9ufX1dLFxyXG4vLyAgICAgICAgICAgICBiYWNrZ3JvdW5kQ29sb3I6IFtcclxuLy8gICAgICAgICAgICAgICAgICdyZ2JhKDI1NSwgOTksIDEzMiknLFxyXG4vLyAgICAgICAgICAgICAgICAgJ3JnYmEoNTQsIDE2MiwgMjM1KScsXHJcbi8vICAgICAgICAgICAgICAgICAncmdiYSgyNTUsIDIwNiwgODYpJyxcclxuLy8gICAgICAgICAgICAgICAgICdyZ2JhKDc1LCAxOTIsIDE5MiknLFxyXG4vLyAgICAgICAgICAgICAgICAgJ3JnYmEoMTUzLCAxMDIsIDI1NSknLFxyXG4vLyAgICAgICAgICAgICBdLFxyXG4vLyAgICAgICAgIH1dXHJcbi8vICAgICB9LFxyXG4vLyAgICAgb3B0aW9uczoge1xyXG4vLyAgICAgICAgIHNjYWxlczoge1xyXG4vLyAgICAgICAgICAgICB5QXhlczogW3tcclxuLy8gICAgICAgICAgICAgICAgIHRpY2tzOiB7XHJcbi8vICAgICAgICAgICAgICAgICAgICAgYmVnaW5BdFplcm86IHRydWVcclxuLy8gICAgICAgICAgICAgICAgIH1cclxuLy8gICAgICAgICAgICAgfV1cclxuLy8gICAgICAgICB9LFxyXG4vLyAgICAgICAgIGxlZ2VuZDoge1xyXG4vLyAgICAgICAgICAgICBkaXNwbGF5OiBmYWxzZVxyXG4vLyAgICAgICAgIH0sXHJcbi8vICAgICAgICAgdGl0bGU6IHtcclxuLy8gICAgICAgICAgICAgZGlzcGxheTogdHJ1ZSxcclxuLy8gICAgICAgICAgICAgdGV4dDogJ0p1bWxhaCBwZW1pbmphbWFuIG1pbmdndSBpbmknXHJcbi8vICAgICAgICAgfVxyXG4vLyAgICAgfVxyXG4vLyB9KTtcclxuXHJcbi8vIGxldCBBZG1pbkdyYXBoaWMgPSBuZXcgQ2hhcnQoYWRtaW5HcmFwaGljLCB7XHJcbi8vICAgICB0eXBlOiAnZG91Z2hudXQnLFxyXG4vLyAgICAgZGF0YToge1xyXG4vLyAgICAgICAgIGxhYmVsczogWydBZG1pbicsICdQdXN0YWthd2FuJ10sXHJcbi8vICAgICAgICAgZGF0YXNldHM6IFt7XHJcbi8vICAgICAgICAgICAgIGxhYmVsOiAnSnVtbGFoJyxcclxuLy8gICAgICAgICAgICAgZGF0YTogWzw/cGhwIGVjaG8gJHN1bV9hZG1zOyA/PiwgPD9waHAgZWNobyAkc3VtX2xpYnM7ID8+XSxcclxuLy8gICAgICAgICAgICAgYmFja2dyb3VuZENvbG9yOiBbXHJcbi8vICAgICAgICAgICAgICAgICAncmdiKDQ4LCAxNDEsIDU2KScsXHJcbi8vICAgICAgICAgICAgICAgICAncmdiKDc5LCAyMDcsIDkwKScsXHJcbi8vICAgICAgICAgICAgIF0sXHJcbi8vICAgICAgICAgfV1cclxuLy8gICAgIH0sXHJcbi8vICAgICBvcHRpb25zOiB7XHJcbi8vICAgICAgICAgbGVnZW5kOiB7XHJcbi8vICAgICAgICAgICAgIGRpc3BsYXk6IGZhbHNlXHJcbi8vICAgICAgICAgfSxcclxuLy8gICAgICAgICB0aXRsZToge1xyXG4vLyAgICAgICAgICAgICBkaXNwbGF5OiB0cnVlLFxyXG4vLyAgICAgICAgICAgICB0ZXh0OiAnSnVtbGFoIHB1c3Rha2F3YW4nXHJcbi8vICAgICAgICAgfSxcclxuLy8gICAgICAgICBsYXlvdXQ6IHtcclxuLy8gICAgICAgICAgICAgcGFkZGluZzoge1xyXG4vLyAgICAgICAgICAgICAgICAgbGVmdDogMCxcclxuLy8gICAgICAgICAgICAgICAgIHJpZ2h0OiAwLFxyXG4vLyAgICAgICAgICAgICAgICAgdG9wOiAyMCxcclxuLy8gICAgICAgICAgICAgICAgIGJvdHRvbTogMjBcclxuLy8gICAgICAgICAgICAgfVxyXG4vLyAgICAgICAgIH1cclxuLy8gICAgIH1cclxuLy8gfSk7XHJcblxyXG4vLyBsZXQgTWVtYmVyR3JhcGhpYyA9IG5ldyBDaGFydChtZW1iZXJHcmFwaGljLCB7XHJcbi8vICAgICB0eXBlOiAnZG91Z2hudXQnLFxyXG4vLyAgICAgZGF0YToge1xyXG4vLyAgICAgICAgIGxhYmVsczogWydHdXJ1JywgJ1Npc3dhJ10sXHJcbi8vICAgICAgICAgZGF0YXNldHM6IFt7XHJcbi8vICAgICAgICAgICAgIGxhYmVsOiAnSnVtbGFoJyxcclxuLy8gICAgICAgICAgICAgZGF0YTogWzw/cGhwIGVjaG8gJHN1bV90ZWFjaGVyOyA/PiwgPD9waHAgZWNobyAkc3VtX3N0dWRlbnQ7ID8+XSxcclxuLy8gICAgICAgICAgICAgYmFja2dyb3VuZENvbG9yOiBbXHJcbi8vICAgICAgICAgICAgICAgICAncmdiKDc5LCAyMDcsIDkwKScsXHJcbi8vICAgICAgICAgICAgICAgICAncmdiKDQ4LCAxNDEsIDU2KScsXHJcbi8vICAgICAgICAgICAgIF0sXHJcbi8vICAgICAgICAgfV1cclxuLy8gICAgIH0sXHJcbi8vICAgICBvcHRpb25zOiB7XHJcbi8vICAgICAgICAgbGVnZW5kOiB7XHJcbi8vICAgICAgICAgICAgIGRpc3BsYXk6IGZhbHNlXHJcbi8vICAgICAgICAgfSxcclxuLy8gICAgICAgICB0aXRsZToge1xyXG4vLyAgICAgICAgICAgICBkaXNwbGF5OiB0cnVlLFxyXG4vLyAgICAgICAgICAgICB0ZXh0OiAnSnVtbGFoIGFuZ2dvdGEnXHJcbi8vICAgICAgICAgfSxcclxuLy8gICAgICAgICBsYXlvdXQ6IHtcclxuLy8gICAgICAgICAgICAgcGFkZGluZzoge1xyXG4vLyAgICAgICAgICAgICAgICAgbGVmdDogMCxcclxuLy8gICAgICAgICAgICAgICAgIHJpZ2h0OiAwLFxyXG4vLyAgICAgICAgICAgICAgICAgdG9wOiAyMCxcclxuLy8gICAgICAgICAgICAgICAgIGJvdHRvbTogMjBcclxuLy8gICAgICAgICAgICAgfVxyXG4vLyAgICAgICAgIH1cclxuLy8gICAgIH1cclxuLy8gfSk7Il0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/js/calendar-setting.js\n");

/***/ }),

/***/ 4:
/*!************************************************!*\
  !*** multi ./resources/js/calendar-setting.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! F:\My Projects\Project Work\PerpustakaanOnline\resources\js\calendar-setting.js */"./resources/js/calendar-setting.js");


/***/ })

/******/ });