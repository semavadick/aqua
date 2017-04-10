import {AdditionCategory as CatalogAdditionCategory} from "../../catalog/addition-categories/addition-category";

export class AdditionCategory extends CatalogAdditionCategory {

    public hasDiscount: boolean = false;
    public discount: number;
    public children: AdditionCategory[] = [];
}