import { Component, Type, Input, Output, OnInit, ElementRef, ViewEncapsulation } from '@angular/core';
import {SearchForm} from "./search-form";
declare var $: any;

@Component({
    selector: 'search-form',
    templateUrl: './search-form.html',
    encapsulation: ViewEncapsulation.None,
})
export class SearchFormComponent implements OnInit{

    @Input()
    public form: SearchForm;

    public constructor(private eRef: ElementRef) {}

    ngOnInit() {
        var $select: any = $(this.eRef.nativeElement.querySelector('select.clients'));
        $select.select2({
            minimumResultsForSearch: 10
        });
        var self = this;
        $.get('/back/orders/clients', {}, function(data){
            self.form.clients = self.form.clients.concat(data);
        })

        $select.on('change', function(){
            var val = $(this).val();
            self.form.clientId = (val != 'null') ? parseInt(val) : null;
        })
    }

}