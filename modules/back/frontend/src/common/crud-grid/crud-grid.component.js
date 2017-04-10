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
var panel_spinner_component_1 = require("../panel-spinner/panel-spinner.component");
var my_grid_component_1 = require("../my-grid/my-grid.component");
var my_thumb_component_1 = require("../my-thumb/my-thumb.component");
var crud_grid_entity_manager_1 = require("./crud-grid-entity-manager");
var my_modal_component_1 = require("../my-modal/my-modal.component");
var crud_grid_entity_form_1 = require("./crud-grid-entity-form");
var i18n_tabs_component_1 = require("../i18n-tabs/i18n-tabs.component");
var form_button_component_1 = require("../form-button/form-button.component");
var CrudGridComponent = (function () {
    function CrudGridComponent() {
        this.i18nTabs = null;
        this.grayBg = false;
    }
    CrudGridComponent.prototype.ngOnInit = function () {
        this.manager.loadEntities();
    };
    CrudGridComponent.prototype.deleteEntity = function (entity) {
        this.manager.deleteEntity(entity);
    };
    CrudGridComponent.prototype.createEntity = function () {
        this.openModal();
    };
    CrudGridComponent.prototype.updateEntity = function (entity) {
        this.openModal(entity);
    };
    CrudGridComponent.prototype.openModal = function (entity) {
        var _this = this;
        if (entity === void 0) { entity = null; }
        var title = !entity ? this.createFormTitle : this.updateFormTitle;
        this.modal.setTitle(title);
        this.modal.open();
        this.form.init(entity)
            .then(function (message) {
            if (_this.i18nTabs) {
                _this.i18nTabs.init(_this.form);
            }
        })
            .catch(function (message) {
            alert(message);
        });
    };
    CrudGridComponent.prototype.save = function () {
        var _this = this;
        this.form.save()
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
    __decorate([
        core_1.Input(), 
        __metadata('design:type', crud_grid_entity_manager_1.CrudGridEntityManager)
    ], CrudGridComponent.prototype, "manager", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', crud_grid_entity_form_1.CrudGridEntityForm)
    ], CrudGridComponent.prototype, "form", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', i18n_tabs_component_1.I18nTabsComponent)
    ], CrudGridComponent.prototype, "i18nTabs", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', String)
    ], CrudGridComponent.prototype, "title", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', String)
    ], CrudGridComponent.prototype, "createButtonText", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', String)
    ], CrudGridComponent.prototype, "deleteMessage", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', String)
    ], CrudGridComponent.prototype, "createFormTitle", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', String)
    ], CrudGridComponent.prototype, "updateFormTitle", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', Boolean)
    ], CrudGridComponent.prototype, "grayBg", void 0);
    __decorate([
        core_1.ViewChild(my_modal_component_1.MyModalComponent, undefined), 
        __metadata('design:type', my_modal_component_1.MyModalComponent)
    ], CrudGridComponent.prototype, "modal", void 0);
    CrudGridComponent = __decorate([
        core_1.Component({
            selector: 'crud-grid',
            templateUrl: './crud-grid.html',
            directives: [
                panel_spinner_component_1.PanelSpinnerComponent,
                my_grid_component_1.MyGridComponent,
                my_thumb_component_1.MyThumbComponent,
                my_modal_component_1.MyModalComponent,
                form_button_component_1.FormButtonComponent,
            ],
        }), 
        __metadata('design:paramtypes', [])
    ], CrudGridComponent);
    return CrudGridComponent;
}());
exports.CrudGridComponent = CrudGridComponent;
//# sourceMappingURL=crud-grid.component.js.map