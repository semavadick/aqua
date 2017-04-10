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
var router_1 = require('@angular/router');
var header_component_1 = require("../header/header.component");
var my_datatable_column_1 = require("../../common/my-datatable/my-datatable-column");
var my_datatable_component_1 = require("../../common/my-datatable/my-datatable.component");
var orders_manager_1 = require("./orders-manager");
var order_form_1 = require("./order-form/order-form");
var search_form_1 = require("./search-form/search-form");
var form_group_component_1 = require("../../common/form-group/form-group.component");
var order_form_component_1 = require("./order-form/order-form.component");
var search_form_component_1 = require("./search-form/search-form.component");
var OrdersComponent = (function () {
    function OrdersComponent(orderForm, searchForm, manager, route) {
        this.orderForm = orderForm;
        this.searchForm = searchForm;
        this.manager = manager;
        this.route = route;
        this.columns = [];
        var idColumn = new my_datatable_column_1.MyDatatableColumn();
        idColumn.header = 'ID';
        idColumn.attribute = 'id';
        this.columns.push(idColumn);
        var nameColumn = new my_datatable_column_1.MyDatatableColumn();
        nameColumn.header = 'Клеиент';
        nameColumn.attribute = 'client';
        nameColumn.enableSorting = false;
        this.columns.push(nameColumn);
        var nameColumn = new my_datatable_column_1.MyDatatableColumn();
        nameColumn.header = 'Сумма';
        nameColumn.attribute = 'totalCost';
        nameColumn.enableSorting = false;
        this.columns.push(nameColumn);
        var nameColumn = new my_datatable_column_1.MyDatatableColumn();
        nameColumn.header = 'Статус';
        nameColumn.attribute = 'statusLabel';
        nameColumn.enableSorting = false;
        this.columns.push(nameColumn);
        var nameColumn = new my_datatable_column_1.MyDatatableColumn();
        nameColumn.header = 'Дата';
        nameColumn.attribute = 'added';
        this.columns.push(nameColumn);
    }
    OrdersComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.route
            .params
            .subscribe(function (params) {
            var status = params['status'];
            if (status !== undefined) {
                _this.searchForm.status = status;
            }
        });
    };
    __decorate([
        core_1.ViewChild(order_form_component_1.OrderFormComponent, undefined), 
        __metadata('design:type', order_form_component_1.OrderFormComponent)
    ], OrdersComponent.prototype, "orderFormComponent", void 0);
    OrdersComponent = __decorate([
        core_1.Component({
            templateUrl: './orders.html',
            directives: [
                header_component_1.HeaderComponent,
                my_datatable_component_1.MyDatatableComponent,
                form_group_component_1.FormGroupComponent,
                search_form_component_1.SearchFormComponent,
                order_form_component_1.OrderFormComponent,
            ],
            providers: [orders_manager_1.OrdersManager, order_form_1.OrderForm, search_form_1.SearchForm],
        }), 
        __metadata('design:paramtypes', [order_form_1.OrderForm, search_form_1.SearchForm, orders_manager_1.OrdersManager, router_1.ActivatedRoute])
    ], OrdersComponent);
    return OrdersComponent;
}());
exports.OrdersComponent = OrdersComponent;
//# sourceMappingURL=orders.component.js.map