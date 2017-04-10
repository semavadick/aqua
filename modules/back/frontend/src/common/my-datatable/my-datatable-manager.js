"use strict";
var MyDatatableManager = (function () {
    function MyDatatableManager() {
        this.isLoading = false;
        this.entities = [];
        this.pagination = null;
        this.sort = null;
        this.searchForm = null;
    }
    MyDatatableManager.prototype.setPagination = function (pagination) {
        this.pagination = pagination;
    };
    MyDatatableManager.prototype.setSort = function (sort) {
        this.sort = sort;
    };
    MyDatatableManager.prototype.setSearchForm = function (form) {
        this.searchForm = form;
    };
    MyDatatableManager.prototype.loadEntities = function () {
        var _this = this;
        this.isLoading = true;
        var pagination = this.pagination;
        var sort = this.sort;
        var url = this.getBackendUrl();
        url += '/' + pagination.getOffset() + '-' + pagination.limit;
        url += '/' + sort.attribute + '-' + sort.direction;
        if (this.searchForm) {
            url += '/' + JSON.stringify(this.searchForm.getAttributes());
        }
        this.getBackend().get(url)
            .then(function (resp) {
            var data = resp.json();
            _this.entities = [];
            for (var _i = 0, _a = data['entities']; _i < _a.length; _i++) {
                var entityData = _a[_i];
                _this.entities.push(_this.getEntityFromData(entityData));
            }
            _this.pagination.total = data['total'];
            _this.isLoading = false;
        })
            .catch(function (resp) {
            alert(resp.text());
        });
    };
    MyDatatableManager.prototype.deleteEntity = function (entity) {
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
    return MyDatatableManager;
}());
exports.MyDatatableManager = MyDatatableManager;
//# sourceMappingURL=my-datatable-manager.js.map