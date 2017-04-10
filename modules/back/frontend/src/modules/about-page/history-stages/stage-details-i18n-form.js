"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var i18n_form_1 = require("../../../common/i18n-form");
var StageDetailsI18nForm = (function (_super) {
    __extends(StageDetailsI18nForm, _super);
    function StageDetailsI18nForm() {
        _super.apply(this, arguments);
        this.text = '';
    }
    StageDetailsI18nForm.prototype.reset = function () {
        this.text = '';
    };
    StageDetailsI18nForm.prototype.populate = function (data) {
        Object.assign(this, data);
    };
    StageDetailsI18nForm.prototype.getData = function () {
        return {
            text: this.text,
        };
    };
    return StageDetailsI18nForm;
}(i18n_form_1.I18nForm));
exports.StageDetailsI18nForm = StageDetailsI18nForm;
//# sourceMappingURL=stage-details-i18n-form.js.map