"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var service_i18n_form_1 = require("../service/service-i18n-form");
var ExclusiveI18nForm = (function (_super) {
    __extends(ExclusiveI18nForm, _super);
    function ExclusiveI18nForm() {
        _super.apply(this, arguments);
    }
    ExclusiveI18nForm.prototype.hasAdditDescription = function () {
        return true;
    };
    return ExclusiveI18nForm;
}(service_i18n_form_1.ServiceI18nForm));
exports.ExclusiveI18nForm = ExclusiveI18nForm;
//# sourceMappingURL=exclusive-i18n-form.js.map