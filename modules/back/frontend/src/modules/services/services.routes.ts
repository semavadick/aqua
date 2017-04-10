import { Type }  from '@angular/core';
import { Route }  from '@angular/router';
import {ServicesComponent} from "./services.component";
import {MaintenanceComponent} from "./maintenance/maintenance.component";
import {ExclusiveComponent} from "./exclusive/exclusive.component";

export const servicesRoute: Route = {
    path: 'services',
    component: <Type>ServicesComponent,
    children: [
        {
            path: 'maintenance',
            component: <Type>MaintenanceComponent
        },
        {
            path: 'exclusive',
            component: <Type>ExclusiveComponent
        },
    ],
};