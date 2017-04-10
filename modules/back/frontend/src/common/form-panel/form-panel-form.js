"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var entity_form_1 = require("../../common/entity-form");
var FormPanelForm = (function (_super) {
    __extends(FormPanelForm, _super);
    function FormPanelForm() {
        _super.apply(this, arguments);
    }
    FormPanelForm.prototype.init = function () {
        return this.initFromUrl(this.getBackendUrl());
    };
    FormPanelForm.prototype.save = function () {
        var _this = this;
        return this.saveViaUrl(this.getBackendUrl(), false)
            .then(function () {
            return _this.init();
        });
    };
    return FormPanelForm;
}(entity_form_1.EntityForm));
exports.FormPanelForm = FormPanelForm;
//# sourceMappingURL=form-panel-form.js.map