"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var entity_form_1 = require("../../../../common/entity-form");
var attribute_i18n_form_1 = require("./attribute-i18n-form");
var AttributeForm = (function (_super) {
    __extends(AttributeForm, _super);
    function AttributeForm(langsManager) {
        _super.call(this);
        this.langsManager = langsManager;
        this.id = null;
    }
    AttributeForm.prototype.getBackend = function () {
        return null;
    };
    AttributeForm.prototype.getLanguagesManager = function () {
        return this.langsManager;
    };
    AttributeForm.prototype.getI18nFormClass = function () {
        return attribute_i18n_form_1.AttributeI18nForm;
    };
    AttributeForm.prototype.reset = function () {
        this.id = null;
        for (var _i = 0, _a = this.getI18ns(); _i < _a.length; _i++) {
            var i18n = _a[_i];
            i18n.reset();
        }
    };
    AttributeForm.prototype.populate = function (data) {
        this.id = data['id'];
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
    AttributeForm.prototype.getData = function () {
        var i18nsData = [];
        for (var _i = 0, _a = this.getI18ns(); _i < _a.length; _i++) {
            var i18n = _a[_i];
            var i18nData = i18n.getData();
            i18nData['languageId'] = i18n.language.id;
            i18nsData.push(i18nData);
        }
        return {
            id: this.id,
            i18ns: i18nsData,
        };
    };
    return AttributeForm;
}(entity_form_1.EntityForm));
exports.AttributeForm = AttributeForm;
//# sourceMappingURL=attribute-form.js.map