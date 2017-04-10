"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var form_panel_form_1 = require("../../../common/form-panel/form-panel-form");
var my_cropper_image_1 = require("../../../common/my-cropper/my-cropper-image");
var ServiceForm = (function (_super) {
    __extends(ServiceForm, _super);
    function ServiceForm() {
        _super.apply(this, arguments);
        this.icon = new my_cropper_image_1.MyCropperImage();
        this.image = new my_cropper_image_1.MyCropperImage();
    }
    ServiceForm.prototype.reset = function () {
        this.icon.reset();
        this.image.reset();
    };
    ServiceForm.prototype.populate = function (data) {
        this.icon.currentImageUrl = data['iconUrl'];
        this.image.currentImageUrl = data['imageUrl'];
    };
    ServiceForm.prototype.getData = function () {
        return {
            icon: this.icon.croppedImage,
            image: this.image.croppedImage,
        };
    };
    return ServiceForm;
}(form_panel_form_1.FormPanelForm));
exports.ServiceForm = ServiceForm;
//# sourceMappingURL=service-form.js.map