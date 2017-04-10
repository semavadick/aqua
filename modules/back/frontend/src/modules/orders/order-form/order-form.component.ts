import {Component, Type, Input, ViewChild} from '@angular/core';
import {OrderForm} from "./order-form";
import {FormGroupComponent} from "../../../common/form-group/form-group.component";
import {OrderProduct} from "../order-product";
import {OrderAdditionProduct} from "../order-addition-product";

@Component({
    selector: 'order-form',
    templateUrl: './order-form.html',
    directives: [
        <Type>FormGroupComponent,
    ],

})
export class OrderFormComponent {

    @Input()
    public form: OrderForm;

    public deleteProduct(orderProduct: OrderProduct) {
        if(confirm('Удалить товар?')) {
            var index = this.form.orderProducts.indexOf(orderProduct);
            this.form.orderProducts.splice(index, 1);
        }
    }

    public deleteAdditionProduct(orderAdditionProduct: OrderAdditionProduct) {
        if(confirm('Удалить товар?')) {
            var index = this.form.orderAdditionProducts.indexOf(orderAdditionProduct);
            this.form.orderAdditionProducts.splice(index, 1);
        }
    }
    
}