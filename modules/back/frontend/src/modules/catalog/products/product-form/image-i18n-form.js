"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var i18n_form_1 = require("../../../../common/i18n-form");
var ImageI18nForm = (function (_super) {
    __extends(ImageI18nForm, _super);
    function ImageI18nForm() {
        _super.apply(this, arguments);
        this.name = '';
        this.saveI18n = true;
    }
    ImageI18nForm.prototype.reset = function () {
        this.name = '';
    };
    ImageI18nForm.prototype.populate = function (data) {
        this.name = data['name'];
    };
    ImageI18nForm.prototype.getData = function () {
        return {
            name: this.name,
        };
    };
    return ImageI18nForm;
}(i18n_form_1.I18nForm));
exports.ImageI18nForm = ImageI18nForm;
//# sourceMappingURL=image-i18n-form.js.map