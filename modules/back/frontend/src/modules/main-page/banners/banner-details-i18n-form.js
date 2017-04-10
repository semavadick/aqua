"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var i18n_form_1 = require("../../../common/i18n-form");
var BannerDetailsI18nForm = (function (_super) {
    __extends(BannerDetailsI18nForm, _super);
    function BannerDetailsI18nForm() {
        _super.apply(this, arguments);
        this.text = '';
        this.link = '';
    }
    BannerDetailsI18nForm.prototype.reset = function () {
        this.text = '';
        this.link = '';
    };
    BannerDetailsI18nForm.prototype.populate = function (data) {
        Object.assign(this, data);
    };
    BannerDetailsI18nForm.prototype.getData = function () {
        return {
            text: this.text,
            link: this.link,
        };
    };
    return BannerDetailsI18nForm;
}(i18n_form_1.I18nForm));
exports.BannerDetailsI18nForm = BannerDetailsI18nForm;
//# sourceMappingURL=banner-details-i18n-form.js.map