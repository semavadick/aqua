"use strict";
var crud_grid_entity_1 = require("./crud-grid-entity");
var CrudGridEntityManager = (function () {
    function CrudGridEntityManager() {
        this.isLoading = false;
    }
    CrudGridEntityManager.prototype.loadEntities = function () {
        var _this = this;
        this.isLoading = true;
        this.getBackend().get(this.getBackendUrl())
            .then(function (resp) {
            _this.entities = [];
            for (var _i = 0, _a = resp.json(); _i < _a.length; _i++) {
                var entityData = _a[_i];
                var entity = new crud_grid_entity_1.CrudGridEntity();
                Object.assign(entity, entityData);
                _this.entities.push(entity);
            }
            _this.isLoading = false;
        })
            .catch(function (resp) {
            alert(resp.text());
        });
    };
    CrudGridEntityManager.prototype.deleteEntity = function (entity) {
        var _this = this;
        this.isLoading = true;
        var url = this.getBackendUrl() + '/' + entity.id;
        this.getBackend().delete(url)
            .then(function (resp) {
            _this.isLoading = false;
            _this.loadEntities();
        })
            .catch(function (resp) {
            alert(resp.text());
        });
    };
    return CrudGridEntityManager;
}());
exports.CrudGridEntityManager = CrudGridEntityManager;
//# sourceMappingURL=crud-grid-entity-manager.js.map