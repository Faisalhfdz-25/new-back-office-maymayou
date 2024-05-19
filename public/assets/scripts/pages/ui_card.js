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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/peity/jquery.peity.js":
/*!********************************************!*\
  !*** ./node_modules/peity/jquery.peity.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("// Peity jQuery plugin version 3.3.0\n// (c) 2018 Ben Pickles\n//\n// http://benpickles.github.io/peity\n//\n// Released under MIT license.\n(function($, document, Math, undefined) {\n  var peity = $.fn.peity = function(type, options) {\n    if (svgSupported) {\n      this.each(function() {\n        var $this = $(this)\n        var chart = $this.data('_peity')\n\n        if (chart) {\n          if (type) chart.type = type\n          $.extend(chart.opts, options)\n        } else {\n          chart = new Peity(\n            $this,\n            type,\n            $.extend({},\n              peity.defaults[type],\n              $this.data('peity'),\n              options)\n          )\n\n          $this\n            .change(function() { chart.draw() })\n            .data('_peity', chart)\n        }\n\n        chart.draw()\n      });\n    }\n\n    return this;\n  };\n\n  var Peity = function($el, type, opts) {\n    this.$el = $el\n    this.type = type\n    this.opts = opts\n  }\n\n  var PeityPrototype = Peity.prototype\n\n  var svgElement = PeityPrototype.svgElement = function(tag, attrs) {\n    return $(\n      document.createElementNS('http://www.w3.org/2000/svg', tag)\n    ).attr(attrs)\n  }\n\n  // https://gist.github.com/madrobby/3201472\n  var svgSupported = 'createElementNS' in document && svgElement('svg', {})[0].createSVGRect\n\n  PeityPrototype.draw = function() {\n    var opts = this.opts\n    peity.graphers[this.type].call(this, opts)\n    if (opts.after) opts.after.call(this, opts)\n  }\n\n  PeityPrototype.fill = function() {\n    var fill = this.opts.fill\n\n    return $.isFunction(fill)\n      ? fill\n      : function(_, i) { return fill[i % fill.length] }\n  }\n\n  PeityPrototype.prepare = function(width, height) {\n    if (!this.$svg) {\n      this.$el.hide().after(\n        this.$svg = svgElement('svg', {\n          \"class\": \"peity\"\n        })\n      )\n    }\n\n    return this.$svg\n      .empty()\n      .data('_peity', this)\n      .attr({\n        height: height,\n        width: width\n      })\n  }\n\n  PeityPrototype.values = function() {\n    return $.map(this.$el.text().split(this.opts.delimiter), function(value) {\n      return parseFloat(value)\n    })\n  }\n\n  peity.defaults = {}\n  peity.graphers = {}\n\n  peity.register = function(type, defaults, grapher) {\n    this.defaults[type] = defaults\n    this.graphers[type] = grapher\n  }\n\n  peity.register(\n    'pie',\n    {\n      fill: ['#ff9900', '#fff4dd', '#ffc66e'],\n      radius: 8\n    },\n    function(opts) {\n      if (!opts.delimiter) {\n        var delimiter = this.$el.text().match(/[^0-9\\.]/)\n        opts.delimiter = delimiter ? delimiter[0] : \",\"\n      }\n\n      var values = $.map(this.values(), function(n) {\n        return n > 0 ? n : 0\n      })\n\n      if (opts.delimiter == \"/\") {\n        var v1 = values[0]\n        var v2 = values[1]\n        values = [v1, Math.max(0, v2 - v1)]\n      }\n\n      var i = 0\n      var length = values.length\n      var sum = 0\n\n      for (; i < length; i++) {\n        sum += values[i]\n      }\n\n      if (!sum) {\n        length = 2\n        sum = 1\n        values = [0, 1]\n      }\n\n      var diameter = opts.radius * 2\n\n      var $svg = this.prepare(\n        opts.width || diameter,\n        opts.height || diameter\n      )\n\n      var width = $svg.width()\n        , height = $svg.height()\n        , cx = width / 2\n        , cy = height / 2\n\n      var radius = Math.min(cx, cy)\n        , innerRadius = opts.innerRadius\n\n      if (this.type == 'donut' && !innerRadius) {\n        innerRadius = radius * 0.5\n      }\n\n      var pi = Math.PI\n      var fill = this.fill()\n\n      var scale = this.scale = function(value, radius) {\n        var radians = value / sum * pi * 2 - pi / 2\n\n        return [\n          radius * Math.cos(radians) + cx,\n          radius * Math.sin(radians) + cy\n        ]\n      }\n\n      var cumulative = 0\n\n      for (i = 0; i < length; i++) {\n        var value = values[i]\n          , portion = value / sum\n          , $node\n\n        if (portion == 0) continue\n\n        if (portion == 1) {\n          if (innerRadius) {\n            var x2 = cx - 0.01\n              , y1 = cy - radius\n              , y2 = cy - innerRadius\n\n            $node = svgElement('path', {\n              d: [\n                'M', cx, y1,\n                'A', radius, radius, 0, 1, 1, x2, y1,\n                'L', x2, y2,\n                'A', innerRadius, innerRadius, 0, 1, 0, cx, y2\n              ].join(' '),\n              'data-value': value,\n            })\n          } else {\n            $node = svgElement('circle', {\n              cx: cx,\n              cy: cy,\n              'data-value': value,\n              r: radius\n            })\n          }\n        } else {\n          var cumulativePlusValue = cumulative + value\n\n          var d = ['M'].concat(\n            scale(cumulative, radius),\n            'A', radius, radius, 0, portion > 0.5 ? 1 : 0, 1,\n            scale(cumulativePlusValue, radius),\n            'L'\n          )\n\n          if (innerRadius) {\n            d = d.concat(\n              scale(cumulativePlusValue, innerRadius),\n              'A', innerRadius, innerRadius, 0, portion > 0.5 ? 1 : 0, 0,\n              scale(cumulative, innerRadius)\n            )\n          } else {\n            d.push(cx, cy)\n          }\n\n          cumulative += value\n\n          $node = svgElement('path', {\n            d: d.join(\" \"),\n            'data-value': value,\n          })\n        }\n\n        $node.attr('fill', fill.call(this, value, i, values))\n\n        $svg.append($node)\n      }\n    }\n  )\n\n  peity.register(\n    'donut',\n    $.extend(true, {}, peity.defaults.pie),\n    function(opts) {\n      peity.graphers.pie.call(this, opts)\n    }\n  )\n\n  peity.register(\n    \"line\",\n    {\n      delimiter: \",\",\n      fill: \"#c6d9fd\",\n      height: 16,\n      min: 0,\n      stroke: \"#4d89f9\",\n      strokeWidth: 1,\n      width: 32\n    },\n    function(opts) {\n      var values = this.values()\n      if (values.length == 1) values.push(values[0])\n      var max = Math.max.apply(Math, opts.max == undefined ? values : values.concat(opts.max))\n        , min = Math.min.apply(Math, opts.min == undefined ? values : values.concat(opts.min))\n\n      var $svg = this.prepare(opts.width, opts.height)\n        , strokeWidth = opts.strokeWidth\n        , width = $svg.width()\n        , height = $svg.height() - strokeWidth\n        , diff = max - min\n\n      var xScale = this.x = function(input) {\n        return input * (width / (values.length - 1))\n      }\n\n      var yScale = this.y = function(input) {\n        var y = height\n\n        if (diff) {\n          y -= ((input - min) / diff) * height\n        }\n\n        return y + strokeWidth / 2\n      }\n\n      var zero = yScale(Math.max(min, 0))\n        , coords = [0, zero]\n\n      for (var i = 0; i < values.length; i++) {\n        coords.push(\n          xScale(i),\n          yScale(values[i])\n        )\n      }\n\n      coords.push(width, zero)\n\n      if (opts.fill) {\n        $svg.append(\n          svgElement('polygon', {\n            fill: opts.fill,\n            points: coords.join(' ')\n          })\n        )\n      }\n\n      if (strokeWidth) {\n        $svg.append(\n          svgElement('polyline', {\n            fill: 'none',\n            points: coords.slice(2, coords.length - 2).join(' '),\n            stroke: opts.stroke,\n            'stroke-width': strokeWidth,\n            'stroke-linecap': 'square'\n          })\n        )\n      }\n    }\n  );\n\n  peity.register(\n    'bar',\n    {\n      delimiter: \",\",\n      fill: [\"#4D89F9\"],\n      height: 16,\n      min: 0,\n      padding: 0.1,\n      width: 32\n    },\n    function(opts) {\n      var values = this.values()\n        , max = Math.max.apply(Math, opts.max == undefined ? values : values.concat(opts.max))\n        , min = Math.min.apply(Math, opts.min == undefined ? values : values.concat(opts.min))\n\n      var $svg = this.prepare(opts.width, opts.height)\n        , width = $svg.width()\n        , height = $svg.height()\n        , diff = max - min\n        , padding = opts.padding\n        , fill = this.fill()\n\n      var xScale = this.x = function(input) {\n        return input * width / values.length\n      }\n\n      var yScale = this.y = function(input) {\n        return height - (\n          diff\n            ? ((input - min) / diff) * height\n            : 1\n        )\n      }\n\n      for (var i = 0; i < values.length; i++) {\n        var x = xScale(i + padding)\n          , w = xScale(i + 1 - padding) - x\n          , value = values[i]\n          , valueY = yScale(value)\n          , y1 = valueY\n          , y2 = valueY\n          , h\n\n        if (!diff) {\n          h = 1\n        } else if (value < 0) {\n          y1 = yScale(Math.min(max, 0))\n        } else {\n          y2 = yScale(Math.max(min, 0))\n        }\n\n        h = y2 - y1\n\n        if (h == 0) {\n          h = 1\n          if (max > 0 && diff) y1--\n        }\n\n        $svg.append(\n          svgElement('rect', {\n            'data-value': value,\n            fill: fill.call(this, value, i, values),\n            x: x,\n            y: y1,\n            width: w,\n            height: h\n          })\n        )\n      }\n    }\n  );\n})(jQuery, document, Math);\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9ub2RlX21vZHVsZXMvcGVpdHkvanF1ZXJ5LnBlaXR5LmpzP2Y5ZGMiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBLFNBQVM7QUFDVDtBQUNBO0FBQ0E7QUFDQSx1QkFBdUI7QUFDdkI7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQSxnQ0FBZ0MsZUFBZTtBQUMvQztBQUNBOztBQUVBO0FBQ0EsT0FBTztBQUNQOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0EsMEVBQTBFOztBQUUxRTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBLHdCQUF3QjtBQUN4Qjs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EsU0FBUztBQUNUO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EsT0FBTztBQUNQOztBQUVBO0FBQ0E7QUFDQTtBQUNBLEtBQUs7QUFDTDs7QUFFQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSxLQUFLO0FBQ0w7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0EsT0FBTzs7QUFFUDtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTs7QUFFQSxZQUFZLFlBQVk7QUFDeEI7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBOztBQUVBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBOztBQUVBLGlCQUFpQixZQUFZO0FBQzdCO0FBQ0E7QUFDQTs7QUFFQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSxhQUFhO0FBQ2IsV0FBVztBQUNYO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSxhQUFhO0FBQ2I7QUFDQSxTQUFTO0FBQ1Q7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBLFdBQVc7QUFDWDtBQUNBOztBQUVBOztBQUVBO0FBQ0E7QUFDQTtBQUNBLFdBQVc7QUFDWDs7QUFFQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0EscUJBQXFCO0FBQ3JCO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EsS0FBSztBQUNMO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQTtBQUNBOztBQUVBLHFCQUFxQixtQkFBbUI7QUFDeEM7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EsV0FBVztBQUNYO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBLFdBQVc7QUFDWDtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSxLQUFLO0FBQ0w7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQSxxQkFBcUIsbUJBQW1CO0FBQ3hDO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQSxTQUFTO0FBQ1Q7QUFDQSxTQUFTO0FBQ1Q7QUFDQTs7QUFFQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EsV0FBVztBQUNYO0FBQ0E7QUFDQTtBQUNBO0FBQ0EsQ0FBQyIsImZpbGUiOiIuL25vZGVfbW9kdWxlcy9wZWl0eS9qcXVlcnkucGVpdHkuanMuanMiLCJzb3VyY2VzQ29udGVudCI6WyIvLyBQZWl0eSBqUXVlcnkgcGx1Z2luIHZlcnNpb24gMy4zLjBcbi8vIChjKSAyMDE4IEJlbiBQaWNrbGVzXG4vL1xuLy8gaHR0cDovL2JlbnBpY2tsZXMuZ2l0aHViLmlvL3BlaXR5XG4vL1xuLy8gUmVsZWFzZWQgdW5kZXIgTUlUIGxpY2Vuc2UuXG4oZnVuY3Rpb24oJCwgZG9jdW1lbnQsIE1hdGgsIHVuZGVmaW5lZCkge1xuICB2YXIgcGVpdHkgPSAkLmZuLnBlaXR5ID0gZnVuY3Rpb24odHlwZSwgb3B0aW9ucykge1xuICAgIGlmIChzdmdTdXBwb3J0ZWQpIHtcbiAgICAgIHRoaXMuZWFjaChmdW5jdGlvbigpIHtcbiAgICAgICAgdmFyICR0aGlzID0gJCh0aGlzKVxuICAgICAgICB2YXIgY2hhcnQgPSAkdGhpcy5kYXRhKCdfcGVpdHknKVxuXG4gICAgICAgIGlmIChjaGFydCkge1xuICAgICAgICAgIGlmICh0eXBlKSBjaGFydC50eXBlID0gdHlwZVxuICAgICAgICAgICQuZXh0ZW5kKGNoYXJ0Lm9wdHMsIG9wdGlvbnMpXG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgY2hhcnQgPSBuZXcgUGVpdHkoXG4gICAgICAgICAgICAkdGhpcyxcbiAgICAgICAgICAgIHR5cGUsXG4gICAgICAgICAgICAkLmV4dGVuZCh7fSxcbiAgICAgICAgICAgICAgcGVpdHkuZGVmYXVsdHNbdHlwZV0sXG4gICAgICAgICAgICAgICR0aGlzLmRhdGEoJ3BlaXR5JyksXG4gICAgICAgICAgICAgIG9wdGlvbnMpXG4gICAgICAgICAgKVxuXG4gICAgICAgICAgJHRoaXNcbiAgICAgICAgICAgIC5jaGFuZ2UoZnVuY3Rpb24oKSB7IGNoYXJ0LmRyYXcoKSB9KVxuICAgICAgICAgICAgLmRhdGEoJ19wZWl0eScsIGNoYXJ0KVxuICAgICAgICB9XG5cbiAgICAgICAgY2hhcnQuZHJhdygpXG4gICAgICB9KTtcbiAgICB9XG5cbiAgICByZXR1cm4gdGhpcztcbiAgfTtcblxuICB2YXIgUGVpdHkgPSBmdW5jdGlvbigkZWwsIHR5cGUsIG9wdHMpIHtcbiAgICB0aGlzLiRlbCA9ICRlbFxuICAgIHRoaXMudHlwZSA9IHR5cGVcbiAgICB0aGlzLm9wdHMgPSBvcHRzXG4gIH1cblxuICB2YXIgUGVpdHlQcm90b3R5cGUgPSBQZWl0eS5wcm90b3R5cGVcblxuICB2YXIgc3ZnRWxlbWVudCA9IFBlaXR5UHJvdG90eXBlLnN2Z0VsZW1lbnQgPSBmdW5jdGlvbih0YWcsIGF0dHJzKSB7XG4gICAgcmV0dXJuICQoXG4gICAgICBkb2N1bWVudC5jcmVhdGVFbGVtZW50TlMoJ2h0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnJywgdGFnKVxuICAgICkuYXR0cihhdHRycylcbiAgfVxuXG4gIC8vIGh0dHBzOi8vZ2lzdC5naXRodWIuY29tL21hZHJvYmJ5LzMyMDE0NzJcbiAgdmFyIHN2Z1N1cHBvcnRlZCA9ICdjcmVhdGVFbGVtZW50TlMnIGluIGRvY3VtZW50ICYmIHN2Z0VsZW1lbnQoJ3N2ZycsIHt9KVswXS5jcmVhdGVTVkdSZWN0XG5cbiAgUGVpdHlQcm90b3R5cGUuZHJhdyA9IGZ1bmN0aW9uKCkge1xuICAgIHZhciBvcHRzID0gdGhpcy5vcHRzXG4gICAgcGVpdHkuZ3JhcGhlcnNbdGhpcy50eXBlXS5jYWxsKHRoaXMsIG9wdHMpXG4gICAgaWYgKG9wdHMuYWZ0ZXIpIG9wdHMuYWZ0ZXIuY2FsbCh0aGlzLCBvcHRzKVxuICB9XG5cbiAgUGVpdHlQcm90b3R5cGUuZmlsbCA9IGZ1bmN0aW9uKCkge1xuICAgIHZhciBmaWxsID0gdGhpcy5vcHRzLmZpbGxcblxuICAgIHJldHVybiAkLmlzRnVuY3Rpb24oZmlsbClcbiAgICAgID8gZmlsbFxuICAgICAgOiBmdW5jdGlvbihfLCBpKSB7IHJldHVybiBmaWxsW2kgJSBmaWxsLmxlbmd0aF0gfVxuICB9XG5cbiAgUGVpdHlQcm90b3R5cGUucHJlcGFyZSA9IGZ1bmN0aW9uKHdpZHRoLCBoZWlnaHQpIHtcbiAgICBpZiAoIXRoaXMuJHN2Zykge1xuICAgICAgdGhpcy4kZWwuaGlkZSgpLmFmdGVyKFxuICAgICAgICB0aGlzLiRzdmcgPSBzdmdFbGVtZW50KCdzdmcnLCB7XG4gICAgICAgICAgXCJjbGFzc1wiOiBcInBlaXR5XCJcbiAgICAgICAgfSlcbiAgICAgIClcbiAgICB9XG5cbiAgICByZXR1cm4gdGhpcy4kc3ZnXG4gICAgICAuZW1wdHkoKVxuICAgICAgLmRhdGEoJ19wZWl0eScsIHRoaXMpXG4gICAgICAuYXR0cih7XG4gICAgICAgIGhlaWdodDogaGVpZ2h0LFxuICAgICAgICB3aWR0aDogd2lkdGhcbiAgICAgIH0pXG4gIH1cblxuICBQZWl0eVByb3RvdHlwZS52YWx1ZXMgPSBmdW5jdGlvbigpIHtcbiAgICByZXR1cm4gJC5tYXAodGhpcy4kZWwudGV4dCgpLnNwbGl0KHRoaXMub3B0cy5kZWxpbWl0ZXIpLCBmdW5jdGlvbih2YWx1ZSkge1xuICAgICAgcmV0dXJuIHBhcnNlRmxvYXQodmFsdWUpXG4gICAgfSlcbiAgfVxuXG4gIHBlaXR5LmRlZmF1bHRzID0ge31cbiAgcGVpdHkuZ3JhcGhlcnMgPSB7fVxuXG4gIHBlaXR5LnJlZ2lzdGVyID0gZnVuY3Rpb24odHlwZSwgZGVmYXVsdHMsIGdyYXBoZXIpIHtcbiAgICB0aGlzLmRlZmF1bHRzW3R5cGVdID0gZGVmYXVsdHNcbiAgICB0aGlzLmdyYXBoZXJzW3R5cGVdID0gZ3JhcGhlclxuICB9XG5cbiAgcGVpdHkucmVnaXN0ZXIoXG4gICAgJ3BpZScsXG4gICAge1xuICAgICAgZmlsbDogWycjZmY5OTAwJywgJyNmZmY0ZGQnLCAnI2ZmYzY2ZSddLFxuICAgICAgcmFkaXVzOiA4XG4gICAgfSxcbiAgICBmdW5jdGlvbihvcHRzKSB7XG4gICAgICBpZiAoIW9wdHMuZGVsaW1pdGVyKSB7XG4gICAgICAgIHZhciBkZWxpbWl0ZXIgPSB0aGlzLiRlbC50ZXh0KCkubWF0Y2goL1teMC05XFwuXS8pXG4gICAgICAgIG9wdHMuZGVsaW1pdGVyID0gZGVsaW1pdGVyID8gZGVsaW1pdGVyWzBdIDogXCIsXCJcbiAgICAgIH1cblxuICAgICAgdmFyIHZhbHVlcyA9ICQubWFwKHRoaXMudmFsdWVzKCksIGZ1bmN0aW9uKG4pIHtcbiAgICAgICAgcmV0dXJuIG4gPiAwID8gbiA6IDBcbiAgICAgIH0pXG5cbiAgICAgIGlmIChvcHRzLmRlbGltaXRlciA9PSBcIi9cIikge1xuICAgICAgICB2YXIgdjEgPSB2YWx1ZXNbMF1cbiAgICAgICAgdmFyIHYyID0gdmFsdWVzWzFdXG4gICAgICAgIHZhbHVlcyA9IFt2MSwgTWF0aC5tYXgoMCwgdjIgLSB2MSldXG4gICAgICB9XG5cbiAgICAgIHZhciBpID0gMFxuICAgICAgdmFyIGxlbmd0aCA9IHZhbHVlcy5sZW5ndGhcbiAgICAgIHZhciBzdW0gPSAwXG5cbiAgICAgIGZvciAoOyBpIDwgbGVuZ3RoOyBpKyspIHtcbiAgICAgICAgc3VtICs9IHZhbHVlc1tpXVxuICAgICAgfVxuXG4gICAgICBpZiAoIXN1bSkge1xuICAgICAgICBsZW5ndGggPSAyXG4gICAgICAgIHN1bSA9IDFcbiAgICAgICAgdmFsdWVzID0gWzAsIDFdXG4gICAgICB9XG5cbiAgICAgIHZhciBkaWFtZXRlciA9IG9wdHMucmFkaXVzICogMlxuXG4gICAgICB2YXIgJHN2ZyA9IHRoaXMucHJlcGFyZShcbiAgICAgICAgb3B0cy53aWR0aCB8fCBkaWFtZXRlcixcbiAgICAgICAgb3B0cy5oZWlnaHQgfHwgZGlhbWV0ZXJcbiAgICAgIClcblxuICAgICAgdmFyIHdpZHRoID0gJHN2Zy53aWR0aCgpXG4gICAgICAgICwgaGVpZ2h0ID0gJHN2Zy5oZWlnaHQoKVxuICAgICAgICAsIGN4ID0gd2lkdGggLyAyXG4gICAgICAgICwgY3kgPSBoZWlnaHQgLyAyXG5cbiAgICAgIHZhciByYWRpdXMgPSBNYXRoLm1pbihjeCwgY3kpXG4gICAgICAgICwgaW5uZXJSYWRpdXMgPSBvcHRzLmlubmVyUmFkaXVzXG5cbiAgICAgIGlmICh0aGlzLnR5cGUgPT0gJ2RvbnV0JyAmJiAhaW5uZXJSYWRpdXMpIHtcbiAgICAgICAgaW5uZXJSYWRpdXMgPSByYWRpdXMgKiAwLjVcbiAgICAgIH1cblxuICAgICAgdmFyIHBpID0gTWF0aC5QSVxuICAgICAgdmFyIGZpbGwgPSB0aGlzLmZpbGwoKVxuXG4gICAgICB2YXIgc2NhbGUgPSB0aGlzLnNjYWxlID0gZnVuY3Rpb24odmFsdWUsIHJhZGl1cykge1xuICAgICAgICB2YXIgcmFkaWFucyA9IHZhbHVlIC8gc3VtICogcGkgKiAyIC0gcGkgLyAyXG5cbiAgICAgICAgcmV0dXJuIFtcbiAgICAgICAgICByYWRpdXMgKiBNYXRoLmNvcyhyYWRpYW5zKSArIGN4LFxuICAgICAgICAgIHJhZGl1cyAqIE1hdGguc2luKHJhZGlhbnMpICsgY3lcbiAgICAgICAgXVxuICAgICAgfVxuXG4gICAgICB2YXIgY3VtdWxhdGl2ZSA9IDBcblxuICAgICAgZm9yIChpID0gMDsgaSA8IGxlbmd0aDsgaSsrKSB7XG4gICAgICAgIHZhciB2YWx1ZSA9IHZhbHVlc1tpXVxuICAgICAgICAgICwgcG9ydGlvbiA9IHZhbHVlIC8gc3VtXG4gICAgICAgICAgLCAkbm9kZVxuXG4gICAgICAgIGlmIChwb3J0aW9uID09IDApIGNvbnRpbnVlXG5cbiAgICAgICAgaWYgKHBvcnRpb24gPT0gMSkge1xuICAgICAgICAgIGlmIChpbm5lclJhZGl1cykge1xuICAgICAgICAgICAgdmFyIHgyID0gY3ggLSAwLjAxXG4gICAgICAgICAgICAgICwgeTEgPSBjeSAtIHJhZGl1c1xuICAgICAgICAgICAgICAsIHkyID0gY3kgLSBpbm5lclJhZGl1c1xuXG4gICAgICAgICAgICAkbm9kZSA9IHN2Z0VsZW1lbnQoJ3BhdGgnLCB7XG4gICAgICAgICAgICAgIGQ6IFtcbiAgICAgICAgICAgICAgICAnTScsIGN4LCB5MSxcbiAgICAgICAgICAgICAgICAnQScsIHJhZGl1cywgcmFkaXVzLCAwLCAxLCAxLCB4MiwgeTEsXG4gICAgICAgICAgICAgICAgJ0wnLCB4MiwgeTIsXG4gICAgICAgICAgICAgICAgJ0EnLCBpbm5lclJhZGl1cywgaW5uZXJSYWRpdXMsIDAsIDEsIDAsIGN4LCB5MlxuICAgICAgICAgICAgICBdLmpvaW4oJyAnKSxcbiAgICAgICAgICAgICAgJ2RhdGEtdmFsdWUnOiB2YWx1ZSxcbiAgICAgICAgICAgIH0pXG4gICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICRub2RlID0gc3ZnRWxlbWVudCgnY2lyY2xlJywge1xuICAgICAgICAgICAgICBjeDogY3gsXG4gICAgICAgICAgICAgIGN5OiBjeSxcbiAgICAgICAgICAgICAgJ2RhdGEtdmFsdWUnOiB2YWx1ZSxcbiAgICAgICAgICAgICAgcjogcmFkaXVzXG4gICAgICAgICAgICB9KVxuICAgICAgICAgIH1cbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICB2YXIgY3VtdWxhdGl2ZVBsdXNWYWx1ZSA9IGN1bXVsYXRpdmUgKyB2YWx1ZVxuXG4gICAgICAgICAgdmFyIGQgPSBbJ00nXS5jb25jYXQoXG4gICAgICAgICAgICBzY2FsZShjdW11bGF0aXZlLCByYWRpdXMpLFxuICAgICAgICAgICAgJ0EnLCByYWRpdXMsIHJhZGl1cywgMCwgcG9ydGlvbiA+IDAuNSA/IDEgOiAwLCAxLFxuICAgICAgICAgICAgc2NhbGUoY3VtdWxhdGl2ZVBsdXNWYWx1ZSwgcmFkaXVzKSxcbiAgICAgICAgICAgICdMJ1xuICAgICAgICAgIClcblxuICAgICAgICAgIGlmIChpbm5lclJhZGl1cykge1xuICAgICAgICAgICAgZCA9IGQuY29uY2F0KFxuICAgICAgICAgICAgICBzY2FsZShjdW11bGF0aXZlUGx1c1ZhbHVlLCBpbm5lclJhZGl1cyksXG4gICAgICAgICAgICAgICdBJywgaW5uZXJSYWRpdXMsIGlubmVyUmFkaXVzLCAwLCBwb3J0aW9uID4gMC41ID8gMSA6IDAsIDAsXG4gICAgICAgICAgICAgIHNjYWxlKGN1bXVsYXRpdmUsIGlubmVyUmFkaXVzKVxuICAgICAgICAgICAgKVxuICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICBkLnB1c2goY3gsIGN5KVxuICAgICAgICAgIH1cblxuICAgICAgICAgIGN1bXVsYXRpdmUgKz0gdmFsdWVcblxuICAgICAgICAgICRub2RlID0gc3ZnRWxlbWVudCgncGF0aCcsIHtcbiAgICAgICAgICAgIGQ6IGQuam9pbihcIiBcIiksXG4gICAgICAgICAgICAnZGF0YS12YWx1ZSc6IHZhbHVlLFxuICAgICAgICAgIH0pXG4gICAgICAgIH1cblxuICAgICAgICAkbm9kZS5hdHRyKCdmaWxsJywgZmlsbC5jYWxsKHRoaXMsIHZhbHVlLCBpLCB2YWx1ZXMpKVxuXG4gICAgICAgICRzdmcuYXBwZW5kKCRub2RlKVxuICAgICAgfVxuICAgIH1cbiAgKVxuXG4gIHBlaXR5LnJlZ2lzdGVyKFxuICAgICdkb251dCcsXG4gICAgJC5leHRlbmQodHJ1ZSwge30sIHBlaXR5LmRlZmF1bHRzLnBpZSksXG4gICAgZnVuY3Rpb24ob3B0cykge1xuICAgICAgcGVpdHkuZ3JhcGhlcnMucGllLmNhbGwodGhpcywgb3B0cylcbiAgICB9XG4gIClcblxuICBwZWl0eS5yZWdpc3RlcihcbiAgICBcImxpbmVcIixcbiAgICB7XG4gICAgICBkZWxpbWl0ZXI6IFwiLFwiLFxuICAgICAgZmlsbDogXCIjYzZkOWZkXCIsXG4gICAgICBoZWlnaHQ6IDE2LFxuICAgICAgbWluOiAwLFxuICAgICAgc3Ryb2tlOiBcIiM0ZDg5ZjlcIixcbiAgICAgIHN0cm9rZVdpZHRoOiAxLFxuICAgICAgd2lkdGg6IDMyXG4gICAgfSxcbiAgICBmdW5jdGlvbihvcHRzKSB7XG4gICAgICB2YXIgdmFsdWVzID0gdGhpcy52YWx1ZXMoKVxuICAgICAgaWYgKHZhbHVlcy5sZW5ndGggPT0gMSkgdmFsdWVzLnB1c2godmFsdWVzWzBdKVxuICAgICAgdmFyIG1heCA9IE1hdGgubWF4LmFwcGx5KE1hdGgsIG9wdHMubWF4ID09IHVuZGVmaW5lZCA/IHZhbHVlcyA6IHZhbHVlcy5jb25jYXQob3B0cy5tYXgpKVxuICAgICAgICAsIG1pbiA9IE1hdGgubWluLmFwcGx5KE1hdGgsIG9wdHMubWluID09IHVuZGVmaW5lZCA/IHZhbHVlcyA6IHZhbHVlcy5jb25jYXQob3B0cy5taW4pKVxuXG4gICAgICB2YXIgJHN2ZyA9IHRoaXMucHJlcGFyZShvcHRzLndpZHRoLCBvcHRzLmhlaWdodClcbiAgICAgICAgLCBzdHJva2VXaWR0aCA9IG9wdHMuc3Ryb2tlV2lkdGhcbiAgICAgICAgLCB3aWR0aCA9ICRzdmcud2lkdGgoKVxuICAgICAgICAsIGhlaWdodCA9ICRzdmcuaGVpZ2h0KCkgLSBzdHJva2VXaWR0aFxuICAgICAgICAsIGRpZmYgPSBtYXggLSBtaW5cblxuICAgICAgdmFyIHhTY2FsZSA9IHRoaXMueCA9IGZ1bmN0aW9uKGlucHV0KSB7XG4gICAgICAgIHJldHVybiBpbnB1dCAqICh3aWR0aCAvICh2YWx1ZXMubGVuZ3RoIC0gMSkpXG4gICAgICB9XG5cbiAgICAgIHZhciB5U2NhbGUgPSB0aGlzLnkgPSBmdW5jdGlvbihpbnB1dCkge1xuICAgICAgICB2YXIgeSA9IGhlaWdodFxuXG4gICAgICAgIGlmIChkaWZmKSB7XG4gICAgICAgICAgeSAtPSAoKGlucHV0IC0gbWluKSAvIGRpZmYpICogaGVpZ2h0XG4gICAgICAgIH1cblxuICAgICAgICByZXR1cm4geSArIHN0cm9rZVdpZHRoIC8gMlxuICAgICAgfVxuXG4gICAgICB2YXIgemVybyA9IHlTY2FsZShNYXRoLm1heChtaW4sIDApKVxuICAgICAgICAsIGNvb3JkcyA9IFswLCB6ZXJvXVxuXG4gICAgICBmb3IgKHZhciBpID0gMDsgaSA8IHZhbHVlcy5sZW5ndGg7IGkrKykge1xuICAgICAgICBjb29yZHMucHVzaChcbiAgICAgICAgICB4U2NhbGUoaSksXG4gICAgICAgICAgeVNjYWxlKHZhbHVlc1tpXSlcbiAgICAgICAgKVxuICAgICAgfVxuXG4gICAgICBjb29yZHMucHVzaCh3aWR0aCwgemVybylcblxuICAgICAgaWYgKG9wdHMuZmlsbCkge1xuICAgICAgICAkc3ZnLmFwcGVuZChcbiAgICAgICAgICBzdmdFbGVtZW50KCdwb2x5Z29uJywge1xuICAgICAgICAgICAgZmlsbDogb3B0cy5maWxsLFxuICAgICAgICAgICAgcG9pbnRzOiBjb29yZHMuam9pbignICcpXG4gICAgICAgICAgfSlcbiAgICAgICAgKVxuICAgICAgfVxuXG4gICAgICBpZiAoc3Ryb2tlV2lkdGgpIHtcbiAgICAgICAgJHN2Zy5hcHBlbmQoXG4gICAgICAgICAgc3ZnRWxlbWVudCgncG9seWxpbmUnLCB7XG4gICAgICAgICAgICBmaWxsOiAnbm9uZScsXG4gICAgICAgICAgICBwb2ludHM6IGNvb3Jkcy5zbGljZSgyLCBjb29yZHMubGVuZ3RoIC0gMikuam9pbignICcpLFxuICAgICAgICAgICAgc3Ryb2tlOiBvcHRzLnN0cm9rZSxcbiAgICAgICAgICAgICdzdHJva2Utd2lkdGgnOiBzdHJva2VXaWR0aCxcbiAgICAgICAgICAgICdzdHJva2UtbGluZWNhcCc6ICdzcXVhcmUnXG4gICAgICAgICAgfSlcbiAgICAgICAgKVxuICAgICAgfVxuICAgIH1cbiAgKTtcblxuICBwZWl0eS5yZWdpc3RlcihcbiAgICAnYmFyJyxcbiAgICB7XG4gICAgICBkZWxpbWl0ZXI6IFwiLFwiLFxuICAgICAgZmlsbDogW1wiIzREODlGOVwiXSxcbiAgICAgIGhlaWdodDogMTYsXG4gICAgICBtaW46IDAsXG4gICAgICBwYWRkaW5nOiAwLjEsXG4gICAgICB3aWR0aDogMzJcbiAgICB9LFxuICAgIGZ1bmN0aW9uKG9wdHMpIHtcbiAgICAgIHZhciB2YWx1ZXMgPSB0aGlzLnZhbHVlcygpXG4gICAgICAgICwgbWF4ID0gTWF0aC5tYXguYXBwbHkoTWF0aCwgb3B0cy5tYXggPT0gdW5kZWZpbmVkID8gdmFsdWVzIDogdmFsdWVzLmNvbmNhdChvcHRzLm1heCkpXG4gICAgICAgICwgbWluID0gTWF0aC5taW4uYXBwbHkoTWF0aCwgb3B0cy5taW4gPT0gdW5kZWZpbmVkID8gdmFsdWVzIDogdmFsdWVzLmNvbmNhdChvcHRzLm1pbikpXG5cbiAgICAgIHZhciAkc3ZnID0gdGhpcy5wcmVwYXJlKG9wdHMud2lkdGgsIG9wdHMuaGVpZ2h0KVxuICAgICAgICAsIHdpZHRoID0gJHN2Zy53aWR0aCgpXG4gICAgICAgICwgaGVpZ2h0ID0gJHN2Zy5oZWlnaHQoKVxuICAgICAgICAsIGRpZmYgPSBtYXggLSBtaW5cbiAgICAgICAgLCBwYWRkaW5nID0gb3B0cy5wYWRkaW5nXG4gICAgICAgICwgZmlsbCA9IHRoaXMuZmlsbCgpXG5cbiAgICAgIHZhciB4U2NhbGUgPSB0aGlzLnggPSBmdW5jdGlvbihpbnB1dCkge1xuICAgICAgICByZXR1cm4gaW5wdXQgKiB3aWR0aCAvIHZhbHVlcy5sZW5ndGhcbiAgICAgIH1cblxuICAgICAgdmFyIHlTY2FsZSA9IHRoaXMueSA9IGZ1bmN0aW9uKGlucHV0KSB7XG4gICAgICAgIHJldHVybiBoZWlnaHQgLSAoXG4gICAgICAgICAgZGlmZlxuICAgICAgICAgICAgPyAoKGlucHV0IC0gbWluKSAvIGRpZmYpICogaGVpZ2h0XG4gICAgICAgICAgICA6IDFcbiAgICAgICAgKVxuICAgICAgfVxuXG4gICAgICBmb3IgKHZhciBpID0gMDsgaSA8IHZhbHVlcy5sZW5ndGg7IGkrKykge1xuICAgICAgICB2YXIgeCA9IHhTY2FsZShpICsgcGFkZGluZylcbiAgICAgICAgICAsIHcgPSB4U2NhbGUoaSArIDEgLSBwYWRkaW5nKSAtIHhcbiAgICAgICAgICAsIHZhbHVlID0gdmFsdWVzW2ldXG4gICAgICAgICAgLCB2YWx1ZVkgPSB5U2NhbGUodmFsdWUpXG4gICAgICAgICAgLCB5MSA9IHZhbHVlWVxuICAgICAgICAgICwgeTIgPSB2YWx1ZVlcbiAgICAgICAgICAsIGhcblxuICAgICAgICBpZiAoIWRpZmYpIHtcbiAgICAgICAgICBoID0gMVxuICAgICAgICB9IGVsc2UgaWYgKHZhbHVlIDwgMCkge1xuICAgICAgICAgIHkxID0geVNjYWxlKE1hdGgubWluKG1heCwgMCkpXG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgeTIgPSB5U2NhbGUoTWF0aC5tYXgobWluLCAwKSlcbiAgICAgICAgfVxuXG4gICAgICAgIGggPSB5MiAtIHkxXG5cbiAgICAgICAgaWYgKGggPT0gMCkge1xuICAgICAgICAgIGggPSAxXG4gICAgICAgICAgaWYgKG1heCA+IDAgJiYgZGlmZikgeTEtLVxuICAgICAgICB9XG5cbiAgICAgICAgJHN2Zy5hcHBlbmQoXG4gICAgICAgICAgc3ZnRWxlbWVudCgncmVjdCcsIHtcbiAgICAgICAgICAgICdkYXRhLXZhbHVlJzogdmFsdWUsXG4gICAgICAgICAgICBmaWxsOiBmaWxsLmNhbGwodGhpcywgdmFsdWUsIGksIHZhbHVlcyksXG4gICAgICAgICAgICB4OiB4LFxuICAgICAgICAgICAgeTogeTEsXG4gICAgICAgICAgICB3aWR0aDogdyxcbiAgICAgICAgICAgIGhlaWdodDogaFxuICAgICAgICAgIH0pXG4gICAgICAgIClcbiAgICAgIH1cbiAgICB9XG4gICk7XG59KShqUXVlcnksIGRvY3VtZW50LCBNYXRoKTtcbiJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./node_modules/peity/jquery.peity.js\n");

/***/ }),

