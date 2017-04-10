"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var service_i18n_form_1 = require("../service/service-i18n-form");
var MaintenanceI18nForm = (function (_super) {
    __extends(MaintenanceI18nForm, _super);
    function MaintenanceI18nForm() {
        _super.apply(this, arguments);
    }
    MaintenanceI18nForm.prototype.hasAdditDescription = function () {
        return false;
    };
    return MaintenanceI18nForm;
}(service_i18n_form_1.ServiceI18nForm));
exports.MaintenanceI18nForm = MaintenanceI18nForm;
//# sourceMappingURL=maintenance-i18n-form.js.map