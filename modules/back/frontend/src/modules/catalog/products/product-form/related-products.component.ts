import { Component, Input, Type, OnInit, ElementRef, ViewEncapsulation} from '@angular/core';
import {FormGroupComponent} from "../../../../common/form-group/form-group.component";
import {ProductForm} from "./product-form";
import {Product} from "../product";
declare var $: any;

@Component({
    selector: 'related-products',
    template: `
        <form-group [form]="form" attribute="relatedProductsIds" label="Связи с товарами">
            <select multiple class="form-control">
                <option
                        *ngFor="let product of form.relatedProducts"
                        [attr.value]="product.id"
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
export class RelatedProductsComponent implements OnInit {

    @Input()
    public form: ProductForm;

    public constructor(private eRef: ElementRef) {}

    public ngOnInit() {
        var $select: any = $(this.eRef.nativeElement.querySelector('select'));

        var formatProduct: any = (item: any) => {
            if(this.form.relatedProductsIds.indexOf(item.id) !== -1) {
                return null;
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
                        .then((products: Product[]) => {
                            success(products);
                        });
                },
                data: (params: any) => {
                    return {
                        term: params.term
                    };
                },
                processResults: (products: Product[]) => {
                    var results: any = [];
                    for(let product of products) {
                        results.push({
                            id: product.id,
                            text: product.name,
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
            var values: any = $select.select2('val');
            if(values === null) {
                values = [];
            }
            var actVals: number[] = [];
            for(let val of values) {
                actVals.push(val - 0);
            }
            this.form.relatedProductsIds = actVals;
        });

    }

    public productIsSelected(product: Product) {
        return this.form.relatedProductsIds.indexOf(product.id) >= 0;
    }

}
