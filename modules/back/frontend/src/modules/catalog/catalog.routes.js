"use strict";
var catalog_component_1 = require("./catalog.component");
var advantages_component_1 = require("./attachments/advantages.component");
var general_component_1 = require("./general/general.component");
var store_component_1 = require("./store/store.component");
exports.catalogRoute = {
    path: 'catalog',
    component: catalog_component_1.CatalogComponent,
    children: [
        {
            path: 'store',
            component: store_component_1.StoreComponent
        },
        {
            path: 'attachments',
            component: advantages_component_1.AttachmentsComponent
        },
        {
            path: 'general',
            component: general_component_1.GeneralComponent
        },
    ],
};
//# sourceMappingURL=catalog.routes.js.map