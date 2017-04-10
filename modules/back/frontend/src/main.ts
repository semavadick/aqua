import { Type } from '@angular/core';
import { bootstrap } from '@angular/platform-browser-dynamic';
import { AppComponent } from './app.component';
import { appRouterProviders } from './app.routes';

bootstrap(<Type>AppComponent, [
    appRouterProviders
]);
