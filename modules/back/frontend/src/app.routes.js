"use strict";
var router_1 = require('@angular/router');
var http_1 = require('@angular/http');
var auth_routes_1 = require('./auth/auth.routes');
var modules_routes_1 = require('./modules/modules.routes');
var not_found_routes_1 = require("./not-found/not-found.routes");
var web_user_1 = require("./services/web-user");
var backend_service_1 = require("./services/backend.service");
var languages_manager_1 = require("./services/languages-manager");
var routes = auth_routes_1.authRoutes.concat(modules_routes_1.modulesRoutes, not_found_routes_1.notFoundRoutes);
exports.appRouterProviders = [
    router_1.provideRouter(routes),
    web_user_1.WebUser,
    languages_manager_1.LanguagesManager,
    http_1.HTTP_PROVIDERS,
    backend_service_1.BackendService,
    auth_routes_1.authProviders,
    modules_routes_1.modulesProviders,
];
//# sourceMappingURL=app.routes.js.map