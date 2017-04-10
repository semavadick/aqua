import { Type, Injectable }  from '@angular/core';
import { Router, provideRouter, RouterConfig, CanActivate }  from '@angular/router';
import { AuthComponent } from './auth.component';
import { LoginComponent } from './login/login.component';
import { Observable } from "rxjs/Observable";
import { Observer } from "rxjs/Observer";
import { WebUser } from "../services/web-user";
import { PasswordRecoveryComponent } from "./password-recovery/password-recovery.component";
import { PasswordResetComponent } from "./password-reset/password-reset.component";

@Injectable()
export class AuthGuard implements CanActivate {

    public constructor(private wUser: WebUser, private router: Router) { }

    canActivate(): Observable<boolean> {
        var wUser = this.wUser;
        return Observable.create((observer: Observer<any>) => {
            wUser.init()
                .then(() => {
                    if(wUser.isLoggedIn) {
                        this.router.navigate(['/']);
                        observer.next(false);

                    } else {
                        observer.next(true);
                    }
                    observer.complete();
                })
                .catch(() => {
                    alert('Ошибка инициализации приложения');
                    observer.next(false);
                    observer.complete();
                });
        });
    }

}

export const authRoutes: RouterConfig = [
    {
        path: 'auth',
        component: <Type>AuthComponent,
        canActivate: [AuthGuard],
        children: [
            {
                path: 'login',
                component: <Type>LoginComponent
            },

            {
                path: 'password-recovery',
                component: <Type>PasswordRecoveryComponent
            },

            {
                path: 'password-reset',
                component: <Type>PasswordResetComponent
            },
        ],
    },
];

export const authProviders = [
    AuthGuard
];