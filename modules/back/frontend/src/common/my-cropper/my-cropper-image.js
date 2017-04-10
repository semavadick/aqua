"use strict";
var core_1 = require('@angular/core');
var MyCropperImage = (function () {
    function MyCropperImage() {
        this.currentImageUrl = null;
        this.croppedImage = null;
        this._uploadedImage = null;
        this.reseted = new core_1.EventEmitter();
        this.uploadedImageSet = new core_1.EventEmitter();
    }
    Object.defineProperty(MyCropperImage.prototype, "uploadedImage", {
        get: function () {
            return this._uploadedImage;
        },
        set: function (value) {
            this._uploadedImage = value;
            if (value) {
                this.uploadedImageSet.emit(value);
            }
        },
        enumerable: true,
        configurable: true
    });
    MyCropperImage.prototype.reset = function () {
        this.currentImageUrl = null;
        this.croppedImage = null;
        this._uploadedImage = null;
        this.reseted.emit(null);
    };
    return MyCropperImage;
}());
exports.MyCropperImage = MyCropperImage;
//# sourceMappingURL=my-cropper-image.js.map