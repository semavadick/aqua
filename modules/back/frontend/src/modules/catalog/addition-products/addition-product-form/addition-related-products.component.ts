import { Component, Input, Type, OnInit, ElementRef, ViewEncapsulation} from '@angular/core';
import {FormGroupComponent} from "../../../../common/form-group/form-group.component";
import {AdditionProductForm} from "./addition-product-form";
import {AdditionProduct} from "../addition-product";
import {Product} from "../../products/product";
declare var $: any;

@Component({
    selector: 'related-addition-products',
    template: `
        <form-group [form]="form" attribute="relatedProductsIds" label="Связи с товарами">
            <select multiple class="form-control">
                <option
                        *ngFor="let product of form.relatedProducts"
                        [attr.value]="product.id"
                        [attr.type]="product.type"
                        [attr.selected]="productIsSelected(product) ? true : null"
                >
                    {{ product.name }}
                </option>
            </select>
        </form-group>

        <style>
            body > .select2-container {
                z-index: 66000;
            }
            .select2-container--default.select2-container--focus .select2-selection--multiple {
                border: 1px solid #ddd;
            }
            .select2-container--default .select2-selection--multiple .select2-selection__choice {
                background-color: #45adde;
                border: 1px solid #45adde;
                padding: 2px 5px;
            }
            .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
                color: #fff !important;
                margin-top: 2px;
            }
        </style>
    `,
    encapsulation: ViewEncapsulation.None,
    directives: [
        <Type>FormGroupComponent,
    ]
})
export class AdditionRelatedProductsComponent implements OnInit {

    @Input()
    public form: AdditionProductForm;

    public constructor(private eRef: ElementRef) {}

    public ngOnInit() {
        var $select: any = $(this.eRef.nativeElement.querySelector('select'));

        var formatProduct: any = (item: any) => {
            if(item.type != 1) {
                if(this.form.relatedProductsIds.indexOf(item.id) !== -1) {
                    return null;
                }
            } else {
                if(this.form.relatedAdditionProductsIds.indexOf(item.id) !== -1) {
                    return null;
                }
            }
            return item.text;
        };

        $select.select2({
            width: '700px',
            placeholder: 'Введите название товара',
            minimumInputLength: 3,
            ajax: {
                url: '/#test-url',
                delay: 250,
                type: "GET",
                dataType: 'json',
                transport: (params: any, success: any, failure: any) => {
                    this.form.loadRelatedProducts(params.data.term)
                        .then((products) => {
                            success(products);
                        });
                },
                data: (params: any) => {
                    return {
                        term: params.term
                    };
                },
                processResults: (products) => {
                    var results: any = [];
                    for(let product of products) {
                        results.push({
                            id: product.id,
                            text: product.name,
                            type: product.type
                        });
                    }
                    return {
                        results: results
                    };
                }
            },
            templateResult: formatProduct
        });

        $select.on('change', () => {
            var values: any = $select.select2('data');
            if(values === null || values.length < 1) {
                values = [];
            }
            var actVals: number[] = [];
            var actAdditionVals: number[] = [];
            for(let val of values) {
                if($(val.element).attr('type') != 1) {
                    actVals.push(parseInt($(val.element).attr('value')));
                } else {
                    actAdditionVals.push(parseInt($(val.element).attr('value')));
                }
            }
            this.form.relatedProductsIds = actVals;
            this.form.relatedAdditionProductsIds = actAdditionVals;
        });

    }

    public productIsSelected(product) {
        if(product.type != 1) {
            return this.form.relatedProductsIds.indexOf(product.id) >= 0;
        } else {
            return this.form.relatedAdditionProductsIds.indexOf(product.id) >= 0;
        }
    }

}
