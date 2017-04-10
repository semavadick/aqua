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
var ProductionBannersManager = (function (_super) {
    __extends(ProductionBannersManager, _super);
    function ProductionBannersManager(backend) {
        _super.call(this);
        this.backend = backend;
    }
    ProductionBannersManager.prototype.getBackend = function () {
        return this.backend;
    };
    ProductionBannersManager.prototype.getBackendUrl = function () {
        return 'about-page/production-banners';
    };
    ProductionBannersManager = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [backend_service_1.BackendService])
    ], ProductionBannersManager);
    return ProductionBannersManager;
}(crud_grid_entity_manager_1.CrudGridEntityManager));
exports.ProductionBannersManager = ProductionBannersManager;
//# sourceMappingURL=production-banners-manager.js.map