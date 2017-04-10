"use strict";
var Category = (function () {
    function Category() {
        this.children = [];
    }
    Category.prototype.hasChild = function (child) {
        for (var _i = 0, _a = this.children; _i < _a.length; _i++) {
            var category = _a[_i];
            if (category.id == child.id) {
                return true;
            }
            for (var _b = 0, _c = category.children; _b < _c.length; _b++) {
                var categoryChild = _c[_b];
                if (categoryChild.hasChild(child)) {
                    return true;
                }
            }
        }
        return false;
    };
    return Category;
}());
exports.Category = Category;
//# sourceMappingURL=category.js.map