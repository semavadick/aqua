import { Component, Input, ElementRef, DoCheck } from '@angular/core';
import {I18nForm} from "../i18n-form";

@Component({
    selector: 'i18n-checkbox',
    template: `
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <div class="checker border-primary-600 text-primary-800">
                        <span [class.checked]="form.saveI18n">
                            <input type="checkbox" class="control-primary" [ngModel]="form.saveI18n" (ngModelChange)="toggle($event)">
                        </span>
                    </div>
                    Добавить язык
                </label>
            </div>
        </div>
    `,
})
export class I18nCheckbox implements DoCheck {

    @Input()
    public form: I18nForm = null;

    public oldValue: boolean = null;

    public constructor(private eRef: ElementRef) { }

    public toggle(value: boolean) {
        this.form.saveI18n = value;
        this.toggleFormGroups();
    }

    ngDoCheck() {
        if(this.oldValue !== this.form.saveI18n) {
            this.oldValue = this.form.saveI18n;
            this.toggleFormGroups();
        }
    }

    private toggleFormGroups() {
        var groups = this.eRef.nativeElement.parentElement.querySelectorAll('form-group');
        var className = this.form.saveI18n ? '' : 'disabled';
        for(let group of groups) {
            group.setAttribute('class', className);
        }

    }

}


