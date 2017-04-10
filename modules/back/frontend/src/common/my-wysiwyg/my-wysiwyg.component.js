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
var MyWysiwygComponent = (function () {
    function MyWysiwygComponent(elem) {
        this.elem = elem;
        this.value = "";
        this.withGalleries = false;
        this.withIncuts = false;
        this.valueChange = new core_1.EventEmitter();
        this.instNumber = MyWysiwygComponent.instCount;
        MyWysiwygComponent.instCount++;
    }
    MyWysiwygComponent.prototype.ngOnInit = function () {
        var _this = this;
        var additToolbar = "";
        var additPlugins = "";
        if (this.withGalleries) {
            additPlugins += ' insertGallery';
            additToolbar += ' insertGallery';
        }
        if (this.withIncuts) {
            additPlugins += ' incut';
            additToolbar += ' incut incut2';
        }
        additPlugins += ' insertAction';
        additToolbar += ' insertAction';
        var textarea = this.elem.nativeElement.children[0].children[0];
        var id = 'my-wysiwyg-' + this.instNumber;
        textarea.setAttribute('id', id);
        tinymce.init({
            mode: "exact",
            elements: id,
            height: 300,
            language: 'ru',
            relative_urls: false,
            force_br_newlines: true,
            force_p_newlines: false,
            content_css: '/back-office/front-office/css/all.css',
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste code ' + additPlugins
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link media" + additToolbar,
            setup: function (editor) {
                _this.editor = editor;
                _this.editor.on('init', function (args) {
                    setTimeout(function () {
                        _this.editor.setContent(_this.value);
                    }, 1000);
                });
                _this.editor.on('change keyup', function (e) {
                    _this.value = _this.editor.getContent();
                    _this.valueChange.emit(_this.value);
                });
            }
        });
    };
    MyWysiwygComponent.prototype.ngOnChanges = function () {
        if (this.editor && this.editor.initialized) {
            this.editor.setContent(this.value);
        }
    };
    MyWysiwygComponent.instCount = 0;
    __decorate([
        core_1.Input(), 
        __metadata('design:type', String)
    ], MyWysiwygComponent.prototype, "value", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', Boolean)
    ], MyWysiwygComponent.prototype, "withGalleries", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', Boolean)
    ], MyWysiwygComponent.prototype, "withIncuts", void 0);
    __decorate([
        core_1.Output(), 
        __metadata('design:type', (typeof (_a = typeof core_1.EventEmitter !== 'undefined' && core_1.EventEmitter) === 'function' && _a) || Object)
    ], MyWysiwygComponent.prototype, "valueChange", void 0);
    MyWysiwygComponent = __decorate([
        core_1.Component({
            selector: 'my-wysiwyg',
            template: "<div><textarea></textarea></div>"
        }), 
        __metadata('design:paramtypes', [(typeof (_b = typeof core_1.ElementRef !== 'undefined' && core_1.ElementRef) === 'function' && _b) || Object])
    ], MyWysiwygComponent);
    return MyWysiwygComponent;
    var _a, _b;
}());
exports.MyWysiwygComponent = MyWysiwygComponent;
//# sourceMappingURL=my-wysiwyg.component.js.map