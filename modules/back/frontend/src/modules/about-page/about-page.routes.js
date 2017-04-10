"use strict";
var about_page_component_1 = require("./about-page.component");
var history_component_1 = require("./history/history.component");
var competence_component_1 = require("./competence/competence.component");
var production_component_1 = require("./production/production.component");
var advantages_component_1 = require("./advantages/advantages.component");
var certificates_component_1 = require("./certificates/certificates.component");
var contacts_component_1 = require("./contacts/contacts.component");
var page_seo_component_1 = require("./page-seo/page-seo.component");
exports.aboutPageRoute = {
    path: 'about-page',
    component: about_page_component_1.AboutPageComponent,
    children: [
        {
            path: 'history',
            component: history_component_1.HistoryComponent
        },
        {
            path: 'competence',
            component: competence_component_1.CompetenceComponent
        },
        {
            path: 'production',
            component: production_component_1.ProductionComponent
        },
        {
            path: 'advantages',
            component: advantages_component_1.AdvantagesComponent
        },
        {
            path: 'certificates',
            component: certificates_component_1.CertificatesComponent
        },
        {
            path: 'contacts',
            component: contacts_component_1.ContactsComponent
        },
        {
            path: 'seo',
            component: page_seo_component_1.PageSeoComponent
        },
    ],
};
//# sourceMappingURL=about-page.routes.js.map