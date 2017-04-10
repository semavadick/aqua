import {MyDatatableColumn} from "./my-datatable-column";

export class MyDatatableSort {

    public static SORT_ASC = 0;
    public static SORT_DESC = 1;

    public attribute: string = '';
    public direction: number = MyDatatableSort.SORT_ASC;

    public getColumnClassName(column: MyDatatableColumn): string {
        if(!column.enableSorting) {
            return null;
        }
        if(this.attribute != column.attribute) {
            return 'sorting';
        }
        return this.direction == MyDatatableSort.SORT_ASC ? 'sorting_asc' : 'sorting_desc';
    }

    public sortBy(column: MyDatatableColumn) {
        if(!column.enableSorting) {
            return;
        }
        if(column.attribute == this.attribute) {
            this.direction = this.direction == MyDatatableSort.SORT_DESC ? MyDatatableSort.SORT_ASC : MyDatatableSort.SORT_DESC;
            return;
        }
        this.attribute = column.attribute;
        this.direction = MyDatatableSort.SORT_DESC;
    }
}