import { Type }  from '@angular/core';
import { provideRouter, RouterConfig }  from '@angular/router';
import {NotFoundComponent} from "./not-found.component";

export const notFoundRoutes: RouterConfig = [
    {
        path: '**',
        component: <Type>NotFoundComponent,
    },
];