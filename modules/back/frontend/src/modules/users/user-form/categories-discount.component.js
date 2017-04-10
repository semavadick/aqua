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
var category_1 = require("./category");
var CategoriesDiscountComponent = (function () {
    function CategoriesDiscountComponent(eRef) {
        this.eRef = eRef;
        this.tree = null;
        this.rootCategory = new category_1.Category();
        this.rootCategory.id = -1;
        this.rootCategory.name = 'Начало';
    }
    CategoriesDiscountComponent.prototype.ngOnInit = function () {
        var _this = this;
        var $cont = $(this.eRef.nativeElement).find('.tree');
        $cont.on('click', '.jstree-anchor >.jstree-icon ', function (event) {
            var node = _this.tree.get_node($(event.target).closest('li')[0]);
            _this.tree.toggle_node(node);
            return false;
        });
        var _that = this;
        $cont.editable({
            container: 'body',
            selector: '.leaf-discount',
            success: function (response, newValue) {
                var $linkCont = $(this);
                var category = _that.getCategoryById($linkCont.data('id'));
                if (!category) {
                    return;
                }
                category.discount = _that.getNormalizedValue(newValue);
            },
            display: function (newValue) {
                var value = _that.getNormalizedValue(newValue);
                var $linkCont = $(this);
                var label = value ? value + '%' : 'Нет';
                $linkCont.text(label);
            }
        });
    };
    CategoriesDiscountComponent.prototype.getNormalizedValue = function (value) {
        var numbValue = Math.round(parseFloat(value) * 100) / 100;
        if (numbValue < 0) {
            numbValue = null;
        }
        if (numbValue > 100) {
            numbValue = 100;
        }
        if (numbValue == 0) {
            numbValue = null;
        }
        return numbValue;
    };
    CategoriesDiscountComponent.prototype.load = function (categories) {
        if (this.tree) {
            this.tree.destroy();
        }
        var $cont = $(this.eRef.nativeElement).find('.tree');
        this.rootCategory.children = categories;
        var root = new TreeNode(this.rootCategory);
        $cont.jstree({
            core: {
                data: [root],
                dblclick_toggle: false,
            },
        });
        this.tree = $cont.jstree(true);
    };
    CategoriesDiscountComponent.prototype.getCategoryFromUserEvent = function (event) {
        var id = $(event.target).closest('.leaf').data('id');
        return this.getCategoryById(id);
    };
    CategoriesDiscountComponent.prototype.getCategoryById = function (id) {
        if (id == this.rootCategory.id) {
            return null;
        }
        var findFromCategory = function (category, id) {
            if (category.id == id) {
                return category;
            }
            for (var _i = 0, _a = category.children; _i < _a.length; _i++) {
                var child = _a[_i];
                var foundCategory = findFromCategory(child, id);
                if (foundCategory) {
                    return foundCategory;
                }
            }
            return null;
        };
        return findFromCategory(this.rootCategory, id);
    };
    CategoriesDiscountComponent = __decorate([
        core_1.Component({
            selector: 'categories-discount',
            templateUrl: './categories-discount.html',
            styleUrls: ['./categories-discount.css'],
            encapsulation: core_1.ViewEncapsulation.None,
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof core_1.ElementRef !== 'undefined' && core_1.ElementRef) === 'function' && _a) || Object])
    ], CategoriesDiscountComponent);
    return CategoriesDiscountComponent;
    var _a;
}());
exports.CategoriesDiscountComponent = CategoriesDiscountComponent;
var TreeNode = (function () {
    function TreeNode(category) {
        this.category = category;
        this.state = {
            opened: true,
        };
        this.children = [];
        this.icon = false;
        this.id = category.id;
        var discountValue = category.discount ? category.discount + '' : '';
        var discountLabel = category.discount ? category.discount + '%' : 'Нет';
        var discount = "\n            <a href=\"#\" class=\"leaf-discount editable editable-click\" data-id=\"" + category.id + "\" data-value=\"" + discountValue + "\" data-type=\"text\">\n                " + discountLabel + "\n            </a>\n        ";
        if (!category.hasDiscount) {
            discount = '';
        }
        this.text = "\n            <div class=\"leaf\" data-id=\"" + category.id + "\">\n                <i class=\"icon-folder-plus\"></i>\n                <span class=\"leaf-name\">" + category.name + "</span>\n                " + discount + "\n            </div>\n        ";
        for (var _i = 0, _a = category.children; _i < _a.length; _i++) {
            var child = _a[_i];
            this.children.push(new TreeNode(child));
        }
    }
    return TreeNode;
}());
//# sourceMappingURL=categories-discount.component.js.map