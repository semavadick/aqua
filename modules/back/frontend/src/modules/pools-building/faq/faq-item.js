"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var crud_grid_entity_1 = require("../../../common/crud-grid/crud-grid-entity");
var FaqItem = (function (_super) {
    __extends(FaqItem, _super);
    function FaqItem() {
        _super.apply(this, arguments);
        this.question = '';
        this.answer = '';
    }
    return FaqItem;
}(crud_grid_entity_1.CrudGridEntity));
exports.FaqItem = FaqItem;
//# sourceMappingURL=faq-item.js.map