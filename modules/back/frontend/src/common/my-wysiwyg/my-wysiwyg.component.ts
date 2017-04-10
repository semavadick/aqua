import { Component, Input, Output, Type, EventEmitter, ElementRef, OnInit, OnChanges, SimpleChange } from '@angular/core';
declare var tinymce: any;

@Component({
    selector: 'my-wysiwyg',
    template: `<div><textarea></textarea></div>`
})
export class MyWysiwygComponent implements OnInit, OnChanges {

    @Input()
    public value: string = "";

    @Input()
    public withGalleries: boolean = false;

    @Input()
    public withIncuts: boolean = false;

    @Output()
    public valueChange: EventEmitter<string> = new EventEmitter<string>();

    private editor: any;

    private static instCount: number = 0;
    private instNumber: number;

    constructor(private elem: ElementRef) {
        this.instNumber = MyWysiwygComponent.instCount;
        MyWysiwygComponent.instCount++;
    }

    public ngOnInit() {
        var additToolbar = "";
        var additPlugins = "";
        if(this.withGalleries) {
            additPlugins += ' insertGallery';
            additToolbar += ' insertGallery';
        }
        if(this.withIncuts) {
            additPlugins += ' incut';
            additToolbar += ' incut incut2';
        }
        additPlugins += ' insertAction jbimages';
        additToolbar += ' insertAction jbimages';
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
            setup: (editor: any) => {
                this.editor = editor;
                this.editor.on('init', (args: any) => {
                    setTimeout(() => {
                        this.editor.setContent(this.value);
                    }, 1000);
                });

                this.editor.on('change keyup', (e: any) => {
                    this.value = this.editor.getContent();
                    this.valueChange.emit(this.value);
                });
            }
        });
    }

    public ngOnChanges() {
        if(this.editor && this.editor.initialized) {
            this.editor.setContent(this.value);
        }
    }

}
