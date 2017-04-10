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
var faq_items_manager_1 = require("./faq-items-manager");
var faq_item_form_1 = require("./faq-item-form");
var my_wysiwyg_component_1 = require("../../../common/my-wysiwyg/my-wysiwyg.component");
var i18n_tabs_component_1 = require("../../../common/i18n-tabs/i18n-tabs.component");
var i18n_checkbox_component_1 = require("../../../common/i18n-checkbox/i18n-checkbox.component");
var form_group_component_1 = require("../../../common/form-group/form-group.component");
var my_modal_component_1 = require("../../../common/my-modal/my-modal.component");
var panel_spinner_component_1 = require("../../../common/panel-spinner/panel-spinner.component");
var form_button_component_1 = require("../../../common/form-button/form-button.component");
var FaqComponent = (function () {
    function FaqComponent(manager, form) {
        this.manager = manager;
        this.form = form;
        this.activeItem = null;
        manager.loadItems();
    }
    FaqComponent.prototype.toggleActiveItem = function (item) {
        if (this.activeItem && this.activeItem.id == item.id) {
            this.activeItem = null;
            return;
        }
        this.activeItem = item;
    };
    FaqComponent.prototype.itemIsActive = function (item) {
        return this.activeItem && this.activeItem.id == item.id;
    };
    FaqComponent.prototype.deleteItem = function (item) {
        if (confirm('Удалить вопрос?')) {
            this.manager.deleteItem(item);
        }
    };
    FaqComponent.prototype.createItem = function () {
        this.openModal();
    };
    FaqComponent.prototype.updateItem = function (item) {
        this.openModal(item);
    };
    FaqComponent.prototype.openModal = function (item) {
        var _this = this;
        if (item === void 0) { item = null; }
        var title = item ? 'Редактирование вопроса' : 'Добавление вопроса';
        this.modal.setTitle(title);
        this.modal.open();
        this.form.init(item)
            .then(function () {
            _this.i18nTabs.init(_this.form);
            if (!item) {
                _this.form.getI18ns()[0].saveI18n = true;
            }
        })
            .catch(function (message) {
            if (message) {
                alert(message);
            }
        });
    };
    FaqComponent.prototype.save = function () {
        var _this = this;
        this.form.save()
            .then(function () {
            _this.modal.close();
            _this.manager.loadItems();
        })
            .catch(function (message) {
            if (message) {
                alert(message);
            }
        });
    };
    __decorate([
        core_1.ViewChild(i18n_tabs_component_1.I18nTabsComponent, undefined), 
        __metadata('design:type', i18n_tabs_component_1.I18nTabsComponent)
    ], FaqComponent.prototype, "i18nTabs", void 0);
    __decorate([
        core_1.ViewChild(my_modal_component_1.MyModalComponent, undefined), 
        __metadata('design:type', my_modal_component_1.MyModalComponent)
    ], FaqComponent.prototype, "modal", void 0);
    FaqComponent = __decorate([
        core_1.Component({
            selector: 'faq-items',
            templateUrl: './faq.html',
            directives: [
                panel_spinner_component_1.PanelSpinnerComponent,
                my_wysiwyg_component_1.MyWysiwygComponent,
                i18n_tabs_component_1.I18nTabsComponent,
                i18n_checkbox_component_1.I18nCheckbox,
                form_group_component_1.FormGroupComponent,
                form_button_component_1.FormButtonComponent,
                my_modal_component_1.MyModalComponent,
            ],
            providers: [faq_items_manager_1.FaqItemsManager, faq_item_form_1.FaqItemForm],
        }), 
        __metadata('design:paramtypes', [faq_items_manager_1.FaqItemsManager, faq_item_form_1.FaqItemForm])
    ], FaqComponent);
    return FaqComponent;
}());
exports.FaqComponent = FaqComponent;
//# sourceMappingURL=faq.component.js.map