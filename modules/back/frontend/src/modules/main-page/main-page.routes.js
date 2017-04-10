"use strict";
var slides_component_1 = require("./slides/slides.component");
var main_page_component_1 = require("./main-page.component");
var banners_component_1 = require("./banners/banners.component");
var page_about_component_1 = require("./page-about/page-about.component");
var page_content_component_1 = require("./page-content/page-content.component");
exports.mainPageRoute = {
    path: 'main-page',
    component: main_page_component_1.MainPageComponent,
    children: [
        {
            path: 'slides',
            component: slides_component_1.SlidesComponent
        },
        {
            path: 'banners',
            component: banners_component_1.BannersComponent
        },
        {
            path: 'about',
            component: page_about_component_1.PageAboutComponent
        },
        {
            path: 'general',
            component: page_content_component_1.PageContentComponent
        },
    ],
};
//# sourceMappingURL=main-page.routes.js.map