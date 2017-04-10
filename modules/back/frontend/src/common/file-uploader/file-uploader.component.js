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
var file_uploader_model_1 = require("./file-uploader-model");
var FileUploaderComponent = (function () {
    function FileUploaderComponent(eRef) {
        this.eRef = eRef;
        this.deleteAllowed = false;
    }
    FileUploaderComponent.prototype.deleteFile = function () {
        this.file.reset();
        this.file.isDeleted = true;
    };
    FileUploaderComponent.prototype.chooseFile = function ($event) {
        $event.target.parentElement.querySelector('input[type=file]').click();
    };
    FileUploaderComponent.prototype.fileChangeListener = function ($event) {
        var _this = this;
        var file = $event.target.files[0];
        $event.target.value = '';
        if (!file) {
            return;
        }
        var myReader = new FileReader();
        myReader.onloadend = function (loadEvent) {
            var dataUrl = loadEvent.target.result;
            _this.file.uploadedFileUrl = dataUrl;
            _this.file.uploadedFileName = file.name;
        };
        myReader.readAsDataURL(file);
    };
    __decorate([
        core_1.Input(), 
        __metadata('design:type', Boolean)
    ], FileUploaderComponent.prototype, "deleteAllowed", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', file_uploader_model_1.FileUploaderModel)
    ], FileUploaderComponent.prototype, "file", void 0);
    FileUploaderComponent = __decorate([
        core_1.Component({
            selector: 'file-uploader',
            templateUrl: './file-uploader.html',
            encapsulation: core_1.ViewEncapsulation.None
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof core_1.ElementRef !== 'undefined' && core_1.ElementRef) === 'function' && _a) || Object])
    ], FileUploaderComponent);
    return FileUploaderComponent;
    var _a;
}());
exports.FileUploaderComponent = FileUploaderComponent;
//# sourceMappingURL=file-uploader.component.js.map