/***/ "./src/assets/scripts/colors.js":
/*!**************************************!*\
  !*** ./src/assets/scripts/colors.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("module.exports = {\n  \"primary\": \"#1791ba\",\n  \"secondary\": \"#6c757d\",\n  \"success\": \"#17ba91\",\n  \"info\": \"#17a2b8\",\n  \"warning\": \"#e8ba30\",\n  \"danger\": \"#e84a67\",\n  \"light\": \"#e9ecef\",\n  \"dark\": \"#343a40\",\n  \"chili\": \"#c21807\",\n  \"imperial\": \"#ed2939\",\n  \"salmon\": \"#fa8072\",\n  \"rose\": \"#f64a8a\",\n  \"bubblegum\": \"#fe5bac\",\n  \"taffy\": \"#f987c5\",\n  \"pumpkin\": \"#ff7417\",\n  \"apricot\": \"#eb9605\",\n  \"honey\": \"#f9a602\",\n  \"tuscany\": \"#fcd12a\",\n  \"mustard\": \"#fedc56\",\n  \"lemon\": \"#effd5f\",\n  \"grape\": \"#6f2da8\",\n  \"orchid\": \"#af69ee\",\n  \"lilac\": \"#b660cd\",\n  \"sapphire\": \"#0f52ba\",\n  \"azure\": \"#0080fe\",\n  \"carolina\": \"#57a0d2\",\n  \"forest\": \"#0b6623\",\n  \"jade\": \"#00a86b\",\n  \"lime\": \"#4cbb17\",\n  \"coffee\": \"#4b3619\",\n  \"caramel\": \"#613613\",\n  \"tortilla\": \"#997950\"\n};//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9zcmMvYXNzZXRzL3NjcmlwdHMvY29sb3JzLmpzPzRmZDQiXSwibmFtZXMiOlsibW9kdWxlIiwiZXhwb3J0cyJdLCJtYXBwaW5ncyI6IkFBQUFBLE1BQU0sQ0FBQ0MsT0FBUCxHQUFpQjtBQUNiLGFBQVcsU0FERTtBQUViLGVBQWEsU0FGQTtBQUdiLGFBQVcsU0FIRTtBQUliLFVBQVEsU0FKSztBQUtiLGFBQVcsU0FMRTtBQU1iLFlBQVUsU0FORztBQU9iLFdBQVMsU0FQSTtBQVFiLFVBQVEsU0FSSztBQVNiLFdBQVMsU0FUSTtBQVViLGNBQVksU0FWQztBQVdiLFlBQVUsU0FYRztBQVliLFVBQVEsU0FaSztBQWFiLGVBQWEsU0FiQTtBQWNiLFdBQVMsU0FkSTtBQWViLGFBQVcsU0FmRTtBQWdCYixhQUFXLFNBaEJFO0FBaUJiLFdBQVMsU0FqQkk7QUFrQmIsYUFBVyxTQWxCRTtBQW1CYixhQUFXLFNBbkJFO0FBb0JiLFdBQVMsU0FwQkk7QUFxQmIsV0FBUyxTQXJCSTtBQXNCYixZQUFVLFNBdEJHO0FBdUJiLFdBQVMsU0F2Qkk7QUF3QmIsY0FBWSxTQXhCQztBQXlCYixXQUFTLFNBekJJO0FBMEJiLGNBQVksU0ExQkM7QUEyQmIsWUFBVSxTQTNCRztBQTRCYixVQUFRLFNBNUJLO0FBNkJiLFVBQVEsU0E3Qks7QUE4QmIsWUFBVSxTQTlCRztBQStCYixhQUFXLFNBL0JFO0FBZ0NiLGNBQVk7QUFoQ0MsQ0FBakIiLCJmaWxlIjoiLi9zcmMvYXNzZXRzL3NjcmlwdHMvY29sb3JzLmpzLmpzIiwic291cmNlc0NvbnRlbnQiOlsibW9kdWxlLmV4cG9ydHMgPSB7XG4gICAgXCJwcmltYXJ5XCI6IFwiIzE3OTFiYVwiLFxuICAgIFwic2Vjb25kYXJ5XCI6IFwiIzZjNzU3ZFwiLFxuICAgIFwic3VjY2Vzc1wiOiBcIiMxN2JhOTFcIixcbiAgICBcImluZm9cIjogXCIjMTdhMmI4XCIsXG4gICAgXCJ3YXJuaW5nXCI6IFwiI2U4YmEzMFwiLFxuICAgIFwiZGFuZ2VyXCI6IFwiI2U4NGE2N1wiLFxuICAgIFwibGlnaHRcIjogXCIjZTllY2VmXCIsXG4gICAgXCJkYXJrXCI6IFwiIzM0M2E0MFwiLFxuICAgIFwiY2hpbGlcIjogXCIjYzIxODA3XCIsXG4gICAgXCJpbXBlcmlhbFwiOiBcIiNlZDI5MzlcIixcbiAgICBcInNhbG1vblwiOiBcIiNmYTgwNzJcIixcbiAgICBcInJvc2VcIjogXCIjZjY0YThhXCIsXG4gICAgXCJidWJibGVndW1cIjogXCIjZmU1YmFjXCIsXG4gICAgXCJ0YWZmeVwiOiBcIiNmOTg3YzVcIixcbiAgICBcInB1bXBraW5cIjogXCIjZmY3NDE3XCIsXG4gICAgXCJhcHJpY290XCI6IFwiI2ViOTYwNVwiLFxuICAgIFwiaG9uZXlcIjogXCIjZjlhNjAyXCIsXG4gICAgXCJ0dXNjYW55XCI6IFwiI2ZjZDEyYVwiLFxuICAgIFwibXVzdGFyZFwiOiBcIiNmZWRjNTZcIixcbiAgICBcImxlbW9uXCI6IFwiI2VmZmQ1ZlwiLFxuICAgIFwiZ3JhcGVcIjogXCIjNmYyZGE4XCIsXG4gICAgXCJvcmNoaWRcIjogXCIjYWY2OWVlXCIsXG4gICAgXCJsaWxhY1wiOiBcIiNiNjYwY2RcIixcbiAgICBcInNhcHBoaXJlXCI6IFwiIzBmNTJiYVwiLFxuICAgIFwiYXp1cmVcIjogXCIjMDA4MGZlXCIsXG4gICAgXCJjYXJvbGluYVwiOiBcIiM1N2EwZDJcIixcbiAgICBcImZvcmVzdFwiOiBcIiMwYjY2MjNcIixcbiAgICBcImphZGVcIjogXCIjMDBhODZiXCIsXG4gICAgXCJsaW1lXCI6IFwiIzRjYmIxN1wiLFxuICAgIFwiY29mZmVlXCI6IFwiIzRiMzYxOVwiLFxuICAgIFwiY2FyYW1lbFwiOiBcIiM2MTM2MTNcIixcbiAgICBcInRvcnRpbGxhXCI6IFwiIzk5Nzk1MFwiXG59OyJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./src/assets/scripts/colors.js\n");

/***/ }),

