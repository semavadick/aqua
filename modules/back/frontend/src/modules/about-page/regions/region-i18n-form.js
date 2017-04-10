"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var i18n_form_1 = require("../../../common/i18n-form");
var RegionI18nForm = (function (_super) {
    __extends(RegionI18nForm, _super);
    function RegionI18nForm() {
        _super.apply(this, arguments);
        this.name = '';
    }
    RegionI18nForm.prototype.reset = function () {
        this.name = '';
    };
    RegionI18nForm.prototype.populate = function (data) {
        Object.assign(this, data);
    };
    RegionI18nForm.prototype.getData = function () {
        return {
            name: this.name,
        };
    };
    return RegionI18nForm;
}(i18n_form_1.I18nForm));
exports.RegionI18nForm = RegionI18nForm;
//# sourceMappingURL=region-i18n-form.js.map