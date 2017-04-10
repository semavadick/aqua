import { Component, Type, OnInit, ElementRef, ViewEncapsulation, ViewChild, Input, Output, EventEmitter } from '@angular/core';
import {Category} from "../category";
declare var $: any;

@Component({
    selector: 'categories-tree',
    templateUrl: './categories-tree.html',
    styleUrls: ['./categories-tree.css'],
    encapsulation: ViewEncapsulation.None,
})
export class CategoriesTreeComponent implements OnInit {

    private tree: any = null;

    private rootCategory: Category;

    private selectedCategories: Category[] = [];

    @Input()
    public enableControls: boolean = false;

    @Input()
    public selectOnlyOneCategory: boolean = false;

    @Input()
    public enableSorting: boolean = false;

    @Output()
    public onSelect: EventEmitter<Category[]> = new EventEmitter<Category[]>();

    @Output()
    public onCreate: EventEmitter<Category> = new EventEmitter<Category>();

    @Output()
    public onUpdate: EventEmitter<Category> = new EventEmitter<Category>();

    @Output()
    public onDelete: EventEmitter<Category> = new EventEmitter<Category>();

    @Output()
    public onSort: EventEmitter<any> = new EventEmitter<any>();

    private sortBound: boolean = false;

    public constructor(private eRef: ElementRef) {
        this.rootCategory = new Category();
        this.rootCategory.id = -1;
        this.rootCategory.name = 'Начало';
    }

    public ngOnInit() {
        var $cont = $(this.eRef.nativeElement).find('.tree');

        $cont.on('click', '.leaf-name', (event: Event) => {
            var category = this.getCategoryFromUserEvent(event);
            if(!category) {
                return;
            }

            if(this.selectOnlyOneCategory) {
                $(this.eRef.nativeElement).find('.leaf').removeClass('active');
            }

            var selectedCategories = this.selectedCategories;
            var index = -1;
            var i = 0;
            for(let selectedCategory of selectedCategories) {
                if(selectedCategory.id == category.id) {
                    index = i;
                    break;
                }
                i++;
            }
            var $leaf = $(event.target).closest('.leaf');
            if(index >= 0) {
                selectedCategories.splice(index, 1);
                $leaf.removeClass('active');
            } else {
                if(this.selectOnlyOneCategory) {
                    selectedCategories = [];
                }
                selectedCategories.push(category);
                $leaf.addClass('active');
            }
            this.selectedCategories = selectedCategories;

            this.onSelect.emit(selectedCategories);
            return false;
        });

        $cont.on('click', '.leaf-controls__create', (event: Event) => {
            var category = this.getCategoryFromUserEvent(event);
            this.onCreate.emit(category);
            return false;
        });

        $cont.on('click', '.jstree-anchor >.jstree-icon ', (event: Event) => {
            var node = this.tree.get_node($(event.target).closest('li')[0]);
            this.tree.toggle_node(node);
            return false;
        });

        $cont.on('click', '.leaf-controls__update', (event: Event) => {
            var category = this.getCategoryFromUserEvent(event);
            this.onUpdate.emit(category);
            return false;
        });

        $cont.on('click', '.leaf-controls__delete', (event: Event) => {
            if(!confirm('Удалить категорию?')) {
                return false;
            }
            var category = this.getCategoryFromUserEvent(event);
            if(category) {
                this.onDelete.emit(category);
            }
            return false;
        });
    }

    private selectActiveNodes(node: TreeNode) {
        for(let category of this.selectedCategories) {
            if(category.id == node.id) {
                $(this.tree.get_node(node, true)).find(' > .jstree-anchor > .leaf').addClass('active');
            }
        }
        if(!node.children) {
            return;
        }
        for(let child of node.children) {
            this.selectActiveNodes(this.tree.get_node(child));
        }
    }

    public load(categories: Category[], selectedCategories: Category[]) {
        if(this.tree) {
            this.tree.destroy();
        }
        this.selectedCategories = selectedCategories;
        var $cont = $(this.eRef.nativeElement).find('.tree');
        this.rootCategory.children = categories;
        var root = new TreeNode(this.rootCategory, true, this.enableControls, selectedCategories);
        root.state.opened = true;
        var plugins: string[] = [];
        if(this.enableSorting) {
            plugins.push('dnd');
        }
        $cont.jstree({
            core: {
                data: [root],
                dblclick_toggle: false,
                check_callback: true
            },
            plugins: plugins
        });
        $cont.on('after_open.jstree', (e: any, data: any) => {
            this.selectActiveNodes(data.node);
        });

        $cont.on('ready.jstree', (e: any, data: any) => {
            this.selectActiveNodes(this.tree.get_node(this.rootCategory.id));
        });

        if(this.enableSorting && !this.sortBound) {
            this.sortBound = true;
            $(document).on('dnd_stop.vakata', (e: any, data: any) => {
                if($(data.data.obj.context).find('[aria-level="1"]').attr('id') != -1) {
                    return false;
                }


                var tree = this.tree;

                var node: TreeNode = tree.get_node(data.data.nodes[0]);
                var parent: TreeNode = tree.get_node(tree.get_parent(node));
                if((parent.id + '') == '#') {
                    return false;
                }

                var categories: Category[] = [];
                for(let childId of parent.children) {
                    var child: TreeNode = this.tree.get_node(childId);
                    categories.push(this.getCategoryById(child.id))
                }
                var parentCategory = this.getCategoryById(parent.id);
                this.onSort.emit({
                    categories: categories,
                    parent: parentCategory,
                });
            });
        }
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
        opened: false,
    };
    children: TreeNode[] = [];
    icon: boolean = false;

    public constructor(private category: Category, isRoot: boolean, enableControls: boolean, selectedCategories: Category[]) {
        this.id = category.id;
        var controls = `
            <button title="Добавить подкатегорию" type="button" class="btn bg-success btn-icon leaf-controls__create">
                <i class="icon-plus2"></i>
            </button>
        `;
        if(!isRoot) {
            controls += `
                <button title="Редактировать" type="button" class="btn bg-info-600 btn-icon leaf-controls__update">
                    <i class="icon-pen"></i>
                </button>
                <button title="Удалить" type="button" class="btn bg-warning-700 btn-icon leaf-controls__delete">
                    <i class="icon-trash"></i>
                </button>
            `;
        }
        if(!enableControls) {
            controls = '';
        }
        this.text = `
            <div class="leaf" data-id="${category.id}">
                <i class="icon-folder-plus"></i>
                <span class="leaf-name">${category.name}</span>
                <div class="leaf-controls">
                    ${controls}
                </div>
            </div>
        `;

        for(let selectedCategory of selectedCategories) {
            if(category.hasChild(selectedCategory)) {
                this.state.opened = true;
                break;
            }
        }

        for(let child of category.children) {
            this.children.push(new TreeNode(child, false, enableControls, selectedCategories));
        }
    }

}