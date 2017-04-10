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
var panel_spinner_component_1 = require("../../../../common/panel-spinner/panel-spinner.component");
var categories_tree_component_1 = require("../categories-tree/categories-tree.component");
var my_modal_component_1 = require("../../../../common/my-modal/my-modal.component");
var i18n_tabs_component_1 = require("../../../../common/i18n-tabs/i18n-tabs.component");
var category_form_1 = require("./category-form");
var languages_manager_1 = require("../../../../services/languages-manager");
var filter_form_1 = require("./filter-form");
var i18n_checkbox_component_1 = require("../../../../common/i18n-checkbox/i18n-checkbox.component");
var form_group_component_1 = require("../../../../common/form-group/form-group.component");
var form_button_component_1 = require("../../../../common/form-button/form-button.component");
var my_cropper_component_1 = require("../../../../common/my-cropper/my-cropper.component");
var my_wysiwyg_component_1 = require("../../../../common/my-wysiwyg/my-wysiwyg.component");
var filter_component_1 = require("./filter.component");
var my_grid_component_1 = require("../../../../common/my-grid/my-grid.component");
var my_checkbox_component_1 = require("../../../../common/my-checkbox/my-checkbox.component");
var CategoryDetailsComponent = (function () {
    function CategoryDetailsComponent(form, langsManager) {
        this.form = form;
        this.langsManager = langsManager;
        this.onSave = new core_1.EventEmitter();
    }
    CategoryDetailsComponent.prototype.selectCategories = function (categories) {
        this.form.setRelatedCategories(categories);
    };
    CategoryDetailsComponent.prototype.createCategory = function (parent, treeCategories) {
        if (parent === void 0) { parent = null; }
        this.modal.setTitle('Добавление подкатегории');
        this.openModal(null, treeCategories, parent);
    };
    CategoryDetailsComponent.prototype.updateCategory = function (category, treeCategories) {
        this.modal.setTitle('Редактирование категории');
        this.openModal(category, treeCategories, null);
    };
    CategoryDetailsComponent.prototype.openModal = function (category, treeCategories, parent) {
        var _this = this;
        if (category === void 0) { category = null; }
        if (parent === void 0) { parent = null; }
        this.modal.open();
        this.form.init(category, parent)
            .then(function () {
            _this.i18ns.init(_this.form);
            _this.tree.load(treeCategories, _this.form.getRelatedCategories());
        })
            .catch(function (message) {
            if (message) {
                alert(message);
            }
        });
    };
    CategoryDetailsComponent.prototype.save = function () {
        var _this = this;
        this.form.save()
            .then(function () {
            _this.modal.close();
            _this.onSave.emit(null);
        })
            .catch(function (message) {
            if (message) {
                alert(message);
            }
        });
    };
    CategoryDetailsComponent.prototype.addFilter = function () {
        this.form.filters.push(new filter_form_1.FilterForm(this.langsManager));
    };
    CategoryDetailsComponent.prototype.deleteFilter = function (filter) {
        var index = this.form.filters.indexOf(filter);
        this.form.filters.splice(index, 1);
    };
    __decorate([
        core_1.Output(), 
        __metadata('design:type', (typeof (_a = typeof core_1.EventEmitter !== 'undefined' && core_1.EventEmitter) === 'function' && _a) || Object)
    ], CategoryDetailsComponent.prototype, "onSave", void 0);
    __decorate([
        core_1.ViewChild(categories_tree_component_1.CategoriesTreeComponent, undefined), 
        __metadata('design:type', categories_tree_component_1.CategoriesTreeComponent)
    ], CategoryDetailsComponent.prototype, "tree", void 0);
    __decorate([
        core_1.ViewChild(my_modal_component_1.MyModalComponent, undefined), 
        __metadata('design:type', my_modal_component_1.MyModalComponent)
    ], CategoryDetailsComponent.prototype, "modal", void 0);
    __decorate([
        core_1.ViewChild(i18n_tabs_component_1.I18nTabsComponent, undefined), 
        __metadata('design:type', i18n_tabs_component_1.I18nTabsComponent)
    ], CategoryDetailsComponent.prototype, "i18ns", void 0);
    CategoryDetailsComponent = __decorate([
        core_1.Component({
            selector: 'category-details',
            templateUrl: './category-details.html',
            directives: [
                categories_tree_component_1.CategoriesTreeComponent,
                panel_spinner_component_1.PanelSpinnerComponent,
                my_modal_component_1.MyModalComponent,
                i18n_tabs_component_1.I18nTabsComponent,
                i18n_checkbox_component_1.I18nCheckbox,
                form_group_component_1.FormGroupComponent,
                form_button_component_1.FormButtonComponent,
                my_cropper_component_1.MyCropperComponent,
                my_wysiwyg_component_1.MyWysiwygComponent,
                filter_component_1.FilterComponent,
                my_grid_component_1.MyGridComponent,
                my_checkbox_component_1.MyCheckbox,
            ],
            providers: [
                category_form_1.CategoryForm,
            ]
        }), 
        __metadata('design:paramtypes', [category_form_1.CategoryForm, languages_manager_1.LanguagesManager])
    ], CategoryDetailsComponent);
    return CategoryDetailsComponent;
    var _a;
}());
exports.CategoryDetailsComponent = CategoryDetailsComponent;
//# sourceMappingURL=category-details.component.js.map