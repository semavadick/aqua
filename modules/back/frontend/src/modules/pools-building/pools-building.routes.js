"use strict";
var pools_building_component_1 = require("./pools-building.component");
var page_seo_component_1 = require("./page-seo/page-seo.component");
var pool_types_component_1 = require("./pool-types/pool-types.component");
var advantages_component_1 = require("./advantages/advantages.component");
var faq_component_1 = require("./faq/faq.component");
var project_service_component_1 = require("./project-service/project-service.component");
var design_service_component_1 = require("./design-service/design-service.component");
var building_service_component_1 = require("./building-service/building-service.component");
var rebuilding_component_1 = require("./rebuilding/rebuilding.component");
exports.poolsBuildingRoute = {
    path: 'pools-building',
    component: pools_building_component_1.PoolsBuildingComponent,
    children: [
        {
            path: 'types',
            component: pool_types_component_1.PoolTypesComponent
        },
        {
            path: 'advantages',
            component: advantages_component_1.AdvantagesComponent
        },
        {
            path: 'faq',
            component: faq_component_1.FaqComponent
        },
        {
            path: 'project',
            component: project_service_component_1.ProjectServiceComponent
        },
        {
            path: 'design',
            component: design_service_component_1.DesignServiceComponent
        },
        {
            path: 'building',
            component: building_service_component_1.BuildingServiceComponent
        },
        {
            path: 'rebuilding',
            component: rebuilding_component_1.RebuildingComponent
        },
        {
            path: 'seo',
            component: page_seo_component_1.PageSeoComponent
        },
    ],
};
//# sourceMappingURL=pools-building.routes.js.map