import { Component, Input, Output, EventEmitter, OnInit, OnChanges, ElementRef } from '@angular/core';
@Component({
    selector: 'my-checkbox-switchery-double',
    template: `
            <div class="checkbox checkbox-switchery switchery-{{ size }} switchery-double" style="margin-left: 15px;">
                <label>
                     {{ label }}
                    <input [ngModel]="value" (ngModelChange)="valueChange.emit($event)" [checked]="value" type="checkbox" class="switchery">
                     {{ label_2 }}
                </label>
            </div>
            `
})
export class MyCheckboxSwitcheryDouble implements OnInit, OnChanges {

    @Input()
    public value:boolean = false;

    @Input()
    public label: string = "";

    @Input()
    public label_2: string = "";

    @Input()
    public size: string = "sm";

    private switcher;

    @Output()
    public valueChange: EventEmitter<boolean> = new EventEmitter<boolean>();

    public previousValue = false;

    public constructor(private eRef: ElementRef) {}

    ngOnInit(){
        this.switcher = new Switchery(this.eRef.nativeElement.querySelector('input.switchery'));
    }

    ngOnChanges(changes){
       this.previousValue = (typeof changes.value.previousValue == 'boolean') ? changes.value.previousValue : this.previousValue;
       if(changes.value != undefined && this.previousValue != changes.value.currentValue ) {
            this.switcher.setPosition(true);
       }
    }
}
