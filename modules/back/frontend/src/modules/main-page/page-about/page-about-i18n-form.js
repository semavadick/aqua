"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var i18n_form_1 = require("../../../common/i18n-form");
var PageAboutI18nForm = (function (_super) {
    __extends(PageAboutI18nForm, _super);
    function PageAboutI18nForm() {
        _super.apply(this, arguments);
        this.title = '';
        this.text = '';
        this.video = '';
        this.saveI18n = false;
    }
    PageAboutI18nForm.prototype.reset = function () {
        this.title = '';
        this.text = '';
        this.video = '';
    };
    PageAboutI18nForm.prototype.populate = function (data) {
        Object.assign(this, data);
    };
    PageAboutI18nForm.prototype.getData = function () {
        return {
            title: this.title,
            text: this.text,
            video: this.video,
        };
    };
    return PageAboutI18nForm;
}(i18n_form_1.I18nForm));
exports.PageAboutI18nForm = PageAboutI18nForm;
//# sourceMappingURL=page-about-i18n-form.js.map