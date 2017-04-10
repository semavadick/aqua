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
var types_manager_1 = require("./types-manager");
var type_form_1 = require("./type-form");
var crud_grid_component_1 = require("../../../common/crud-grid/crud-grid.component");
var my_cropper_component_1 = require("../../../common/my-cropper/my-cropper.component");
var my_wysiwyg_component_1 = require("../../../common/my-wysiwyg/my-wysiwyg.component");
var i18n_tabs_component_1 = require("../../../common/i18n-tabs/i18n-tabs.component");
var i18n_checkbox_component_1 = require("../../../common/i18n-checkbox/i18n-checkbox.component");
var form_group_component_1 = require("../../../common/form-group/form-group.component");
var file_uploader_component_1 = require("../../../common/file-uploader/file-uploader.component");
var my_grid_component_1 = require("../../../common/my-grid/my-grid.component");
var advantage_form_1 = require("./advantage-form");
var languages_manager_1 = require("../../../services/languages-manager");
var advantage_component_1 = require("./advantage.component");
var PoolTypesComponent = (function () {
    function PoolTypesComponent(manager, form, langsManager) {
        this.manager = manager;
        this.form = form;
        this.langsManager = langsManager;
    }
    PoolTypesComponent.prototype.addAdvantage = function () {
        this.form.advantages.push(new advantage_form_1.AdvantageForm(this.langsManager));
    };
    PoolTypesComponent.prototype.deleteAdvantage = function (advantage) {
        var index = this.form.advantages.indexOf(advantage);
        this.form.advantages.splice(index, 1);
    };
    __decorate([
        core_1.ViewChild(i18n_tabs_component_1.I18nTabsComponent, undefined), 
        __metadata('design:type', i18n_tabs_component_1.I18nTabsComponent)
    ], PoolTypesComponent.prototype, "i18nTabs", void 0);
    PoolTypesComponent = __decorate([
        core_1.Component({
            selector: 'pool-types',
            templateUrl: './pool-types.html',
            directives: [
                crud_grid_component_1.CrudGridComponent,
                my_cropper_component_1.MyCropperComponent,
                my_wysiwyg_component_1.MyWysiwygComponent,
                i18n_tabs_component_1.I18nTabsComponent,
                i18n_checkbox_component_1.I18nCheckbox,
                form_group_component_1.FormGroupComponent,
                file_uploader_component_1.FileUploaderComponent,
                my_grid_component_1.MyGridComponent,
                advantage_component_1.AdvantageComponent,
            ],
            providers: [types_manager_1.TypesManager, type_form_1.TypeForm],
        }), 
        __metadata('design:paramtypes', [types_manager_1.TypesManager, type_form_1.TypeForm, languages_manager_1.LanguagesManager])
    ], PoolTypesComponent);
    return PoolTypesComponent;
}());
exports.PoolTypesComponent = PoolTypesComponent;
//# sourceMappingURL=pool-types.component.js.map