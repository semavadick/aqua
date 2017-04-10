import { Component, Input, Output, Type, OnInit, ViewChild, EventEmitter } from '@angular/core';
import { PanelSpinnerComponent } from "../panel-spinner/panel-spinner.component";
import { I18nTabsComponent } from "../i18n-tabs/i18n-tabs.component";
import { FormButtonComponent } from "../form-button/form-button.component";
import { FormPanelForm } from "./form-panel-form";

@Component({
    selector: 'form-panel',
    templateUrl: './form-panel.html',
    directives: [
        <Type>PanelSpinnerComponent,
        <Type>FormButtonComponent,
    ],
})
export class FormPanelComponent implements OnInit {

    @Input()
    public form: FormPanelForm;

    @Input()
    public i18nTabs: I18nTabsComponent = null;

    @Input()
    public title: string;

    public showSuccessMessage: boolean = false;

    public ngOnInit() {
        this.form.init()
            .then((message: string) => {
                if(this.i18nTabs) {
                    this.i18nTabs.init(this.form);
                }
            })
            .catch((message: string) => {
                alert(message);
            })
    }

    public save() {
        this.form.save()
            .then(() => {
                this.showSuccessMessage = true;
                setTimeout(() => {
                    this.showSuccessMessage = false;
                }, 5000);
            })
            .catch((message: string) => {
                if(message) {
                    alert(message);
                }
            })
    }

}