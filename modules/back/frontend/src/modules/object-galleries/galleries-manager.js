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
var my_datatable_manager_1 = require("../../common/my-datatable/my-datatable-manager");
var backend_service_1 = require("../../services/backend.service");
var gallery_1 = require("./gallery");
var GalleriesManager = (function (_super) {
    __extends(GalleriesManager, _super);
    function GalleriesManager(backend) {
        _super.call(this);
        this.backend = backend;
        this.poolTypes = [];
    }
    GalleriesManager.prototype.loadPoolTypes = function () {
        var _this = this;
        return new Promise(function (resolve, reject) {
            var url = _this.getBackendUrl() + '/pool-types';
            _this.getBackend().get(url)
                .then(function (resp) {
                _this.poolTypes = [];
                for (var _i = 0, _a = resp.json(); _i < _a.length; _i++) {
                    var typeData = _a[_i];
                    _this.poolTypes.push(typeData);
                }
                resolve('ok');
            })
                .catch(function (resp) {
                reject(resp.text());
            });
        });
    };
    GalleriesManager.prototype.getBackend = function () {
        return this.backend;
    };
    GalleriesManager.prototype.getEntityFromData = function (data) {
        var gallery = new gallery_1.Gallery(data['id']);
        Object.assign(gallery, data);
        return gallery;
    };
    GalleriesManager.prototype.getBackendUrl = function () {
        return 'object-galleries';
    };
    GalleriesManager = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [backend_service_1.BackendService])
    ], GalleriesManager);
    return GalleriesManager;
}(my_datatable_manager_1.MyDatatableManager));
exports.GalleriesManager = GalleriesManager;
//# sourceMappingURL=galleries-manager.js.map