/***/ "./src/assets/scripts/pages/ui_card.js":
/*!*********************************************!*\
  !*** ./src/assets/scripts/pages/ui_card.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("__webpack_require__(/*! peity */ \"./node_modules/peity/jquery.peity.js\");\n\nvar themeColor = __webpack_require__(/*! ../colors */ \"./src/assets/scripts/colors.js\");\n\nvar UI_card = function () {\n  var initPeityCharts = function initPeityCharts() {\n    var bubblegum = themeColor.bubblegum;\n    var danger = themeColor.danger;\n    var updatingChart = $('.chart1').peity('line', {\n      height: 60,\n      width: '100%',\n      fill: bubblegum,\n      stroke: null\n    });\n    setInterval(function () {\n      var random = Math.round(Math.random() * 10);\n      var values = updatingChart.text().split(\",\");\n      values.shift();\n      values.push(random);\n      updatingChart.text(values.join(\",\")).change();\n    }, 1000);\n    $('.chart2').peity('bar', {\n      height: 34,\n      width: 60,\n      fill: function fill(_, i, all) {\n        var g = parseInt(i / all.length * 255);\n        return \"rgb(255, \" + g + \", 0)\";\n      }\n    });\n  };\n\n  return {\n    init: function init() {\n      initPeityCharts();\n    }\n  };\n}();\n\n$(function () {\n  UI_card.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9zcmMvYXNzZXRzL3NjcmlwdHMvcGFnZXMvdWlfY2FyZC5qcz84NWY1Il0sIm5hbWVzIjpbInJlcXVpcmUiLCJ0aGVtZUNvbG9yIiwiVUlfY2FyZCIsImluaXRQZWl0eUNoYXJ0cyIsImJ1YmJsZWd1bSIsImRhbmdlciIsInVwZGF0aW5nQ2hhcnQiLCIkIiwicGVpdHkiLCJoZWlnaHQiLCJ3aWR0aCIsImZpbGwiLCJzdHJva2UiLCJzZXRJbnRlcnZhbCIsInJhbmRvbSIsIk1hdGgiLCJyb3VuZCIsInZhbHVlcyIsInRleHQiLCJzcGxpdCIsInNoaWZ0IiwicHVzaCIsImpvaW4iLCJjaGFuZ2UiLCJfIiwiaSIsImFsbCIsImciLCJwYXJzZUludCIsImxlbmd0aCIsImluaXQiXSwibWFwcGluZ3MiOiJBQUFBQSxtQkFBTyxDQUFDLG1EQUFELENBQVA7O0FBQ0EsSUFBTUMsVUFBVSxHQUFHRCxtQkFBTyxDQUFDLGlEQUFELENBQTFCOztBQUVBLElBQUlFLE9BQU8sR0FBRyxZQUFZO0FBRXRCLE1BQUlDLGVBQWUsR0FBRyxTQUFsQkEsZUFBa0IsR0FBWTtBQUM5QixRQUFJQyxTQUFTLEdBQUdILFVBQVUsQ0FBQ0csU0FBM0I7QUFDQSxRQUFJQyxNQUFNLEdBQUdKLFVBQVUsQ0FBQ0ksTUFBeEI7QUFFQSxRQUFJQyxhQUFhLEdBQUdDLENBQUMsQ0FBQyxTQUFELENBQUQsQ0FBYUMsS0FBYixDQUFtQixNQUFuQixFQUEyQjtBQUMzQ0MsWUFBTSxFQUFFLEVBRG1DO0FBRTNDQyxXQUFLLEVBQUUsTUFGb0M7QUFHM0NDLFVBQUksRUFBRVAsU0FIcUM7QUFJM0NRLFlBQU0sRUFBRTtBQUptQyxLQUEzQixDQUFwQjtBQU9BQyxlQUFXLENBQUMsWUFBWTtBQUNwQixVQUFJQyxNQUFNLEdBQUdDLElBQUksQ0FBQ0MsS0FBTCxDQUFXRCxJQUFJLENBQUNELE1BQUwsS0FBZ0IsRUFBM0IsQ0FBYjtBQUNBLFVBQUlHLE1BQU0sR0FBR1gsYUFBYSxDQUFDWSxJQUFkLEdBQXFCQyxLQUFyQixDQUEyQixHQUEzQixDQUFiO0FBQ0FGLFlBQU0sQ0FBQ0csS0FBUDtBQUNBSCxZQUFNLENBQUNJLElBQVAsQ0FBWVAsTUFBWjtBQUVBUixtQkFBYSxDQUNSWSxJQURMLENBQ1VELE1BQU0sQ0FBQ0ssSUFBUCxDQUFZLEdBQVosQ0FEVixFQUVLQyxNQUZMO0FBR0gsS0FUVSxFQVNSLElBVFEsQ0FBWDtBQVdBaEIsS0FBQyxDQUFDLFNBQUQsQ0FBRCxDQUFhQyxLQUFiLENBQW1CLEtBQW5CLEVBQTBCO0FBQ3RCQyxZQUFNLEVBQUUsRUFEYztBQUV0QkMsV0FBSyxFQUFFLEVBRmU7QUFHdEJDLFVBQUksRUFBRSxjQUFVYSxDQUFWLEVBQWFDLENBQWIsRUFBZ0JDLEdBQWhCLEVBQXFCO0FBQ3ZCLFlBQUlDLENBQUMsR0FBR0MsUUFBUSxDQUFFSCxDQUFDLEdBQUdDLEdBQUcsQ0FBQ0csTUFBVCxHQUFtQixHQUFwQixDQUFoQjtBQUNBLGVBQU8sY0FBY0YsQ0FBZCxHQUFrQixNQUF6QjtBQUNIO0FBTnFCLEtBQTFCO0FBUUgsR0E5QkQ7O0FBZ0NBLFNBQU87QUFDSEcsUUFBSSxFQUFFLGdCQUFZO0FBQ2QzQixxQkFBZTtBQUNsQjtBQUhFLEdBQVA7QUFLSCxDQXZDYSxFQUFkOztBQXlDQUksQ0FBQyxDQUFDLFlBQVk7QUFDVkwsU0FBTyxDQUFDNEIsSUFBUjtBQUNILENBRkEsQ0FBRCIsImZpbGUiOiIuL3NyYy9hc3NldHMvc2NyaXB0cy9wYWdlcy91aV9jYXJkLmpzLmpzIiwic291cmNlc0NvbnRlbnQiOlsicmVxdWlyZSgncGVpdHknKTtcbmNvbnN0IHRoZW1lQ29sb3IgPSByZXF1aXJlKCcuLi9jb2xvcnMnKTtcblxubGV0IFVJX2NhcmQgPSBmdW5jdGlvbiAoKSB7XG5cbiAgICB2YXIgaW5pdFBlaXR5Q2hhcnRzID0gZnVuY3Rpb24gKCkge1xuICAgICAgICB2YXIgYnViYmxlZ3VtID0gdGhlbWVDb2xvci5idWJibGVndW07XG4gICAgICAgIHZhciBkYW5nZXIgPSB0aGVtZUNvbG9yLmRhbmdlcjtcblxuICAgICAgICB2YXIgdXBkYXRpbmdDaGFydCA9ICQoJy5jaGFydDEnKS5wZWl0eSgnbGluZScsIHtcbiAgICAgICAgICAgIGhlaWdodDogNjAsXG4gICAgICAgICAgICB3aWR0aDogJzEwMCUnLFxuICAgICAgICAgICAgZmlsbDogYnViYmxlZ3VtLFxuICAgICAgICAgICAgc3Ryb2tlOiBudWxsXG4gICAgICAgIH0pO1xuXG4gICAgICAgIHNldEludGVydmFsKGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgIHZhciByYW5kb20gPSBNYXRoLnJvdW5kKE1hdGgucmFuZG9tKCkgKiAxMClcbiAgICAgICAgICAgIHZhciB2YWx1ZXMgPSB1cGRhdGluZ0NoYXJ0LnRleHQoKS5zcGxpdChcIixcIilcbiAgICAgICAgICAgIHZhbHVlcy5zaGlmdCgpXG4gICAgICAgICAgICB2YWx1ZXMucHVzaChyYW5kb20pXG5cbiAgICAgICAgICAgIHVwZGF0aW5nQ2hhcnRcbiAgICAgICAgICAgICAgICAudGV4dCh2YWx1ZXMuam9pbihcIixcIikpXG4gICAgICAgICAgICAgICAgLmNoYW5nZSgpXG4gICAgICAgIH0sIDEwMDApO1xuXG4gICAgICAgICQoJy5jaGFydDInKS5wZWl0eSgnYmFyJywge1xuICAgICAgICAgICAgaGVpZ2h0OiAzNCxcbiAgICAgICAgICAgIHdpZHRoOiA2MCxcbiAgICAgICAgICAgIGZpbGw6IGZ1bmN0aW9uIChfLCBpLCBhbGwpIHtcbiAgICAgICAgICAgICAgICB2YXIgZyA9IHBhcnNlSW50KChpIC8gYWxsLmxlbmd0aCkgKiAyNTUpXG4gICAgICAgICAgICAgICAgcmV0dXJuIFwicmdiKDI1NSwgXCIgKyBnICsgXCIsIDApXCJcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG4gICAgfVxuXG4gICAgcmV0dXJuIHtcbiAgICAgICAgaW5pdDogZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgaW5pdFBlaXR5Q2hhcnRzKCk7XG4gICAgICAgIH1cbiAgICB9O1xufSgpO1xuXG4kKGZ1bmN0aW9uICgpIHtcbiAgICBVSV9jYXJkLmluaXQoKTtcbn0pOyJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./src/assets/scripts/pages/ui_card.js\n");

/***/ }),

/***/ 1:
/*!***************************************************!*\
  !*** multi ./src/assets/scripts/pages/ui_card.js ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/simonnguyen/GIT/siqtheme/src/assets/scripts/pages/ui_card.js */"./src/assets/scripts/pages/ui_card.js");


/***/ })

/******/ });