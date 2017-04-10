"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
var core_1 = require("@angular/core");
var backend_service_ts_1 = require("../../../services/backend.service.ts");
var languages_manager_1 = require("../../../services/languages-manager");
var my_datatable_entity_form_1 = require("../../../common/my-datatable/my-datatable-entity-form");
var category_1 = require("./category");
var UserForm = (function (_super) {
    __extends(UserForm, _super);
    function UserForm(backend, langsManager) {
        _super.call(this);
        this.backend = backend;
        this.langsManager = langsManager;
        this.status = UserForm.STATUS_ACTIVE;
        this.statuses = [
            {
                id: UserForm.STATUS_NOT_VERIFIED,
                label: 'Не подтвержден',
            },
            {
                id: UserForm.STATUS_ACTIVE,
                label: 'Активный',
            },
            {
                id: UserForm.STATUS_BLOCKED,
                label: 'Заблокирован',
            },
        ];
        this.role = UserForm.ROLE_CLIENT;
        this.roles = [
            {
                id: UserForm.ROLE_CLIENT,
                label: 'Клиент',
            },
            {
                id: UserForm.ROLE_MANAGER,
                label: 'Менеджер',
            },
            {
                id: UserForm.ROLE_ADMIN,
                label: 'Админинстратор',
            },
        ];
        this.type = UserForm.TYPE_PERSON;
        this.types = [
            {
                id: UserForm.TYPE_PERSON,
                label: 'Физ. лицо',
            },
            {
                id: UserForm.TYPE_COMPANY,
                label: 'Компания',
            },
        ];
        this.companyType = UserForm.COMPANY_TYPE_OOO;
        this.companyTypes = [
            {
                id: UserForm.COMPANY_TYPE_ZAO,
                label: 'ЗАО',
            },
            {
                id: UserForm.COMPANY_TYPE_OOO,
                label: 'ООО',
            },
            {
                id: UserForm.COMPANY_TYPE_IP,
                label: 'ИП',
            },
        ];
        this.isNewUser = true;
        this.discountCategories = [];
        this.generatedPassword = '';
    }
    UserForm.prototype.init = function (entity) {
        var _this = this;
        if (entity === void 0) { entity = null; }
        return _super.prototype.init.call(this, entity)
            .then(function (message) {
            return _this.initDiscountCategories(entity);
        });
    };
    UserForm.prototype.initDiscountCategories = function (user) {
        var _this = this;
        this.isLoading = true;
        return new Promise(function (resolve, reject) {
            var url = 'users/discount-categories';
            if (user) {
                url += '/' + user.id;
            }
            _this.getBackend().get(url)
                .then(function (resp) {
                var data = resp.json();
                _this.discountCategories = [];
                for (var _i = 0, data_1 = data; _i < data_1.length; _i++) {
                    var categoryData = data_1[_i];
                    _this.discountCategories.push(_this.getCategoryFromData(categoryData));
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
    UserForm.prototype.getCategoryFromData = function (data) {
        var category = new category_1.Category();
        category.id = data['id'];
        category.name = data['name'];
        category.discount = data['discount'];
        category.hasDiscount = data['hasDiscount'];
        for (var _i = 0, _a = data['children']; _i < _a.length; _i++) {
            var childData = _a[_i];
            category.children.push(this.getCategoryFromData(childData));
        }
        return category;
    };
    UserForm.prototype.getBackend = function () {
        return this.backend;
    };
    UserForm.prototype.getLanguagesManager = function () {
        return this.langsManager;
    };
    UserForm.prototype.getBackendUrl = function () {
        return 'users';
    };
    UserForm.prototype.reset = function () {
        this.email = '';
        this.password = '';
        this.phone = '';
        this.fullName = '';
        this.status = UserForm.STATUS_ACTIVE;
        this.role = UserForm.ROLE_CLIENT;
        this.type = UserForm.TYPE_PERSON;
        this.companyType = UserForm.COMPANY_TYPE_OOO;
        this.companyName = '';
        this.companyINN = '';
        this.companyKPP = '';
        this.companyBank = '';
        this.companyCheckingAccount = '';
        this.companyCreditAccount = '';
        this.companyLegalAddress = '';
        this.companyActualAddress = '';
        this.companyCEO = '';
        this.generatedPassword = '';
        this.isNewUser = true;
        this.discount = null;
    };
    UserForm.prototype.populate = function (data) {
        this.isNewUser = false;
        Object.assign(this, data);
    };
    UserForm.prototype.getDiscountData = function (category) {
        var data = [];
        if (category.hasDiscount && category.discount > 0) {
            data.push({
                categoryId: category.id,
                discount: category.discount,
            });
        }
        for (var _i = 0, _a = category.children; _i < _a.length; _i++) {
            var child = _a[_i];
            data = data.concat(this.getDiscountData(child));
        }
        return data;
    };
    UserForm.prototype.getData = function () {
        var discountData = [];
        for (var _i = 0, _a = this.discountCategories; _i < _a.length; _i++) {
            var category = _a[_i];
            discountData = discountData.concat(this.getDiscountData(category));
        }
        return {
            email: this.email,
            password: this.password,
            phone: this.phone,
            fullName: this.fullName,
            status: this.status,
            role: this.role,
            type: this.type,
            companyType: this.companyType,
            companyName: this.companyName,
            companyINN: this.companyINN,
            companyKPP: this.companyKPP,
            companyBank: this.companyBank,
            companyCheckingAccount: this.companyCheckingAccount,
            companyCreditAccount: this.companyCreditAccount,
            companyLegalAddress: this.companyLegalAddress,
            companyActualAddress: this.companyActualAddress,
            companyCEO: this.companyCEO,
            discount: this.discount,
            categoriesDiscounts: discountData,
        };
    };
    UserForm.prototype.isClient = function () {
        return this.role == UserForm.ROLE_CLIENT;
    };
    UserForm.prototype.isCompany = function () {
        return this.type == UserForm.TYPE_COMPANY;
    };
    UserForm.prototype.getI18ns = function () {
        return [];
    };
    UserForm.prototype.getI18nFormClass = function () {
        return null;
    };
    UserForm.prototype.generatePassword = function () {
        function s4() {
            return Math.floor((1 + Math.random()) * 0x10000)
                .toString(16)
                .substring(1);
        }
        this.generatedPassword = s4() + s4();
        this.password = this.generatedPassword;
    };
    UserForm.STATUS_NOT_VERIFIED = 1;
    UserForm.STATUS_ACTIVE = 2;
    UserForm.STATUS_BLOCKED = 3;
    UserForm.ROLE_CLIENT = 1;
    UserForm.ROLE_MANAGER = 2;
    UserForm.ROLE_ADMIN = 3;
    UserForm.TYPE_PERSON = 0;
    UserForm.TYPE_COMPANY = 1;
    UserForm.COMPANY_TYPE_ZAO = 0;
    UserForm.COMPANY_TYPE_OOO = 1;
    UserForm.COMPANY_TYPE_IP = 2;
    UserForm = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [(typeof (_a = typeof backend_service_ts_1.BackendService !== 'undefined' && backend_service_ts_1.BackendService) === 'function' && _a) || Object, languages_manager_1.LanguagesManager])
    ], UserForm);
    return UserForm;
    var _a;
}(my_datatable_entity_form_1.MyDatatableEntityForm));
exports.UserForm = UserForm;
//# sourceMappingURL=user-form.js.map