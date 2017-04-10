import { Component, Input, Output, Type, EventEmitter, OnInit, ElementRef, ViewEncapsulation } from '@angular/core';
declare var $: any;

@Component({
    selector: 'multi-select',
    template: `
        <select multiple class="form-control">
            <option
                *ngFor="let item of items"
                [attr.value]="item.id"
                [attr.selected]="itemIsSelected(item) ? true : null"
            >
                {{ item.name }}
            </option>
        </select>

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
})
export class MultiSelect implements OnInit {

    @Input()
    public value: any[];

    @Output()
    public valueChange: EventEmitter<any> = new EventEmitter<any>();

    @Input()
    public items: any[] = [];

    public constructor(private eRef: ElementRef) { }

    public setValue(value: any) {
        this.value = value;
        this.valueChange.emit(value);
    }

    public itemIsSelected(item: any) {
        return this.value.indexOf(item.id) >= 0;
    }

    ngOnInit() {
        var $select: any = $(this.eRef.nativeElement.querySelector('select'));
        $select.select2({
            width: '700px',
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
            this.setValue(actVals);
        });
    }

}
