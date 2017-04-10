import { Type }  from '@angular/core';
import { provideRouter, RouterConfig }  from '@angular/router';
import { HTTP_PROVIDERS }  from '@angular/http';
import { authRoutes, authProviders } from './auth/auth.routes';
import { modulesRoutes, modulesProviders } from './modules/modules.routes';
import { notFoundRoutes } from "./not-found/not-found.routes";
import { WebUser } from "./services/web-user";
import { BackendService } from "./services/backend.service";
import { LanguagesManager } from "./services/languages-manager";

const routes: RouterConfig = [
    ...authRoutes,
    ...modulesRoutes,
    ...notFoundRoutes,
];

export const appRouterProviders = [
    provideRouter(routes),
    WebUser,
    LanguagesManager,
    HTTP_PROVIDERS,
    BackendService,
    authProviders,
    modulesProviders,
];