"use strict";
var MyDatatableSort = (function () {
    function MyDatatableSort() {
        this.attribute = '';
        this.direction = MyDatatableSort.SORT_DESC;
    }
    MyDatatableSort.prototype.getColumnClassName = function (column) {
        if (!column.enableSorting) {
            return null;
        }
        if (this.attribute != column.attribute) {
            return 'sorting';
        }
        return this.direction == MyDatatableSort.SORT_ASC ? 'sorting_asc' : 'sorting_desc';
    };
    MyDatatableSort.prototype.sortBy = function (column) {
        if (!column.enableSorting) {
            return;
        }
        if (column.attribute == this.attribute) {
            this.direction = this.direction == MyDatatableSort.SORT_DESC ? MyDatatableSort.SORT_ASC : MyDatatableSort.SORT_DESC;
            return;
        }
        this.attribute = column.attribute;
        this.direction = MyDatatableSort.SORT_DESC;
    };
    MyDatatableSort.SORT_ASC = 0;
    MyDatatableSort.SORT_DESC = 1;
    return MyDatatableSort;
}());
exports.MyDatatableSort = MyDatatableSort;
//# sourceMappingURL=my-datatable-sort.js.map