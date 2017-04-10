"use strict";
var MenuItem = (function () {
    function MenuItem(name, route, icon) {
        if (route === void 0) { route = null; }
        if (icon === void 0) { icon = null; }
        this.name = name;
        this.route = route;
        this.icon = icon;
        this.children = [];
        this.isActive = false;
        this.isOpened = false;
    }
    return MenuItem;
}());
exports.MenuItem = MenuItem;
//# sourceMappingURL=menu-item.js.map