"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var form_1 = require("./form");
/**
 * Базовый класс для форм для редактирования сущности
 */
var EntityForm = (function (_super) {
    __extends(EntityForm, _super);
    function EntityForm() {
        _super.apply(this, arguments);
        this.isLoading = false;
        this.i18ns = null;
    }
    EntityForm.prototype.getI18ns = function () {
        if (this.i18ns === null) {
            this.i18ns = [];
            var i18nClass = this.getI18nFormClass();
            if (!i18nClass) {
                return [];
            }
            for (var _i = 0, _a = this.getLanguagesManager().getLanguages(); _i < _a.length; _i++) {
                var language = _a[_i];
                var i18n = new i18nClass(language);
                this.i18ns.push(i18n);
            }
        }
        return this.i18ns;
    };
    EntityForm.prototype.initLocally = function () {
        var _this = this;
        return new Promise(function (resolve) {
            _this.reset();
            _this.clearErrors();
            for (var _i = 0, _a = _this.getI18ns(); _i < _a.length; _i++) {
                var i18n = _a[_i];
                i18n.reset();
                i18n.clearErrors();
                i18n.saveI18n = false;
            }
            resolve('ok');
        });
    };
    EntityForm.prototype.initFromUrl = function (url) {
        var _this = this;
        return new Promise(function (resolve, reject) {
            _this.isLoading = true;
            _this.reset();
            _this.clearErrors();
            for (var _i = 0, _a = _this.getI18ns(); _i < _a.length; _i++) {
                var i18n = _a[_i];
                i18n.reset();
                i18n.clearErrors();
                i18n.saveI18n = false;
            }
            _this.getBackend().get(url)
                .then(function (resp) {
                var data = resp.json();
                _this.populate(data);
                for (var _i = 0, _a = _this.getI18ns(); _i < _a.length; _i++) {
                    var i18n = _a[_i];
                    for (var _b = 0, _c = data['i18ns']; _b < _c.length; _b++) {
                        var i18nData = _c[_b];
                        if (i18nData['languageId'] == i18n.language.id) {
                            i18n.saveI18n = i18nData['saveI18n'];
                            i18n.populate(i18nData);
                        }
                    }
                }
                _this.isLoading = false;
                resolve('ok');
            })
                .catch(function (resp) {
                _this.isLoading = false;
                reject(resp.text());
            });
        });
    };
    EntityForm.prototype.saveViaUrl = function (url, isNewEntity) {
        var _this = this;
        if (isNewEntity === void 0) { isNewEntity = true; }
        this.isLoading = true;
        return new Promise(function (resolve, reject) {
            var data = _this.getData();
            var i18nsData = [];
            var i18ns = _this.getI18ns();
            for (var _i = 0, i18ns_1 = i18ns; _i < i18ns_1.length; _i++) {
                var i18n = i18ns_1[_i];
                var i18nData = i18n.getData();
                i18nData['languageId'] = i18n.language.id;
                i18nData['saveI18n'] = i18n.saveI18n;
                i18nsData.push(i18nData);
            }
            data['i18ns'] = i18nsData;
            var reqThen = function () {
                _this.isLoading = false;
                resolve('ok');
            };
            var reqCatch = function (resp) {
                try {
                    var data = resp.json();
                }
                catch (e) {
                    _this.isLoading = false;
                    reject('Произошла ошибка: ' + resp.statusText);
                    return;
                }
                _this.setErrors(data);
                for (var _i = 0, _a = data['i18ns']; _i < _a.length; _i++) {
                    var i18nErrors = _a[_i];
                    for (var _b = 0, i18ns_2 = i18ns; _b < i18ns_2.length; _b++) {
                        var i18n = i18ns_2[_b];
                        if (i18n.language.id == i18nErrors['languageId']) {
                            var errors = Object.assign({}, i18nErrors);
                            delete errors['languageId'];
                            i18n.setErrors(errors);
                        }
                    }
                }
                _this.isLoading = false;
                reject(null);
            };
            _this.clearErrors();
            for (var _a = 0, i18ns_3 = i18ns; _a < i18ns_3.length; _a++) {
                var i18n = i18ns_3[_a];
                i18n.clearErrors();
            }
            if (isNewEntity) {
                _this.getBackend().post(url, data)
                    .then(reqThen)
                    .catch(reqCatch);
            }
            else {
                _this.getBackend().put(url, data)
                    .then(reqThen)
                    .catch(reqCatch);
            }
        });
    };
    EntityForm.prototype.hasI18nGeneralError = function () {
        return this.errors.hasOwnProperty('i18nsGeneral');
    };
    EntityForm.prototype.getI18nGeneralError = function () {
        if (!this.hasI18nGeneralError()) {
            return null;
        }
        return this.errors['i18nsGeneral'][0];
    };
    return EntityForm;
}(form_1.Form));
exports.EntityForm = EntityForm;
//# sourceMappingURL=entity-form.js.map