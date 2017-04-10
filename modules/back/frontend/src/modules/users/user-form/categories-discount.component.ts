import { Component, Type, OnInit, ElementRef, ViewEncapsulation, ViewChild, Input, Output, EventEmitter } from '@angular/core';
import {Category} from "./category";
declare var $: any;

@Component({
    selector: 'categories-discount',
    templateUrl: './categories-discount.html',
    styleUrls: ['./categories-discount.css'],
    encapsulation: ViewEncapsulation.None,
})
export class CategoriesDiscountComponent implements OnInit {

    private tree: any = null;
    private rootCategory: Category;

    public constructor(private eRef: ElementRef) {
        this.rootCategory = new Category();
        this.rootCategory.id = -1;
        this.rootCategory.name = 'Начало';
    }

    public ngOnInit() {
        var $cont = $(this.eRef.nativeElement).find('.tree');

        $cont.on('click', '.jstree-anchor >.jstree-icon ', (event: Event) => {
            var node = this.tree.get_node($(event.target).closest('li')[0]);
            this.tree.toggle_node(node);
            return false;
        });

        var _that = this;
        $cont.editable({
            container: 'body',
            selector: '.leaf-discount',
            success: function(response: any, newValue: string) {
                var $linkCont = $(this);
                var category = _that.getCategoryById($linkCont.data('id'));
                if(!category) {
                    return;
                }
                category.discount = _that.getNormalizedValue(newValue);
            },
            display: function(newValue: string) {
                var value = _that.getNormalizedValue(newValue);
                var $linkCont = $(this);
                var label = value ? value + '%' : 'Нет';
                $linkCont.text(label);
            }
        });
    }

    private getNormalizedValue(value: string): number {
        var numbValue = Math.round(parseFloat(value) * 100) / 100;
        if(numbValue < 0) {
            numbValue = null;
        }
        if(numbValue > 100) {
            numbValue = 100;
        }
        if(numbValue == 0) {
            numbValue = null;
        }
        return numbValue;
    }

    public load(categories: Category[]) {
        if(this.tree) {
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
    }

    private getCategoryFromUserEvent(event: Event): Category {
        var id = $(event.target).closest('.leaf').data('id');
        return this.getCategoryById(id);
    }

    private getCategoryById(id: number): Category {
        if(id == this.rootCategory.id) {
            return null;
        }
        var findFromCategory = (category: Category, id: number): Category => {
            if(category.id == id) {
                return category;
            }
            for(let child of category.children) {
                var foundCategory = findFromCategory(child, id);
                if(foundCategory) {
                    return foundCategory;
                }
            }
            return null;
        };
        return findFromCategory(this.rootCategory, id);
    }

}


class TreeNode {

    id: number;
    text: string;
    state = {
        opened: true,
    };
    children: TreeNode[] = [];
    icon: boolean = false;

    public constructor(private category: Category) {
        this.id = category.id;
        var discountValue = category.discount ? category.discount + '' : '';
        var discountLabel = category.discount ? category.discount + '%' : 'Нет';
        var discount = `
            <a href="#" class="leaf-discount editable editable-click" data-id="${category.id}" data-value="${discountValue}" data-type="text">
                ${discountLabel}
            </a>
        `;
        if(!category.hasDiscount) {
            discount = '';
        }
        this.text = `
            <div class="leaf" data-id="${category.id}">
                <i class="icon-folder-plus"></i>
                <span class="leaf-name">${category.name}</span>
                ${discount}
            </div>
        `;

        for(let child of category.children) {
            this.children.push(new TreeNode(child));
        }
    }

}