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
var core_1 = require('@angular/core');
var crud_grid_entity_form_1 = require("../../../common/crud-grid/crud-grid-entity-form");
var backend_service_1 = require("../../../services/backend.service");
var languages_manager_1 = require("../../../services/languages-manager");
var office_i18n_form_1 = require("./office-i18n-form");
var offices_manager_1 = require("./offices-manager");
var OfficeForm = (function (_super) {
    __extends(OfficeForm, _super);
    function OfficeForm(backend, langsManager, officesManager) {
        _super.call(this);
        this.backend = backend;
        this.langsManager = langsManager;
        this.officesManager = officesManager;
        this.regionId = null;
        this.phone = '';
        this.coordsLat = 0.0;
        this.coordsLng = 0.0;
    }
    OfficeForm.prototype.init = function (entity) {
        var _this = this;
        if (entity === void 0) { entity = null; }
        return new Promise(function (resolve, reject) {
            _super.prototype.init.call(_this, entity)
                .then(function (message) {
                _this.officesManager.loadRegions()
                    .then(function () {
                    if (!_this.regionId) {
                        for (var _i = 0, _a = _this.officesManager.regions; _i < _a.length; _i++) {
                            var region = _a[_i];
                            _this.regionId = region.id;
                            break;
                        }
                    }
                    resolve(message);
                });
            })
                .catch(function (message) {
                reject(message);
            });
        });
    };
    OfficeForm.prototype.getBackend = function () {
        return this.backend;
    };
    OfficeForm.prototype.getBackendUrl = function () {
        return 'about-page/offices';
    };
    OfficeForm.prototype.getLanguagesManager = function () {
        return this.langsManager;
    };
    OfficeForm.prototype.reset = function () {
        this.regionId = null;
        this.phone = '';
        this.coordsLat = 0;
        this.coordsLng = 0;
    };
    OfficeForm.prototype.populate = function (data) {
        this.regionId = data['regionId'];
        this.phone = data['phone'];
        this.coordsLat = data['coordsLat'];
        this.coordsLng = data['coordsLng'];
    };
    OfficeForm.prototype.getData = function () {
        return {
            regionId: this.regionId,
            phone: this.phone,
            coordsLat: this.coordsLat,
            coordsLng: this.coordsLng,
        };
    };
    OfficeForm.prototype.getI18nFormClass = function () {
        return office_i18n_form_1.OfficeI18nForm;
    };
    OfficeForm = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [backend_service_1.BackendService, languages_manager_1.LanguagesManager, offices_manager_1.OfficesManager])
    ], OfficeForm);
    return OfficeForm;
}(crud_grid_entity_form_1.CrudGridEntityForm));
exports.OfficeForm = OfficeForm;
//# sourceMappingURL=office-form.js.map