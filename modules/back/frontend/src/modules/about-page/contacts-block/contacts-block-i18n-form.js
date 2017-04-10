"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var i18n_form_1 = require("../../../common/i18n-form");
var ContactsBlockI18nForm = (function (_super) {
    __extends(ContactsBlockI18nForm, _super);
    function ContactsBlockI18nForm() {
        _super.apply(this, arguments);
        this.menuName = '';
        this.title = '';
        this.saveI18n = true;
    }
    ContactsBlockI18nForm.prototype.reset = function () {
        this.menuName = '';
        this.title = '';
    };
    ContactsBlockI18nForm.prototype.populate = function (data) {
        this.menuName = data['menuName'];
        this.title = data['title'];
    };
    ContactsBlockI18nForm.prototype.getData = function () {
        return {
            menuName: this.menuName,
            title: this.title,
        };
    };
    return ContactsBlockI18nForm;
}(i18n_form_1.I18nForm));
exports.ContactsBlockI18nForm = ContactsBlockI18nForm;
//# sourceMappingURL=contacts-block-i18n-form.js.map