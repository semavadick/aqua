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
var backend_service_1 = require("../../../services/backend.service");
var crud_grid_entity_manager_1 = require("../../../common/crud-grid/crud-grid-entity-manager");
var BannersManager = (function (_super) {
    __extends(BannersManager, _super);
    function BannersManager(backend) {
        _super.call(this);
        this.backend = backend;
    }
    BannersManager.prototype.getBackend = function () {
        return this.backend;
    };
    BannersManager.prototype.getBackendUrl = function () {
        return 'main-page/banners';
    };
    BannersManager = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [backend_service_1.BackendService])
    ], BannersManager);
    return BannersManager;
}(crud_grid_entity_manager_1.CrudGridEntityManager));
exports.BannersManager = BannersManager;
//# sourceMappingURL=banners-manager.js.map