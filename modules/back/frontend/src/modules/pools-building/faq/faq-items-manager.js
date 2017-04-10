"use strict";
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
var faq_item_1 = require("./faq-item");
var FaqItemsManager = (function () {
    function FaqItemsManager(backend) {
        this.backend = backend;
        this.isLoading = false;
        this.backendUrl = 'pools-building/faq';
    }
    FaqItemsManager.prototype.loadItems = function () {
        var _this = this;
        this.isLoading = true;
        this.backend.get(this.backendUrl)
            .then(function (resp) {
            _this.items = [];
            for (var _i = 0, _a = resp.json(); _i < _a.length; _i++) {
                var entityData = _a[_i];
                var entity = new faq_item_1.FaqItem();
                Object.assign(entity, entityData);
                _this.items.push(entity);
            }
            _this.isLoading = false;
        })
            .catch(function (resp) {
            alert(resp.text());
        });
    };
    FaqItemsManager.prototype.deleteItem = function (item) {
        var _this = this;
        this.isLoading = true;
        var url = this.backendUrl + '/' + item.id;
        this.backend.delete(url)
            .then(function (resp) {
            _this.isLoading = false;
            _this.loadItems();
        })
            .catch(function (resp) {
            alert(resp.text());
        });
    };
    FaqItemsManager = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [backend_service_1.BackendService])
    ], FaqItemsManager);
    return FaqItemsManager;
}());
exports.FaqItemsManager = FaqItemsManager;
//# sourceMappingURL=faq-items-manager.js.map