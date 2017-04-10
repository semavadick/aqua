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
var MyThumbComponent = (function () {
    function MyThumbComponent() {
        this.grayBg = false;
        this.deleteMessage = "Вы действительно хотите удалить данный элемент?";
        this.onUpdate = new core_1.EventEmitter();
        this.onDelete = new core_1.EventEmitter();
    }
    MyThumbComponent.prototype.deleteItem = function () {
        if (confirm(this.deleteMessage)) {
            this.onDelete.emit(null);
        }
    };
    __decorate([
        core_1.Input(), 
        __metadata('design:type', String)
    ], MyThumbComponent.prototype, "content", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', String)
    ], MyThumbComponent.prototype, "imageUrl", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', Boolean)
    ], MyThumbComponent.prototype, "grayBg", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', String)
    ], MyThumbComponent.prototype, "deleteMessage", void 0);
    __decorate([
        core_1.Output(), 
        __metadata('design:type', (typeof (_a = typeof core_1.EventEmitter !== 'undefined' && core_1.EventEmitter) === 'function' && _a) || Object)
    ], MyThumbComponent.prototype, "onUpdate", void 0);
    __decorate([
        core_1.Output(), 
        __metadata('design:type', (typeof (_b = typeof core_1.EventEmitter !== 'undefined' && core_1.EventEmitter) === 'function' && _b) || Object)
    ], MyThumbComponent.prototype, "onDelete", void 0);
    MyThumbComponent = __decorate([
        core_1.Component({
            selector: 'my-thumb',
            template: "\n        <div class=\"thumbnail\" style=\"margin-bottom: 0;\" [class.bg-grey-300]=\"grayBg\">\n            <div class=\"thumb\">\n                <img *ngIf=\"imageUrl\" src=\"{{ imageUrl }}\">\n\n                <div *ngIf=\"content\" [innerHTML]=\"content\" class=\"caption\"></div>\n\n                <div class=\"caption-overflow\">\n                    <span>\n                        <button (click)=\"onUpdate.emit(null)\" title=\"\u0420\u0435\u0434\u0430\u043A\u0442\u0438\u0440\u043E\u0432\u0430\u0442\u044C\" type=\"button\" class=\"btn bg-info-600 btn-icon\">\n                            <i class=\"icon-pen\"></i>\n                        </button>\n                        <button (click)=\"deleteItem()\" title=\"\u0423\u0434\u0430\u043B\u0438\u0442\u044C\" type=\"button\" class=\"btn bg-warning-700 btn-icon\" style=\"margin-left: 10px;\">\n                            <i class=\"icon-trash\"></i>\n                        </button>\n                    </span>\n                </div>\n            </div>\n        </div>\n    ",
        }), 
        __metadata('design:paramtypes', [])
    ], MyThumbComponent);
    return MyThumbComponent;
    var _a, _b;
}());
exports.MyThumbComponent = MyThumbComponent;
//# sourceMappingURL=my-thumb.component.js.map