import { Type, Injectable }  from '@angular/core';
import { Router, provideRouter, RouterConfig, CanActivate }  from '@angular/router';
import { ModulesComponent } from './modules.component';
import { DashboardComponent } from "./dashboard/dashboard.component";
import { Observable } from "rxjs/Observable";
import { Observer } from "rxjs/Observer";
import { WebUser } from "../services/web-user";
import {LanguagesManager} from "../services/languages-manager";
import {mainPageRoute} from "./main-page/main-page.routes"
import {aboutPageRoute} from "./about-page/about-page.routes"
import {NewsComponent} from "./news/news.component";
import {ArticlesComponent} from "./articles/articles.component";
import {poolsBuildingRoute} from "./pools-building/pools-building.routes"
import {ObjectGalleriesComponent} from "./object-galleries/object-galleries.component";
import {servicesRoute} from "./services/services.routes";
import {catalogRoute} from "./catalog/catalog.routes";
import {UsersComponent} from "./users/users.component";
import {OrdersComponent} from "./orders/orders.component";
import {SettingsComponent} from "./settings/settings.component";

@Injectable()
export class ModulesGuard implements CanActivate {

    public constructor(private wUser: WebUser, private langsManager: LanguagesManager, private router: Router) { }

    canActivate(): Observable<boolean> {
        var wUser = this.wUser;
        return Observable.create((observer: Observer<any>) => {
            wUser.init()
                .then(() => {
                    if(!wUser.isLoggedIn) {
                        this.router.navigate(['/auth/login']);
                        observer.next(false);
                        observer.complete();

                    } else {
                        this.langsManager.init()
                            .then(() => {
                                observer.next(true);
                                observer.complete();
                            })
                            .catch(() => {
                                observer.next(false);
                                observer.complete();
                            });
                    }
                })
                .catch(() => {
                    alert('Ошибка инициализации приложения');
                    observer.next(false);
                    observer.complete();
                });
        });
    }

}

export const modulesRoutes: RouterConfig = [
    {
        path: '',
        pathMatch: 'full',
        redirectTo: '/modules/dashboard',

    },

    {
        path: 'modules',
        component: <Type>ModulesComponent,
        canActivate: [ModulesGuard],
        children: [
            {
                path: 'dashboard',
                component: <Type>DashboardComponent
            },

            mainPageRoute,

            aboutPageRoute,

            {
                path: 'news',
                component: <Type>NewsComponent
            },

            {
                path: 'articles',
                component: <Type>ArticlesComponent
            },

            poolsBuildingRoute,

            {
                path: 'object-galleries',
                component: <Type>ObjectGalleriesComponent
            },

            servicesRoute,

            catalogRoute,

            {
                path: 'users',
                component: <Type>UsersComponent
            },

            {
                path: 'orders',
                component: <Type>OrdersComponent
            },

            {
                path: 'settings',
                component: <Type>SettingsComponent
            },
        ]
    },
];

export const modulesProviders = [
    ModulesGuard
];