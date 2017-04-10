import { Component, Input, ViewEncapsulation, OnInit, ElementRef } from '@angular/core';

@Component({
    selector: 'my-grid',
    templateUrl: './my-grid.html',
    encapsulation: ViewEncapsulation.None
})
export class MyGridComponent {

    @Input()
    public cols: number = 4;

    @Input()
    public sortable: boolean = false;

    @Input()
    public manager: boolean = false;

    @Input()
    public items = [];

    private drake;

    public constructor(private eRef: ElementRef) {}

    ngOnInit(){
        if(this.sortable) {
            var container = this.eRef.nativeElement.querySelector('.my-grid__inner');
            this.drake = dragula([container],{
                mirrorContainer: container,
            });
            var self = this;
            this.drake.on('dragend', function(el, target){
                var allElements = container.children;
                var i = 1;
                var items = [];
                for(let sortEl of allElements) {
                    var index = $(sortEl).data('index');
                    for(var itemIndex in self.items) {
                        if(itemIndex == index) {
                            self.items[itemIndex].sort = i;
                            items.push({
                                id: self.items[itemIndex].id,
                                sort: i
                            })
                        }
                    }
                    $(sortEl).data('sort', i);
                    i++;
                }

                if(self.manager && typeof self.manager.callbackSort == 'function') {
                    self.manager.callbackSort(items);
                }
            });
        }
    }

}
