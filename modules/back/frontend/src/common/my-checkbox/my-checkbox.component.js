"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
var core_1 = require('@angular/core');
var MyCheckbox = (function () {
    function MyCheckbox() {
        this.value = false;
        this.valueChange = new core_1.EventEmitter();
        this.label = "";
    }
    __decorate([
        core_1.Input(), 
        __metadata('design:type', Boolean)
    ], MyCheckbox.prototype, "value", void 0);
    __decorate([
        core_1.Output(), 
        __metadata('design:type', (typeof (_a = typeof core_1.EventEmitter !== 'undefined' && core_1.EventEmitter) === 'function' && _a) || Object)
    ], MyCheckbox.prototype, "valueChange", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', String)
    ], MyCheckbox.prototype, "label", void 0);
    MyCheckbox = __decorate([
        core_1.Component({
            selector: 'my-checkbox',
            template: "\n            <div class=\"checkbox\" style=\"margin-left: 10px\">\n                <label>\n                    <div class=\"checker border-primary-600 text-primary-800\">\n                        <span [class.checked]=\"value\">\n                            <input type=\"checkbox\" class=\"control-primary\" [ngModel]=\"value\" (ngModelChange)=\"valueChange.emit($event)\">\n                        </span>\n                    </div>\n                    {{ label }}\n                </label>\n            </div>\n            "
        }), 
        __metadata('design:paramtypes', [])
    ], MyCheckbox);
    return MyCheckbox;
    var _a;
}());
exports.MyCheckbox = MyCheckbox;
//# sourceMappingURL=my-checkbox.component.js.map