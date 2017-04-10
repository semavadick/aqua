
export class MyDatatablePagination {

    public limit: number = 50;
    public currentPage: number = 1;
    public total: number = 0;

    public getOffset(): number {
        return (this.currentPage - 1) * this.limit;
    }

    public getPagesCount(): number {
        return Math.ceil(this.total / this.limit);
    }

    public hasMoreThanOnePage(): boolean {
        return parseInt(this.getPagesCount()) > 1;
    }

    public isOnFirstPage() {
        return this.currentPage == 1;
    }

    public isOnLastPage() {
        return this.currentPage == this.getPagesCount();
    }

    public getPageNumbersForSelect(): number[] {
        var curPage = this.currentPage;
        var pagesCount = this.getPagesCount();
        var start = curPage;
        if(start > 1) {
            start--;
        }
        if((start + 1) >= pagesCount && start > 1) {
            start--;
        }
        var nums: number[] = [];
        for(var i = 0; i < 3; i++) {
            if(start > pagesCount) {
                break;
            }
            nums.push(start);
            start++;
        }
        return nums;
    }

    public getShownOffset(): number {
        var val = this.getOffset() + this.limit;
        if(val > this.total) {
            val = this.total;
        }
        return val;
    }

}