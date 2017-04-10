"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
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
var form_group_component_1 = require("../../../common/form-group/form-group.component");
var i18n_tabs_component_1 = require("../../../common/i18n-tabs/i18n-tabs.component");
var form_panel_component_1 = require("../../../common/form-panel/form-panel.component");
var my_cropper_component_1 = require("../../../common/my-cropper/my-cropper.component");
var my_wysiwyg_component_1 = require("../../../common/my-wysiwyg/my-wysiwyg.component");
var rebuilding_form_1 = require("./rebuilding-form");
var file_uploader_component_1 = require("../../../common/file-uploader/file-uploader.component");
var pools_building_static_component_1 = require("../pools-building-static/pools-building-static.component");
var languages_manager_1 = require("../../../services/languages-manager");
var pools_building_static_galleries_component_1 = require("../pools-building-static/pools-building-static-galleries.component");
var RebuildingComponent = (function (_super) {
    __extends(RebuildingComponent, _super);
    function RebuildingComponent(form, langsManager) {
        _super.call(this);
        this.form = form;
        this.langsManager = langsManager;
        this.title = "Реконструкция";
    }
    RebuildingComponent.prototype.getForm = function () {
        return this.form;
    };
    RebuildingComponent.prototype.getLangsManager = function () {
        return this.langsManager;
    };
    RebuildingComponent.prototype.formInitialized = function (data) {
        this.i18ns.init(this.form);
    };
    __decorate([
        core_1.ViewChild(i18n_tabs_component_1.I18nTabsComponent, undefined), 
        __metadata('design:type', i18n_tabs_component_1.I18nTabsComponent)
    ], RebuildingComponent.prototype, "i18nTabs", void 0);
    RebuildingComponent = __decorate([
        core_1.Component({
            selector: 'rebuilding',
            templateUrl: '../pools-building-static/pools-building-static.html',
            directives: [
                form_group_component_1.FormGroupComponent,
                i18n_tabs_component_1.I18nTabsComponent,
                form_panel_component_1.FormPanelComponent,
                my_cropper_component_1.MyCropperComponent,
                my_wysiwyg_component_1.MyWysiwygComponent,
                file_uploader_component_1.FileUploaderComponent,
                pools_building_static_galleries_component_1.PoolsBuildingStaticGalleriesComponent,
            ],
            providers: [rebuilding_form_1.RebuildingForm],
        }), 
        __metadata('design:paramtypes', [rebuilding_form_1.RebuildingForm, languages_manager_1.LanguagesManager])
    ], RebuildingComponent);
    return RebuildingComponent;
}(pools_building_static_component_1.PoolsBuildingStaticComponent));
exports.RebuildingComponent = RebuildingComponent;
//# sourceMappingURL=rebuilding.component.js.map