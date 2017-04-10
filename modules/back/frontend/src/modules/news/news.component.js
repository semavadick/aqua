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
var news_manager_1 = require("./news-manager");
var my_wysiwyg_component_1 = require("../../common/my-wysiwyg/my-wysiwyg.component");
var my_cropper_component_1 = require("../../common/my-cropper/my-cropper.component");
var news_form_1 = require("./news-form");
var form_group_component_1 = require("../../common/form-group/form-group.component");
var i18n_tabs_component_1 = require("../../common/i18n-tabs/i18n-tabs.component");
var i18n_checkbox_component_1 = require("../../common/i18n-checkbox/i18n-checkbox.component");
var publication_galleries_component_1 = require("../publications/publication-galleries.component");
var publications_search_form_1 = require("../publications/publications-search-form");
var NewsComponent = (function () {
    function NewsComponent(form, searchForm, manager, route) {
        this.form = form;
        this.searchForm = searchForm;
        this.manager = manager;
        this.route = route;
        this.columns = [];
        var idColumn = new my_datatable_column_1.MyDatatableColumn();
        idColumn.header = 'ID';
        idColumn.attribute = 'id';
        this.columns.push(idColumn);
        var nameColumn = new my_datatable_column_1.MyDatatableColumn();
        nameColumn.header = 'Название';
        nameColumn.attribute = 'name';
        nameColumn.enableSorting = false;
        this.columns.push(nameColumn);
        var nameColumn = new my_datatable_column_1.MyDatatableColumn();
        nameColumn.header = 'Добавлена';
        nameColumn.attribute = 'added';
        this.columns.push(nameColumn);
    }
    NewsComponent.prototype.formInitialized = function (data) {
        this.i18ns.init(this.form);
    };
    NewsComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.route
            .params
            .subscribe(function (params) {
            var newsId = params['id'] - 0;
            if (newsId) {
                _this.searchForm.id = newsId;
            }
        });
    };
    __decorate([
        core_1.ViewChild(i18n_tabs_component_1.I18nTabsComponent, undefined), 
        __metadata('design:type', i18n_tabs_component_1.I18nTabsComponent)
    ], NewsComponent.prototype, "i18ns", void 0);
    NewsComponent = __decorate([
        core_1.Component({
            templateUrl: './news.html',
            directives: [
                header_component_1.HeaderComponent, my_datatable_component_1.MyDatatableComponent,
                my_wysiwyg_component_1.MyWysiwygComponent, my_cropper_component_1.MyCropperComponent,
                form_group_component_1.FormGroupComponent, i18n_tabs_component_1.I18nTabsComponent,
                i18n_checkbox_component_1.I18nCheckbox, publication_galleries_component_1.PublicationGalleriesComponent,
            ],
            providers: [news_manager_1.NewsManager, news_form_1.NewsForm, publications_search_form_1.PublicationsSearchForm],
        }), 
        __metadata('design:paramtypes', [news_form_1.NewsForm, publications_search_form_1.PublicationsSearchForm, news_manager_1.NewsManager, router_1.ActivatedRoute])
    ], NewsComponent);
    return NewsComponent;
}());
exports.NewsComponent = NewsComponent;
//# sourceMappingURL=news.component.js.map