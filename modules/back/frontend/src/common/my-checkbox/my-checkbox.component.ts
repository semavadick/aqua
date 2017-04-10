import { Component, Input, Output, Type, EventEmitter } from '@angular/core';

@Component({
    selector: 'my-checkbox',
    template: `
            <div class="checkbox" style="margin-left: 10px">
                <label>
                    <div class="checker border-primary-600 text-primary-800">
                        <span [class.checked]="value">
                            <input type="checkbox" class="control-primary" [ngModel]="value" (ngModelChange)="valueChange.emit($event)">
                        </span>
                    </div>
                    {{ label }}
                </label>
            </div>
            `
})
export class MyCheckbox {

    @Input()
    public value: boolean = false;

    @Output()
    public valueChange: EventEmitter<boolean> = new EventEmitter<boolean>();

    @Input()
    public label: string = "";

}
