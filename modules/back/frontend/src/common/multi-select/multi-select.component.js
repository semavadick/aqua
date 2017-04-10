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
var MultiSelect = (function () {
    function MultiSelect(eRef) {
        this.eRef = eRef;
        this.valueChange = new core_1.EventEmitter();
        this.items = [];
    }
    MultiSelect.prototype.setValue = function (value) {
        this.value = value;
        this.valueChange.emit(value);
    };
    MultiSelect.prototype.itemIsSelected = function (item) {
        return this.value.indexOf(item.id) >= 0;
    };
    MultiSelect.prototype.ngOnInit = function () {
        var _this = this;
        var $select = $(this.eRef.nativeElement.querySelector('select'));
        $select.select2({
            width: '700px',
        });
        $select.on('change', function () {
            var values = $select.select2('val');
            if (values === null) {
                values = [];
            }
            var actVals = [];
            for (var _i = 0, values_1 = values; _i < values_1.length; _i++) {
                var val = values_1[_i];
                actVals.push(val - 0);
            }
            _this.setValue(actVals);
        });
    };
    __decorate([
        core_1.Input(), 
        __metadata('design:type', Array)
    ], MultiSelect.prototype, "value", void 0);
    __decorate([
        core_1.Output(), 
        __metadata('design:type', (typeof (_a = typeof core_1.EventEmitter !== 'undefined' && core_1.EventEmitter) === 'function' && _a) || Object)
    ], MultiSelect.prototype, "valueChange", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', Array)
    ], MultiSelect.prototype, "items", void 0);
    MultiSelect = __decorate([
        core_1.Component({
            selector: 'multi-select',
            template: "\n        <select multiple class=\"form-control\">\n            <option\n                *ngFor=\"let item of items\"\n                [attr.value]=\"item.id\"\n                [attr.selected]=\"itemIsSelected(item) ? true : null\"\n            >\n                {{ item.name }}\n            </option>\n        </select>\n\n        <style>\n            body > .select2-container {\n                z-index: 66000;\n            }\n            .select2-container--default.select2-container--focus .select2-selection--multiple {\n                border: 1px solid #ddd;\n            }\n            .select2-container--default .select2-selection--multiple .select2-selection__choice {\n                background-color: #45adde;\n                border: 1px solid #45adde;\n                padding: 2px 5px;\n            }\n            .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {\n                color: #fff !important;\n                margin-top: 2px;\n            }\n        </style>\n            ",
            encapsulation: core_1.ViewEncapsulation.None,
        }), 
        __metadata('design:paramtypes', [(typeof (_b = typeof core_1.ElementRef !== 'undefined' && core_1.ElementRef) === 'function' && _b) || Object])
    ], MultiSelect);
    return MultiSelect;
    var _a, _b;
}());
exports.MultiSelect = MultiSelect;
//# sourceMappingURL=multi-select.component.js.map