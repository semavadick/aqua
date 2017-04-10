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
var order_form_1 = require("../order-form/order-form");
var orders_manager_1 = require("../orders-manager");
var SearchForm = (function () {
    function SearchForm(manager) {
        this.manager = manager;
        this.status = null;
        this.clientId = null;
        this.statuses = [
            {
                id: null,
                label: 'Любой',
            },
        ];
        this.statuses = this.statuses.concat(order_form_1.OrderForm.statuses);
    }
    SearchForm.prototype.getAttributes = function () {
        return {
            id: this.id,
            status: this.status,
            clientId: this.clientId,
        };
    };
    SearchForm.prototype.getClients = function () {
        var clients = [
            {
                id: null,
                label: 'Любой',
            },
        ];
        return clients.concat(this.manager.clients);
    };
    SearchForm = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [orders_manager_1.OrdersManager])
    ], SearchForm);
    return SearchForm;
}());
exports.SearchForm = SearchForm;
//# sourceMappingURL=search-form.js.map