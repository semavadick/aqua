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
var modules_component_1 = require('./modules.component');
var dashboard_component_1 = require("./dashboard/dashboard.component");
var Observable_1 = require("rxjs/Observable");
var web_user_1 = require("../services/web-user");
var languages_manager_1 = require("../services/languages-manager");
var main_page_routes_1 = require("./main-page/main-page.routes");
var about_page_routes_1 = require("./about-page/about-page.routes");
var news_component_1 = require("./news/news.component");
var articles_component_1 = require("./articles/articles.component");
var pools_building_routes_1 = require("./pools-building/pools-building.routes");
var object_galleries_component_1 = require("./object-galleries/object-galleries.component");
var services_routes_1 = require("./services/services.routes");
var catalog_routes_1 = require("./catalog/catalog.routes");
var users_component_1 = require("./users/users.component");
var orders_component_1 = require("./orders/orders.component");
var settings_component_1 = require("./settings/settings.component");
var ModulesGuard = (function () {
    function ModulesGuard(wUser, langsManager, router) {
        this.wUser = wUser;
        this.langsManager = langsManager;
        this.router = router;
    }
    ModulesGuard.prototype.canActivate = function () {
        var _this = this;
        var wUser = this.wUser;
        return Observable_1.Observable.create(function (observer) {
            wUser.init()
                .then(function () {
                if (!wUser.isLoggedIn) {
                    _this.router.navigate(['/auth/login']);
                    observer.next(false);
                    observer.complete();
                }
                else {
                    _this.langsManager.init()
                        .then(function () {
                        observer.next(true);
                        observer.complete();
                    })
                        .catch(function () {
                        observer.next(false);
                        observer.complete();
                    });
                }
            })
                .catch(function () {
                alert('Ошибка инициализации приложения');
                observer.next(false);
                observer.complete();
            });
        });
    };
    ModulesGuard = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [web_user_1.WebUser, languages_manager_1.LanguagesManager, router_1.Router])
    ], ModulesGuard);
    return ModulesGuard;
}());
exports.ModulesGuard = ModulesGuard;
exports.modulesRoutes = [
    {
        path: '',
        pathMatch: 'full',
        redirectTo: '/modules/dashboard',
    },
    {
        path: 'modules',
        component: modules_component_1.ModulesComponent,
        canActivate: [ModulesGuard],
        children: [
            {
                path: 'dashboard',
                component: dashboard_component_1.DashboardComponent
            },
            main_page_routes_1.mainPageRoute,
            about_page_routes_1.aboutPageRoute,
            {
                path: 'news',
                component: news_component_1.NewsComponent
            },
            {
                path: 'articles',
                component: articles_component_1.ArticlesComponent
            },
            pools_building_routes_1.poolsBuildingRoute,
            {
                path: 'object-galleries',
                component: object_galleries_component_1.ObjectGalleriesComponent
            },
            services_routes_1.servicesRoute,
            catalog_routes_1.catalogRoute,
            {
                path: 'users',
                component: users_component_1.UsersComponent
            },
            {
                path: 'orders',
                component: orders_component_1.OrdersComponent
            },
            {
                path: 'settings',
                component: settings_component_1.SettingsComponent
            },
        ]
    },
];
exports.modulesProviders = [
    ModulesGuard
];
//# sourceMappingURL=modules.routes.js.map