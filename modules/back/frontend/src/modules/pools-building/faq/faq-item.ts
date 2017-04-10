import {CrudGridEntity} from "../../../common/crud-grid/crud-grid-entity";

export class FaqItem extends CrudGridEntity {

    public id: number;
    public question: string = '';
    public answer: string = '';

}