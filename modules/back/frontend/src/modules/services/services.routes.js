"use strict";
var services_component_1 = require("./services.component");
var maintenance_component_1 = require("./maintenance/maintenance.component");
var exclusive_component_1 = require("./exclusive/exclusive.component");
exports.servicesRoute = {
    path: 'services',
    component: services_component_1.ServicesComponent,
    children: [
        {
            path: 'maintenance',
            component: maintenance_component_1.MaintenanceComponent
        },
        {
            path: 'exclusive',
            component: exclusive_component_1.ExclusiveComponent
        },
    ],
};
//# sourceMappingURL=services.routes.js.map