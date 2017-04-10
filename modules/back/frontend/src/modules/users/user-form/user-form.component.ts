import {Component, Type, Input, ViewChild} from '@angular/core';
import {UserForm} from "./user-form";
import {FormGroupComponent} from "../../../common/form-group/form-group.component";
import {CategoriesDiscountComponent} from "./categories-discount.component";
import {AdditionCategoriesDiscountComponent} from "./addition-categories-discount.component";

@Component({
    selector: 'user-form',
    templateUrl: './user-form.html',
    directives: [
        <Type>FormGroupComponent,
        <Type>CategoriesDiscountComponent,
        <Type>AdditionCategoriesDiscountComponent,
    ],

})
export class UserFormComponent {

    @Input()
    public form: UserForm;

    @ViewChild(<Type>CategoriesDiscountComponent, undefined)
    public discountComponent: CategoriesDiscountComponent;

    @ViewChild(<Type>AdditionCategoriesDiscountComponent, undefined)
    public additionDiscountComponent: AdditionCategoriesDiscountComponent;

    public formInitialized() {
        this.discountComponent.load(this.form.discountCategories);
        this.additionDiscountComponent.load(this.form.discountAdditionCategories);
    }
}