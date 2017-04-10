import { Component, Input, Output, EventEmitter, OnInit, OnChanges, ElementRef } from '@angular/core';
@Component({
    selector: 'my-timepicker',
    template: `
            <div class="input-group">
                <span class="input-group-addon"><i class="icon-alarm"></i></span>
                <input type="text" class="form-control publication-added-time" [ngModel]="time">
            </div>
    `
})
export class MyTimePicker implements OnInit, OnChanges {
    @Input()
    public time: string = "";

    @Output()
    public timeChange: EventEmitter<boolean> = new EventEmitter<boolean>();

    private timepickerInput = null;
    private pickerTime = null;

    private initSet = false;

    public constructor(private eRef: ElementRef) {}

    ngOnInit() {
        var self = this;
        this.timepickerInput = $(this.eRef.nativeElement.querySelector('input.publication-added-time')).pickatime({
            format: 'HH:i',
            interval: 15,
            editable: true
        });
        this.pickerTime = this.timepickerInput.pickatime('picker');
        this.pickerTime.on('set', function(){
            if(!self.initSet) {
                var timeObj = this.get('select'),
                    time = timeObj.hour + ':' + timeObj.mins;
                self.timeChange.emit({
                    value: time
                })
            }
        })
    }

    ngOnChanges(changes){
        if(changes.time.currentValue != "" && changes.time.previousValue == "") {
            this.initSet = true;
            this.pickerTime.set('select', this.time, {format: 'HH:i'})
        } else {
            this.initSet = false;
        }
    }
}
