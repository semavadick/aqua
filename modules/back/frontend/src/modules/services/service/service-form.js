"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var form_panel_form_1 = require("../../../common/form-panel/form-panel-form");
var my_cropper_image_1 = require("../../../common/my-cropper/my-cropper-image");
var advantage_form_1 = require("./advantage-form");
var ServiceForm = (function (_super) {
    __extends(ServiceForm, _super);
    function ServiceForm() {
        _super.apply(this, arguments);
        this.bg = new my_cropper_image_1.MyCropperImage();
        this.advantages = [];
    }
    ServiceForm.prototype.reset = function () {
        this.bg.reset();
        this.advantages = [];
    };
    ServiceForm.prototype.populate = function (data) {
        this.bg.currentImageUrl = data['bgUrl'];
        for (var _i = 0, _a = data['advantages']; _i < _a.length; _i++) {
            var advData = _a[_i];
            var advantage = new advantage_form_1.AdvantageForm(this.getLanguagesManager());
            advantage.populate(advData);
            this.advantages.push(advantage);
        }
    };
    ServiceForm.prototype.getData = function () {
        var advsData = [];
        for (var _i = 0, _a = this.advantages; _i < _a.length; _i++) {
            var advantage = _a[_i];
            advsData.push(advantage.getData());
        }
        return {
            bg: this.bg.croppedImage,
            advantages: advsData,
        };
    };
    ServiceForm.prototype.setErrors = function (errors) {
        _super.prototype.setErrors.call(this, errors);
        var i = 0;
        for (var _i = 0, _a = errors['advantages']; _i < _a.length; _i++) {
            var advErrors = _a[_i];
            this.advantages[i].setErrors(advErrors);
            i++;
        }
    };
    return ServiceForm;
}(form_panel_form_1.FormPanelForm));
exports.ServiceForm = ServiceForm;
//# sourceMappingURL=service-form.js.map