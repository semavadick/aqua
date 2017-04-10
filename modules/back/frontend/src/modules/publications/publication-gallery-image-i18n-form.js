"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var i18n_form_1 = require("../../common/i18n-form");
var PublicationGalleryImageI18nForm = (function (_super) {
    __extends(PublicationGalleryImageI18nForm, _super);
    function PublicationGalleryImageI18nForm() {
        _super.apply(this, arguments);
        this.name = '';
        this.saveI18n = true;
    }
    PublicationGalleryImageI18nForm.prototype.reset = function () {
        this.name = '';
    };
    PublicationGalleryImageI18nForm.prototype.populate = function (data) {
        this.name = data['name'];
    };
    PublicationGalleryImageI18nForm.prototype.getData = function () {
        return {
            name: this.name,
        };
    };
    return PublicationGalleryImageI18nForm;
}(i18n_form_1.I18nForm));
exports.PublicationGalleryImageI18nForm = PublicationGalleryImageI18nForm;
//# sourceMappingURL=publication-gallery-image-i18n-form.js.map