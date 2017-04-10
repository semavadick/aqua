import { Type }  from '@angular/core';
import { Route, CanActivate }  from '@angular/router';
import {SlidesComponent} from "./slides/slides.component";
import {MainPageComponent} from "./main-page.component";
import {BannersComponent} from "./banners/banners.component";
import {PageAboutComponent} from "./page-about/page-about.component";
import {PageContentComponent} from "./page-content/page-content.component";

export const mainPageRoute: Route = {
    path: 'main-page',
    component: <Type>MainPageComponent,
    children: [
        {
            path: 'slides',
            component: <Type>SlidesComponent
        },
        {
            path: 'banners',
            component: <Type>BannersComponent
        },
        {
            path: 'about',
            component: <Type>PageAboutComponent
        },
        {
            path: 'general',
            component: <Type>PageContentComponent
        },
    ],
};