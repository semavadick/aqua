import {Category as CatalogCategory} from "../../catalog/categories/category";

export class Category extends CatalogCategory {

    public hasDiscount: boolean = false;
    public discount: number;
    public children: Category[] = [];
}