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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _Ajax = __webpack_require__(1);

var _Ajax2 = _interopRequireDefault(_Ajax);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var ajax = new _Ajax2.default(),
    tasksDiv = document.getElementById('tasks');

ajax.ajaxGet('http://localhost').then(function () {
    return console.log;
});

document.addEventListener('submit', function (e) {
    e.preventDefault();

    if (e.target && e.target.id === 'addTask') {
        var inputEl = document.getElementById('message');
        ajax.ajaxPost('actions.php', { message: inputEl.value, action: 'add' }).then(function (data) {
            ajax.ajaxGet('message.php?id=' + data).then(function (data) {
                return tasksDiv.insertAdjacentHTML('beforeend', data);
            });
            inputEl.value = "";
        });
    } else if (e.target && e.target.id === 'deleteTask') {
        if (!confirm('Êtes-vous sûr(e) ?')) return false;
        var taskIdToDelete = e.target.querySelector('#taskId').value;
        var divToHide = document.getElementById('task' + taskIdToDelete);
        ajax.ajaxDelete('actions.php?id=' + taskIdToDelete).then(function () {
            return divToHide.style.display = 'none';
        });
    } else if (e.target && e.target.id === 'overTask') {
        var taskIdToFinish = e.target.querySelector('#taskId').value;
        var divToStrike = document.getElementById('task' + taskIdToFinish);
        ajax.ajaxPut('actions.php?id=' + taskIdToFinish, {}).then(function () {
            divToStrike.className += ' strike-text';
            e.target.style.display = 'none';
        });
    }
});

/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _slicedToArray = function () { function sliceIterator(arr, i) { var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"]) _i["return"](); } finally { if (_d) throw _e; } } return _arr; } return function (arr, i) { if (Array.isArray(arr)) { return arr; } else if (Symbol.iterator in Object(arr)) { return sliceIterator(arr, i); } else { throw new TypeError("Invalid attempt to destructure non-iterable instance"); } }; }();

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var AjaxRequest = function () {
    function AjaxRequest() {
        _classCallCheck(this, AjaxRequest);

        this.ajaxRequest = new XMLHttpRequest();
    }

    _createClass(AjaxRequest, [{
        key: 'ajaxGet',
        value: function ajaxGet(url) {
            return this.ajaxGetDelete('GET', url);
        }
    }, {
        key: 'ajaxPost',
        value: function ajaxPost(url, postData) {
            return this.ajaxPostPut('POST', url, postData);
        }
    }, {
        key: 'ajaxPut',
        value: function ajaxPut(url, putData) {
            return this.ajaxPostPut('PUT', url, putData);
        }
    }, {
        key: 'ajaxDelete',
        value: function ajaxDelete(url) {
            return this.ajaxGetDelete('DELETE', url);
        }
    }, {
        key: 'ajaxPostPut',
        value: function ajaxPostPut(method, url, dataToSend) {
            var _this = this;

            return new Promise(function (resolve, reject) {
                _this.ajaxRequest.onload = function () {
                    return resolve(_this.ajaxRequest.response);
                };
                _this.ajaxRequest.onerror = function () {
                    return reject(new Error(_this.ajaxRequest.statusText));
                };
                _this.ajaxRequest.open(method, url);
                var data = new FormData();
                var _iteratorNormalCompletion = true;
                var _didIteratorError = false;
                var _iteratorError = undefined;

                try {
                    for (var _iterator = Object.entries(dataToSend)[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
                        var _ref = _step.value;

                        var _ref2 = _slicedToArray(_ref, 2);

                        var datumKey = _ref2[0];
                        var datum = _ref2[1];

                        data.append(datumKey, datum);
                    }
                } catch (err) {
                    _didIteratorError = true;
                    _iteratorError = err;
                } finally {
                    try {
                        if (!_iteratorNormalCompletion && _iterator.return) {
                            _iterator.return();
                        }
                    } finally {
                        if (_didIteratorError) {
                            throw _iteratorError;
                        }
                    }
                }

                _this.ajaxRequest.send(data);
            });
        }
    }, {
        key: 'ajaxGetDelete',
        value: function ajaxGetDelete(method, url) {
            var _this2 = this;

            return new Promise(function (resolve, reject) {
                _this2.ajaxRequest.onload = function () {
                    return resolve(_this2.ajaxRequest.response);
                };
                _this2.ajaxRequest.onerror = function () {
                    return reject(new Error(_this2.ajaxRequest.statusText));
                };
                _this2.ajaxRequest.open(method, url);
                _this2.ajaxRequest.send();
            });
        }
    }]);

    return AjaxRequest;
}();

exports.default = AjaxRequest;

/***/ })
/******/ ]);
//# sourceMappingURL=bundle.js.map