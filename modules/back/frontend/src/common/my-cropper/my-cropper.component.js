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
var my_cropper_image_1 = require("./my-cropper-image");
var MyCropperComponent = (function () {
    function MyCropperComponent(eRef) {
        this.eRef = eRef;
        this.showCropper = false;
        this.aspectRatio = null;
        this.grayBg = false;
        this.disableCrop = false;
        this.format = 'jpeg';
    }
    MyCropperComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.image.reseted.subscribe(function () {
            _this.showCropper = false;
        });
        this.image.uploadedImageSet.subscribe(function (dataUrl) {
            _this.format = _this.getImageFormat(dataUrl);
            if (_this.disableCrop) {
                _this.image.croppedImage = _this.image.uploadedImage;
                _this.image.currentImageUrl = _this.image.croppedImage;
                return;
            }
            _this.showCropper = true;
            setTimeout(function () {
                if (!_this.cropper) {
                    _this.initCropper(dataUrl);
                }
                else {
                    _this.cropper.replace(dataUrl);
                }
            }, 100);
        });
    };
    MyCropperComponent.prototype.chooseFile = function ($event) {
        $event.target.parentElement.querySelector('.image-cropper__file').click();
    };
    MyCropperComponent.prototype.initCropper = function (imageSrc) {
        var _this = this;
        var image = this.eRef.nativeElement.querySelector('.cropper-cont img');
        image.onload = function () {
            if (_this.cropper) {
                return;
            }
            var onCrop = function () {
                _this.image.croppedImage = _this.cropper.getCroppedCanvas().toDataURL('image/' + _this.format);
            };
            _this.cropper = new Cropper(image, {
                aspectRatio: _this.aspectRatio ? _this.aspectRatio : NaN,
                viewMode: 1,
                zoomable: false,
                built: onCrop,
                cropend: onCrop,
                autoCropArea: 1,
            });
        };
        image.setAttribute('src', imageSrc);
    };
    MyCropperComponent.prototype.fileChangeListener = function ($event) {
        var _this = this;
        var file = $event.target.files[0];
        $event.target.value = '';
        if (!file) {
            return;
        }
        var myReader = new FileReader();
        myReader.onloadend = function (loadEvent) {
            _this.image.uploadedImage = loadEvent.target.result;
        };
        myReader.readAsDataURL(file);
    };
    MyCropperComponent.prototype.getImageFormat = function (dataUrl) {
        var start = dataUrl.indexOf('/') + 1;
        var length = dataUrl.indexOf(';') - start;
        var format = dataUrl.substr(start, length);
        if (!format.length) {
            return 'jpeg';
        }
        return format;
    };
    __decorate([
        core_1.Input(), 
        __metadata('design:type', my_cropper_image_1.MyCropperImage)
    ], MyCropperComponent.prototype, "image", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', Number)
    ], MyCropperComponent.prototype, "aspectRatio", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', Boolean)
    ], MyCropperComponent.prototype, "grayBg", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', Boolean)
    ], MyCropperComponent.prototype, "disableCrop", void 0);
    MyCropperComponent = __decorate([
        core_1.Component({
            selector: 'my-cropper',
            templateUrl: './my-cropper.html',
            encapsulation: core_1.ViewEncapsulation.None
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof core_1.ElementRef !== 'undefined' && core_1.ElementRef) === 'function' && _a) || Object])
    ], MyCropperComponent);
    return MyCropperComponent;
    var _a;
}());
exports.MyCropperComponent = MyCropperComponent;
//# sourceMappingURL=my-cropper.component.js.map