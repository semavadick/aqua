"use strict";
var MyDatatableColumn = (function () {
    function MyDatatableColumn() {
        this.attribute = null;
        this.headerCallback = null;
        this.rawContent = false;
        this.content = null;
        this.contentCallback = null;
        this.enableSorting = true;
    }
    MyDatatableColumn.prototype.getHeaderContent = function (entity) {
        if (this.headerCallback) {
            return this.headerCallback(entity);
        }
        return this.header;
    };
    MyDatatableColumn.prototype.getCellContent = function (entity) {
        if (this.contentCallback) {
            return this.contentCallback(entity);
        }
        if (this.attribute) {
            return entity[this.attribute];
        }
        return this.content;
    };
    return MyDatatableColumn;
}());
exports.MyDatatableColumn = MyDatatableColumn;
//# sourceMappingURL=my-datatable-column.js.map