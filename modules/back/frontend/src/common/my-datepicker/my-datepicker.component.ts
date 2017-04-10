import { Component, Input, Output, EventEmitter,OnInit, OnChanges, ElementRef } from '@angular/core';
@Component({
    selector: 'my-datepicker',
    templateUrl: './my-datepicker.html'
})
export class MyDatePicker implements OnInit, OnChanges {

    @Input()
    public date:string = "";

    @Output()
    public dateChange: EventEmitter<boolean> = new EventEmitter<boolean>();

    private datepickerInput = null;
    private pickerDate = null;

    private initSet = false;

    public constructor(private eRef: ElementRef) {}

    ngOnInit(){
        this.datepickerInput = $(this.eRef.nativeElement.querySelector('input.publication-added-date')).pickadate({
            format: 'yyyy-mm-dd',
            monthsShort: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
            weekdaysShort: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
            showMonthsShort: true,
            showWeekdaysFull: false,
            today: 'Сегодня',
            clear: 'Очистить',
            close: 'Закрыть',
            editable: true
        });
        this.pickerDate = this.datepickerInput.pickadate('picker');
        var self = this;
        this.pickerDate.on('set', function(){
            if(!this.initSet) {
                var dateObj = this.get('select'),
                    month = (dateObj.month >= 9) ? (dateObj.month+1) : '0' + (dateObj.month+1),
                    date = (dateObj.date >= 10) ? dateObj.date : '0' + dateObj.date,
                    dateStr = dateObj.year + '-' + month + '-' + date;
                self.dateChange.emit({
                    value: dateStr
                })
            }
        })
    }

    ngOnChanges(changes){
        if(changes.date.currentValue != "" && changes.date.previousValue == "") {
            this.initSet = true;
            this.pickerDate.set('select', this.date, {format: 'yyyy-mm-dd'})
        } else {
            this.initSet = false;
        }
    }

}
