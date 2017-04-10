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
var user_1 = require("./user");
var UsersManager = (function (_super) {
    __extends(UsersManager, _super);
    function UsersManager(backend) {
        _super.call(this);
        this.backend = backend;
    }
    UsersManager.prototype.getBackend = function () {
        return this.backend;
    };
    UsersManager.prototype.getEntityFromData = function (data) {
        var article = new user_1.User(data['id']);
        Object.assign(article, data);
        return article;
    };
    UsersManager.prototype.getBackendUrl = function () {
        return 'users';
    };
    UsersManager = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [backend_service_1.BackendService])
    ], UsersManager);
    return UsersManager;
}(my_datatable_manager_1.MyDatatableManager));
exports.UsersManager = UsersManager;
//# sourceMappingURL=users-manager.js.map