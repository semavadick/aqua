"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var entity_form_1 = require("../entity-form");
var CrudGridEntityForm = (function (_super) {
    __extends(CrudGridEntityForm, _super);
    function CrudGridEntityForm() {
        _super.apply(this, arguments);
        this.entity = null;
    }
    CrudGridEntityForm.prototype.init = function (entity) {
        if (entity === void 0) { entity = null; }
        this.entity = entity;
        if (!entity) {
            return this.initLocally();
        }
        return this.initFromUrl(this.getBackendUrl() + '/' + entity.id);
    };
    CrudGridEntityForm.prototype.save = function () {
        var url = this.getBackendUrl();
        var isNewEntity = true;
        if (this.entity) {
            url += '/' + this.entity.id;
            isNewEntity = false;
        }
        return this.saveViaUrl(url, isNewEntity);
    };
    return CrudGridEntityForm;
}(entity_form_1.EntityForm));
exports.CrudGridEntityForm = CrudGridEntityForm;
//# sourceMappingURL=crud-grid-entity-form.js.map