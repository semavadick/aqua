"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var my_cropper_image_1 = require("../../../common/my-cropper/my-cropper-image");
var entity_form_1 = require("../../../common/entity-form");
var advantage_18n_form_1 = require("./advantage-18n-form");
var AdvantageForm = (function (_super) {
    __extends(AdvantageForm, _super);
    function AdvantageForm(langsManager) {
        _super.call(this);
        this.langsManager = langsManager;
        this.id = null;
        this.icon = new my_cropper_image_1.MyCropperImage();
    }
    AdvantageForm.prototype.getBackend = function () {
        return undefined;
    };
    AdvantageForm.prototype.getLanguagesManager = function () {
        return this.langsManager;
    };
    AdvantageForm.prototype.reset = function () {
        this.id = null;
        this.icon.reset();
        for (var _i = 0, _a = this.getI18ns(); _i < _a.length; _i++) {
            var i18n = _a[_i];
            i18n.reset();
        }
    };
    AdvantageForm.prototype.populate = function (data) {
        this.id = data['id'];
        this.icon.currentImageUrl = data['iconUrl'];
        for (var _i = 0, _a = data['i18ns']; _i < _a.length; _i++) {
            var i18nData = _a[_i];
            var languageId = i18nData['languageId'];
            for (var _b = 0, _c = this.getI18ns(); _b < _c.length; _b++) {
                var i18n = _c[_b];
                if (i18n.language.id == languageId) {
                    i18n.populate(i18nData);
                    break;
                }
            }
        }
    };
    AdvantageForm.prototype.getData = function () {
        var i18nsData = [];
        for (var _i = 0, _a = this.getI18ns(); _i < _a.length; _i++) {
            var i18n = _a[_i];
            var i18nData = i18n.getData();
            i18nData['saveI18n'] = i18n.saveI18n;
            i18nData['languageId'] = i18n.language.id;
            i18nsData.push(i18nData);
        }
        return {
            id: this.id,
            icon: this.icon.croppedImage,
            i18ns: i18nsData,
        };
    };
    AdvantageForm.prototype.getI18nFormClass = function () {
        return advantage_18n_form_1.AdvantageI18nForm;
    };
    return AdvantageForm;
}(entity_form_1.EntityForm));
exports.AdvantageForm = AdvantageForm;
//# sourceMappingURL=advantage-form.js.map