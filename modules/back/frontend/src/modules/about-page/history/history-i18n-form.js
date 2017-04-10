"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var i18n_form_1 = require("../../../common/i18n-form");
var my_cropper_image_1 = require("../../../common/my-cropper/my-cropper-image");
var HistoryI18nForm = (function (_super) {
    __extends(HistoryI18nForm, _super);
    function HistoryI18nForm() {
        _super.apply(this, arguments);
        this.image = new my_cropper_image_1.MyCropperImage();
        this.saveI18n = true;
    }
    HistoryI18nForm.prototype.reset = function () {
        this.image.reset();
    };
    HistoryI18nForm.prototype.populate = function (data) {
        this.image.currentImageUrl = data['imageUrl'];
    };
    HistoryI18nForm.prototype.getData = function () {
        return {
            image: this.image.croppedImage,
        };
    };
    return HistoryI18nForm;
}(i18n_form_1.I18nForm));
exports.HistoryI18nForm = HistoryI18nForm;
//# sourceMappingURL=history-i18n-form.js.map