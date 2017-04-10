"use strict";
var core_1 = require('@angular/core');
var FileUploaderModel = (function () {
    function FileUploaderModel() {
        this.currentFileUrl = null;
        this.uploadedFileUrl = null;
        this.uploadedFileName = null;
        this.isDeleted = false;
        this.onReset = new core_1.EventEmitter();
    }
    FileUploaderModel.prototype.reset = function () {
        this.currentFileUrl = null;
        this.uploadedFileUrl = null;
        this.uploadedFileName = null;
        this.isDeleted = false;
        this.onReset.emit(null);
    };
    FileUploaderModel.prototype.getName = function () {
        if (this.uploadedFileName) {
            return this.uploadedFileName;
        }
        return this.currentFileUrl;
    };
    return FileUploaderModel;
}());
exports.FileUploaderModel = FileUploaderModel;
//# sourceMappingURL=file-uploader-model.js.map