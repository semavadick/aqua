"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var category_1 = require("../../catalog/categories/category");
var Category = (function (_super) {
    __extends(Category, _super);
    function Category() {
        _super.apply(this, arguments);
        this.hasDiscount = false;
        this.children = [];
    }
    return Category;
}(category_1.Category));
exports.Category = Category;
//# sourceMappingURL=category.js.map