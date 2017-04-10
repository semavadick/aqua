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
var my_datatable_manager_1 = require("./my-datatable-manager");
var my_datatable_pagination_1 = require("./my-datatable-pagination");
var my_datatable_sort_1 = require("./my-datatable-sort");
var panel_spinner_component_1 = require("../panel-spinner/panel-spinner.component");
var my_modal_component_1 = require("../my-modal/my-modal.component");
var form_button_component_1 = require("../form-button/form-button.component");
var my_datatable_entity_form_1 = require("./my-datatable-entity-form");
var MyDatatableComponent = (function () {
    function MyDatatableComponent() {
        this.columns = [];
        this.defaultSortAttribute = '';
        this.formInitialize = new core_1.EventEmitter();
        this.title = "";
        this.createDisabled = false;
        this.createButtonText = "";
        this.deleteMessage = "Уверены, что хотите удалить данный элемент?";
        this.pagination = new my_datatable_pagination_1.MyDatatablePagination();
        this.sort = new my_datatable_sort_1.MyDatatableSort();
    }
    MyDatatableComponent.prototype.ngOnInit = function () {
        this.manager.setPagination(this.pagination);
        this.manager.setSort(this.sort);
        if (this.defaultSortAttribute) {
            this.sort.attribute = this.defaultSortAttribute;
        }
        if (this.searchForm) {
            this.manager.setSearchForm(this.searchForm);
        }
        this.manager.loadEntities();
    };
    MyDatatableComponent.prototype.createEntity = function () {
        this.openModal();
    };
    MyDatatableComponent.prototype.updateEntity = function (entity) {
        this.openModal(entity);
    };
    MyDatatableComponent.prototype.openModal = function (entity) {
        var _this = this;
        if (entity === void 0) { entity = null; }
        var title = !entity ? this.createFormTitle : this.updateFormTitle;
        this.modal.setTitle(title);
        this.modal.open();
        this.entityForm.init(entity)
            .then(function (message) {
            _this.formInitialize.emit(null);
        })
            .catch(function (message) {
            alert(message);
        });
    };
    MyDatatableComponent.prototype.save = function () {
        var _this = this;
        this.entityForm.save()
            .then(function () {
            _this.modal.close();
            _this.manager.loadEntities();
        })
            .catch(function (message) {
            if (message) {
                alert(message);
            }
        });
    };
    MyDatatableComponent.prototype.deleteEntity = function (entity) {
        if (confirm(this.deleteMessage)) {
            this.manager.deleteEntity(entity);
        }
    };
    MyDatatableComponent.prototype.goToPage = function (pageNumber) {
        this.pagination.currentPage = pageNumber;
        this.manager.loadEntities();
    };
    MyDatatableComponent.prototype.goToPrevPage = function () {
        if (this.pagination.isOnFirstPage()) {
            return;
        }
        this.pagination.currentPage--;
        this.manager.loadEntities();
    };
    MyDatatableComponent.prototype.goToNextPage = function () {
        if (this.pagination.isOnLastPage()) {
            return;
        }
        this.pagination.currentPage++;
        this.manager.loadEntities();
    };
    MyDatatableComponent.prototype.sortByColumn = function (column) {
        if (!column.enableSorting) {
            return;
        }
        this.sort.sortBy(column);
        this.manager.loadEntities();
    };
    MyDatatableComponent.prototype.search = function () {
        this.manager.loadEntities();
    };
    __decorate([
        core_1.Input(), 
        __metadata('design:type', Array)
    ], MyDatatableComponent.prototype, "columns", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', String)
    ], MyDatatableComponent.prototype, "defaultSortAttribute", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', my_datatable_manager_1.MyDatatableManager)
    ], MyDatatableComponent.prototype, "manager", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', Object)
    ], MyDatatableComponent.prototype, "searchForm", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', my_datatable_entity_form_1.MyDatatableEntityForm)
    ], MyDatatableComponent.prototype, "entityForm", void 0);
    __decorate([
        core_1.Output(), 
        __metadata('design:type', (typeof (_a = typeof core_1.EventEmitter !== 'undefined' && core_1.EventEmitter) === 'function' && _a) || Object)
    ], MyDatatableComponent.prototype, "formInitialize", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', String)
    ], MyDatatableComponent.prototype, "title", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', Boolean)
    ], MyDatatableComponent.prototype, "createDisabled", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', String)
    ], MyDatatableComponent.prototype, "createButtonText", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', String)
    ], MyDatatableComponent.prototype, "deleteMessage", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', String)
    ], MyDatatableComponent.prototype, "createFormTitle", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', String)
    ], MyDatatableComponent.prototype, "updateFormTitle", void 0);
    __decorate([
        core_1.ViewChild(my_modal_component_1.MyModalComponent, undefined), 
        __metadata('design:type', my_modal_component_1.MyModalComponent)
    ], MyDatatableComponent.prototype, "modal", void 0);
    MyDatatableComponent = __decorate([
        core_1.Component({
            selector: 'my-datatable',
            templateUrl: './my-datatable.html',
            directives: [
                panel_spinner_component_1.PanelSpinnerComponent,
                my_modal_component_1.MyModalComponent,
                form_button_component_1.FormButtonComponent,
            ],
        }), 
        __metadata('design:paramtypes', [])
    ], MyDatatableComponent);
    return MyDatatableComponent;
    var _a;
}());
exports.MyDatatableComponent = MyDatatableComponent;
//# sourceMappingURL=my-datatable.component.js.map