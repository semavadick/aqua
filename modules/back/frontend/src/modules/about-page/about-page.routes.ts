import { Type }  from '@angular/core';
import { Route }  from '@angular/router';
import {AboutPageComponent} from "./about-page.component";
import {HistoryComponent} from "./history/history.component";
import {CompetenceComponent} from "./competence/competence.component";
import {ProductionComponent} from "./production/production.component";
import {AdvantagesComponent} from "./advantages/advantages.component";
import {CertificatesComponent} from "./certificates/certificates.component";
import {ContactsComponent} from "./contacts/contacts.component";
import {PageSeoComponent} from "./page-seo/page-seo.component";

export const aboutPageRoute: Route = {
    path: 'about-page',
    component: <Type>AboutPageComponent,
    children: [
        {
            path: 'history',
            component: <Type>HistoryComponent
        },
        {
            path: 'competence',
            component: <Type>CompetenceComponent
        },
        {
            path: 'production',
            component: <Type>ProductionComponent
        },
        {
            path: 'advantages',
            component: <Type>AdvantagesComponent
        },
        {
            path: 'certificates',
            component: <Type>CertificatesComponent
        },
        {
            path: 'contacts',
            component: <Type>ContactsComponent
        },
        {
            path: 'seo',
            component: <Type>PageSeoComponent
        },
    ],
};