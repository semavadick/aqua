"use strict";
require('core-js/es6/symbol');
require('core-js/es6/object');
require('core-js/es6/function');
require('core-js/es6/parse-int');
require('core-js/es6/parse-float');
require('core-js/es6/number');
require('core-js/es6/math');
require('core-js/es6/string');
require('core-js/es6/date');
require('core-js/es6/array');
require('core-js/es6/regexp');
require('core-js/es6/map');
require('core-js/es6/set');
require('core-js/es6/weak-map');
require('core-js/es6/weak-set');
require('core-js/es6/typed');
require('core-js/es6/reflect');
// see issue https://github.com/AngularClass/angular2-webpack-starter/issues/709
// import 'core-js/es6/promise';
require('core-js/es7/reflect');
require('zone.js/dist/zone');
Error['stackTraceLimit'] = Infinity;
require('zone.js/dist/long-stack-trace-zone');
// Typescript emit helpers polyfill
require('ts-helpers');
//# sourceMappingURL=polyfills.js.map