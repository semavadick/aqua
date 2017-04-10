import { Component, Input } from '@angular/core';

@Component({
    selector: 'panel-spinner',
    templateUrl: './panel-spinner.html',
})
export class PanelSpinnerComponent  {

    @Input()
    public isVisible: boolean = false;

}
