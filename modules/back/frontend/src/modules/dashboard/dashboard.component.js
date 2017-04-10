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
var registrations_component_1 = require("./registrations/registrations.component");
var header_component_1 = require("../header/header.component");
var backend_service_1 = require("../../services/backend.service");
var articles_component_1 = require("./articles/articles.component");
var web_user_1 = require("../../services/web-user");
var news_component_1 = require("./news/news.component");
var orders_component_1 = require("./orders/orders.component");
var orders_sum_component_1 = require("./orders-sum/orders-sum.component");
var DashboardComponent = (function () {
    function DashboardComponent(wUser, backend) {
        this.wUser = wUser;
        this.backend = backend;
        this.totalOrdersCount = 0;
        this.preProcessingOrdersCount = 0;
        this.processingOrdersCount = 0;
        this.ordersWeeklySum = 0;
        this.ordersMonthlySum = 0;
        this.ordersTotalSum = 0;
        this.users = [];
        this.articles = [];
        this.news = [];
    }
    DashboardComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.backend.get('dashboard')
            .then(function (resp) {
            Object.assign(_this, resp.json());
        })
            .catch(function (resp) {
            alert(resp.text());
        });
    };
    DashboardComponent = __decorate([
        core_1.Component({
            templateUrl: './dashboard.html',
            directives: [
                header_component_1.HeaderComponent,
                registrations_component_1.RegistrationsComponent,
                articles_component_1.ArticlesComponent,
                news_component_1.NewsComponent,
                orders_component_1.OrdersComponent,
                orders_sum_component_1.OrdersSumComponent,
            ]
        }), 
        __metadata('design:paramtypes', [web_user_1.WebUser, backend_service_1.BackendService])
    ], DashboardComponent);
    return DashboardComponent;
}());
exports.DashboardComponent = DashboardComponent;
//# sourceMappingURL=dashboard.component.js.map