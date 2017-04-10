"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
var core_1 = require('@angular/core');
var form_group_component_1 = require("../../../../common/form-group/form-group.component");
var product_form_1 = require("./product-form");
var RelatedProductsComponent = (function () {
    function RelatedProductsComponent(eRef) {
        this.eRef = eRef;
    }
    RelatedProductsComponent.prototype.ngOnInit = function () {
        var _this = this;
        var $select = $(this.eRef.nativeElement.querySelector('select'));
        var formatProduct = function (item) {
            if (_this.form.relatedProductsIds.indexOf(item.id) !== -1) {
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
                transport: function (params, success, failure) {
                    _this.form.loadRelatedProducts(params.data.term)
                        .then(function (products) {
                        success(products);
                    });
                },
                data: function (params) {
                    return {
                        term: params.term
                    };
                },
                processResults: function (products) {
                    var results = [];
                    for (var _i = 0, products_1 = products; _i < products_1.length; _i++) {
                        var product = products_1[_i];
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
        $select.on('change', function () {
            var values = $select.select2('val');
            if (values === null) {
                values = [];
            }
            var actVals = [];
            for (var _i = 0, values_1 = values; _i < values_1.length; _i++) {
                var val = values_1[_i];
                actVals.push(val - 0);
            }
            _this.form.relatedProductsIds = actVals;
        });
    };
    RelatedProductsComponent.prototype.productIsSelected = function (product) {
        return this.form.relatedProductsIds.indexOf(product.id) >= 0;
    };
    __decorate([
        core_1.Input(), 
        __metadata('design:type', product_form_1.ProductForm)
    ], RelatedProductsComponent.prototype, "form", void 0);
    RelatedProductsComponent = __decorate([
        core_1.Component({
            selector: 'related-products',
            template: "\n        <form-group [form]=\"form\" attribute=\"relatedProductsIds\" label=\"\u0421\u0432\u044F\u0437\u0438 \u0441 \u0442\u043E\u0432\u0430\u0440\u0430\u043C\u0438\">\n            <select multiple class=\"form-control\">\n                <option\n                        *ngFor=\"let product of form.relatedProducts\"\n                        [attr.value]=\"product.id\"\n                        [attr.selected]=\"productIsSelected(product) ? true : null\"\n                >\n                    {{ product.name }}\n                </option>\n            </select>\n        </form-group>\n\n        <style>\n            body > .select2-container {\n                z-index: 66000;\n            }\n            .select2-container--default.select2-container--focus .select2-selection--multiple {\n                border: 1px solid #ddd;\n            }\n            .select2-container--default .select2-selection--multiple .select2-selection__choice {\n                background-color: #45adde;\n                border: 1px solid #45adde;\n                padding: 2px 5px;\n            }\n            .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {\n                color: #fff !important;\n                margin-top: 2px;\n            }\n        </style>\n    ",
            encapsulation: core_1.ViewEncapsulation.None,
            directives: [
                form_group_component_1.FormGroupComponent,
            ]
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof core_1.ElementRef !== 'undefined' && core_1.ElementRef) === 'function' && _a) || Object])
    ], RelatedProductsComponent);
    return RelatedProductsComponent;
    var _a;
}());
exports.RelatedProductsComponent = RelatedProductsComponent;
//# sourceMappingURL=related-products.component.js.map