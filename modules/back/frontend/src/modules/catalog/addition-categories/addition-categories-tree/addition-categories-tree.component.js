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
var category_1 = require("../category");
var CategoriesTreeComponent = (function () {
    function CategoriesTreeComponent(eRef) {
        this.eRef = eRef;
        this.tree = null;
        this.selectedCategories = [];
        this.enableControls = false;
        this.selectOnlyOneCategory = false;
        this.enableSorting = false;
        this.onSelect = new core_1.EventEmitter();
        this.onCreate = new core_1.EventEmitter();
        this.onUpdate = new core_1.EventEmitter();
        this.onDelete = new core_1.EventEmitter();
        this.onSort = new core_1.EventEmitter();
        this.sortBound = false;
        this.rootCategory = new category_1.Category();
        this.rootCategory.id = -1;
        this.rootCategory.name = 'Начало';
    }
    CategoriesTreeComponent.prototype.ngOnInit = function () {
        var _this = this;
        var $cont = $(this.eRef.nativeElement).find('.tree');
        $cont.on('click', '.leaf-name', function (event) {
            var category = _this.getCategoryFromUserEvent(event);
            if (!category) {
                return;
            }
            if (_this.selectOnlyOneCategory) {
                $(_this.eRef.nativeElement).find('.leaf').removeClass('active');
            }
            var selectedCategories = _this.selectedCategories;
            var index = -1;
            var i = 0;
            for (var _i = 0, selectedCategories_1 = selectedCategories; _i < selectedCategories_1.length; _i++) {
                var selectedCategory = selectedCategories_1[_i];
                if (selectedCategory.id == category.id) {
                    index = i;
                    break;
                }
                i++;
            }
            var $leaf = $(event.target).closest('.leaf');
            if (index >= 0) {
                selectedCategories.splice(index, 1);
                $leaf.removeClass('active');
            }
            else {
                if (_this.selectOnlyOneCategory) {
                    selectedCategories = [];
                }
                selectedCategories.push(category);
                $leaf.addClass('active');
            }
            _this.selectedCategories = selectedCategories;
            _this.onSelect.emit(selectedCategories);
            return false;
        });
        $cont.on('click', '.leaf-controls__create', function (event) {
            var category = _this.getCategoryFromUserEvent(event);
            _this.onCreate.emit(category);
            return false;
        });
        $cont.on('click', '.jstree-anchor >.jstree-icon ', function (event) {
            var node = _this.tree.get_node($(event.target).closest('li')[0]);
            _this.tree.toggle_node(node);
            return false;
        });
        $cont.on('click', '.leaf-controls__update', function (event) {
            var category = _this.getCategoryFromUserEvent(event);
            _this.onUpdate.emit(category);
            return false;
        });
        $cont.on('click', '.leaf-controls__delete', function (event) {
            if (!confirm('Удалить категорию?')) {
                return false;
            }
            var category = _this.getCategoryFromUserEvent(event);
            if (category) {
                _this.onDelete.emit(category);
            }
            return false;
        });
    };
    CategoriesTreeComponent.prototype.selectActiveNodes = function (node) {
        for (var _i = 0, _a = this.selectedCategories; _i < _a.length; _i++) {
            var category = _a[_i];
            if (category.id == node.id) {
                $(this.tree.get_node(node, true)).find(' > .jstree-anchor > .leaf').addClass('active');
            }
        }
        if (!node.children) {
            return;
        }
        for (var _b = 0, _c = node.children; _b < _c.length; _b++) {
            var child = _c[_b];
            this.selectActiveNodes(this.tree.get_node(child));
        }
    };
    CategoriesTreeComponent.prototype.load = function (categories, selectedCategories) {
        var _this = this;
        if (this.tree) {
            this.tree.destroy();
        }
        this.selectedCategories = selectedCategories;
        var $cont = $(this.eRef.nativeElement).find('.tree');
        this.rootCategory.children = categories;
        var root = new TreeNode(this.rootCategory, true, this.enableControls, selectedCategories);
        root.state.opened = true;
        var plugins = [];
        if (this.enableSorting) {
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
        $cont.on('after_open.jstree', function (e, data) {
            _this.selectActiveNodes(data.node);
        });
        $cont.on('ready.jstree', function (e, data) {
            _this.selectActiveNodes(_this.tree.get_node(_this.rootCategory.id));
        });
        if (this.enableSorting && !this.sortBound) {
            this.sortBound = true;
            $(document).on('dnd_stop.vakata', function (e, data) {
                var tree = _this.tree;
                var node = tree.get_node(data.data.nodes[0]);
                var parent = tree.get_node(tree.get_parent(node));
                if ((parent.id + '') == '#') {
                    return false;
                }
                var categories = [];
                for (var _i = 0, _a = parent.children; _i < _a.length; _i++) {
                    var childId = _a[_i];
                    var child = _this.tree.get_node(childId);
                    categories.push(_this.getCategoryById(child.id));
                }
                var parentCategory = _this.getCategoryById(parent.id);
                _this.onSort.emit({
                    categories: categories,
                    parent: parentCategory,
                });
            });
        }
        this.tree = $cont.jstree(true);
    };
    CategoriesTreeComponent.prototype.getCategoryFromUserEvent = function (event) {
        var id = $(event.target).closest('.leaf').data('id');
        return this.getCategoryById(id);
    };
    CategoriesTreeComponent.prototype.getCategoryById = function (id) {
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
    __decorate([
        core_1.Input(), 
        __metadata('design:type', Boolean)
    ], CategoriesTreeComponent.prototype, "enableControls", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', Boolean)
    ], CategoriesTreeComponent.prototype, "selectOnlyOneCategory", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', Boolean)
    ], CategoriesTreeComponent.prototype, "enableSorting", void 0);
    __decorate([
        core_1.Output(), 
        __metadata('design:type', (typeof (_a = typeof core_1.EventEmitter !== 'undefined' && core_1.EventEmitter) === 'function' && _a) || Object)
    ], CategoriesTreeComponent.prototype, "onSelect", void 0);
    __decorate([
        core_1.Output(), 
        __metadata('design:type', (typeof (_b = typeof core_1.EventEmitter !== 'undefined' && core_1.EventEmitter) === 'function' && _b) || Object)
    ], CategoriesTreeComponent.prototype, "onCreate", void 0);
    __decorate([
        core_1.Output(), 
        __metadata('design:type', (typeof (_c = typeof core_1.EventEmitter !== 'undefined' && core_1.EventEmitter) === 'function' && _c) || Object)
    ], CategoriesTreeComponent.prototype, "onUpdate", void 0);
    __decorate([
        core_1.Output(), 
        __metadata('design:type', (typeof (_d = typeof core_1.EventEmitter !== 'undefined' && core_1.EventEmitter) === 'function' && _d) || Object)
    ], CategoriesTreeComponent.prototype, "onDelete", void 0);
    __decorate([
        core_1.Output(), 
        __metadata('design:type', (typeof (_e = typeof core_1.EventEmitter !== 'undefined' && core_1.EventEmitter) === 'function' && _e) || Object)
    ], CategoriesTreeComponent.prototype, "onSort", void 0);
    CategoriesTreeComponent = __decorate([
        core_1.Component({
            selector: 'categories-tree',
            templateUrl: './categories-tree.html',
            styleUrls: ['./categories-tree.css'],
            encapsulation: core_1.ViewEncapsulation.None,
        }), 
        __metadata('design:paramtypes', [(typeof (_f = typeof core_1.ElementRef !== 'undefined' && core_1.ElementRef) === 'function' && _f) || Object])
    ], CategoriesTreeComponent);
    return CategoriesTreeComponent;
    var _a, _b, _c, _d, _e, _f;
}());
exports.CategoriesTreeComponent = CategoriesTreeComponent;
var TreeNode = (function () {
    function TreeNode(category, isRoot, enableControls, selectedCategories) {
        this.category = category;
        this.state = {
            opened: false,
        };
        this.children = [];
        this.icon = false;
        this.id = category.id;
        var controls = "\n            <button title=\"\u0414\u043E\u0431\u0430\u0432\u0438\u0442\u044C \u043F\u043E\u0434\u043A\u0430\u0442\u0435\u0433\u043E\u0440\u0438\u044E\" type=\"button\" class=\"btn bg-success btn-icon leaf-controls__create\">\n                <i class=\"icon-plus2\"></i>\n            </button>\n        ";
        if (!isRoot) {
            controls += "\n                <button title=\"\u0420\u0435\u0434\u0430\u043A\u0442\u0438\u0440\u043E\u0432\u0430\u0442\u044C\" type=\"button\" class=\"btn bg-info-600 btn-icon leaf-controls__update\">\n                    <i class=\"icon-pen\"></i>\n                </button>\n                <button title=\"\u0423\u0434\u0430\u043B\u0438\u0442\u044C\" type=\"button\" class=\"btn bg-warning-700 btn-icon leaf-controls__delete\">\n                    <i class=\"icon-trash\"></i>\n                </button>\n            ";
        }
        if (!enableControls) {
            controls = '';
        }
        this.text = "\n            <div class=\"leaf\" data-id=\"" + category.id + "\">\n                <i class=\"icon-folder-plus\"></i>\n                <span class=\"leaf-name\">" + category.name + "</span>\n                <div class=\"leaf-controls\">\n                    " + controls + "\n                </div>\n            </div>\n        ";
        for (var _i = 0, selectedCategories_2 = selectedCategories; _i < selectedCategories_2.length; _i++) {
            var selectedCategory = selectedCategories_2[_i];
            if (category.hasChild(selectedCategory)) {
                this.state.opened = true;
                break;
            }
        }
        for (var _a = 0, _b = category.children; _a < _b.length; _a++) {
            var child = _b[_a];
            this.children.push(new TreeNode(child, false, enableControls, selectedCategories));
        }
    }
    return TreeNode;
}());
//# sourceMappingURL=categories-tree.component.js.map