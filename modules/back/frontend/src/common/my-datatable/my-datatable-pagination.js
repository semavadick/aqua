"use strict";
var MyDatatablePagination = (function () {
    function MyDatatablePagination() {
        this.limit = 50;
        this.currentPage = 1;
        this.total = 0;
    }
    MyDatatablePagination.prototype.getOffset = function () {
        return (this.currentPage - 1) * this.limit;
    };
    MyDatatablePagination.prototype.getPagesCount = function () {
        return Math.ceil(this.total / this.limit);
    };
    MyDatatablePagination.prototype.hasMoreThanOnePage = function () {
        return Math.ceil(this.total / this.limit) > 1;
    };
    MyDatatablePagination.prototype.isOnFirstPage = function () {
        return this.currentPage == 1;
    };
    MyDatatablePagination.prototype.isOnLastPage = function () {
        return this.currentPage == this.getPagesCount();
    };
    MyDatatablePagination.prototype.getPageNumbersForSelect = function () {
        var curPage = this.currentPage;
        var pagesCount = this.getPagesCount();
        var start = curPage;
        if (start > 1) {
            start--;
        }
        if ((start + 1) >= pagesCount && start > 1) {
            start--;
        }
        var nums = [];
        for (var i = 0; i < 3; i++) {
            if (start > pagesCount) {
                break;
            }
            nums.push(start);
            start++;
        }
        return nums;
    };
    MyDatatablePagination.prototype.getShownOffset = function () {
        var val = this.getOffset() + this.limit;
        if (val > this.total) {
            val = this.total;
        }
        return val;
    };
    return MyDatatablePagination;
}());
exports.MyDatatablePagination = MyDatatablePagination;
//# sourceMappingURL=my-datatable-pagination.js.map