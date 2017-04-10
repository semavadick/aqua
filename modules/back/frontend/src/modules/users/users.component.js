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
var users_manager_1 = require("./users-manager");
var user_form_1 = require("./user-form/user-form");
var search_form_1 = require("./search-form/search-form");
var form_group_component_1 = require("../../common/form-group/form-group.component");
var user_form_component_1 = require("./user-form/user-form.component");
var search_form_component_1 = require("./search-form/search-form.component");
var UsersComponent = (function () {
    function UsersComponent(userForm, searchForm, manager, route) {
        this.userForm = userForm;
        this.searchForm = searchForm;
        this.manager = manager;
        this.route = route;
        this.columns = [];
        var idColumn = new my_datatable_column_1.MyDatatableColumn();
        idColumn.header = 'ID';
        idColumn.attribute = 'id';
        this.columns.push(idColumn);
        var nameColumn = new my_datatable_column_1.MyDatatableColumn();
        nameColumn.header = 'Телефон';
        nameColumn.attribute = 'phone';
        nameColumn.enableSorting = false;
        this.columns.push(nameColumn);
        var nameColumn = new my_datatable_column_1.MyDatatableColumn();
        nameColumn.header = 'E-mail';
        nameColumn.attribute = 'email';
        nameColumn.enableSorting = false;
        this.columns.push(nameColumn);
        var nameColumn = new my_datatable_column_1.MyDatatableColumn();
        nameColumn.header = 'Имя и фамилия';
        nameColumn.attribute = 'fullName';
        nameColumn.enableSorting = false;
        this.columns.push(nameColumn);
        var nameColumn = new my_datatable_column_1.MyDatatableColumn();
        nameColumn.header = 'Тип';
        nameColumn.attribute = 'type';
        nameColumn.enableSorting = false;
        this.columns.push(nameColumn);
        var nameColumn = new my_datatable_column_1.MyDatatableColumn();
        nameColumn.header = 'Кол-во заказов';
        nameColumn.attribute = 'ordersCount';
        nameColumn.enableSorting = false;
        this.columns.push(nameColumn);
        var nameColumn = new my_datatable_column_1.MyDatatableColumn();
        nameColumn.header = 'Реквизиты компании';
        nameColumn.attribute = 'companyInfoFileUrl';
        nameColumn.enableSorting = false;
        nameColumn.rawContent = true;
        this.columns.push(nameColumn);
    }
    UsersComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.route
            .params
            .subscribe(function (params) {
            var userId = params['id'] - 0;
            if (userId) {
                _this.searchForm.id = userId;
            }
        });
    };
    __decorate([
        core_1.ViewChild(user_form_component_1.UserFormComponent, undefined), 
        __metadata('design:type', user_form_component_1.UserFormComponent)
    ], UsersComponent.prototype, "userFormComponent", void 0);
    UsersComponent = __decorate([
        core_1.Component({
            templateUrl: './users.html',
            directives: [
                header_component_1.HeaderComponent,
                my_datatable_component_1.MyDatatableComponent,
                form_group_component_1.FormGroupComponent,
                search_form_component_1.SearchFormComponent,
                user_form_component_1.UserFormComponent,
            ],
            providers: [users_manager_1.UsersManager, user_form_1.UserForm, search_form_1.SearchForm],
        }), 
        __metadata('design:paramtypes', [user_form_1.UserForm, search_form_1.SearchForm, users_manager_1.UsersManager, router_1.ActivatedRoute])
    ], UsersComponent);
    return UsersComponent;
}());
exports.UsersComponent = UsersComponent;
//# sourceMappingURL=users.component.js.map