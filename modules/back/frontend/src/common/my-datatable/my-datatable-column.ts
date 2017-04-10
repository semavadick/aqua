import {MyDatatableEntity} from "./my-datatable-entity";

export class MyDatatableColumn {

    public attribute: string = null;

    public header: string;
    public headerCallback: {(entity: MyDatatableEntity): string} = null;

    public rawContent: boolean = false;
    public content: string = null;
    public contentCallback: {(entity: MyDatatableEntity): string} = null;

    public enableSorting: boolean = true;

    public getHeaderContent(entity: MyDatatableEntity): string {
        if(this.headerCallback) {
            return this.headerCallback(entity);
        }
        return this.header;
    }

    public getCellContent(entity: MyDatatableEntity): string {
        if(this.contentCallback) {
            return this.contentCallback(entity);
        }
        if(this.attribute) {
            return entity[this.attribute];
        }
        return this.content;
    }

}