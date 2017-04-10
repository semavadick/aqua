import { Component, Input, OnInit, AfterViewChecked, ElementRef } from '@angular/core';
import { I18nForm } from "../i18n-form";
import {Form} from "../form";
import {EntityForm} from "../entity-form";

@Component({
    selector: 'i18n-tabs',
    templateUrl: './i18n-tabs.html'
})
export class I18nTabsComponent implements AfterViewChecked, OnInit {

    public forms: I18nForm[] = [];

    @Input()
    public entityForm: EntityForm = null;

    private activeForm: I18nForm = null;

    constructor(private eRef: ElementRef) {}

    public ngOnInit() {
        if(this.entityForm) {
            this.init(this.entityForm);
        }
    }

    ngAfterViewChecked(): any {
        // Ставим классы табам
        var tabs = this.eRef.nativeElement.querySelector('.tab-content').children;
        if(!this.forms.length || !tabs.length) {
            return;
        }
        var formIndex = this.forms.indexOf(this.activeForm);
        var tabIndex = 0;
        for(var tab of tabs) {
            var active = tabIndex == formIndex;
            var className = 'tab-pane has-padding';
            if(tabIndex == formIndex) {
                className += ' active';
            }
            tab.setAttribute('class', className);
            tabIndex++;
        }
    }

    public init(entityForm: EntityForm) {
        this.entityForm = entityForm;
        this.forms = entityForm.getI18ns();
        if(!this.forms .length) {
            return;
        }
        this.activeForm = this.forms[0];
    }

    public selectForm(form: I18nForm) {
        this.activeForm = form;
    }

    public isFormSelected(form: I18nForm) {
        return this.activeForm && this.activeForm.language.id == form.language.id;
    }

    public hasGeneralError() {
        return this.entityForm && this.entityForm.hasI18nGeneralError();
    }

    public getGeneralError() {
        if(!this.entityForm) {
            return null;
        }
        return this.entityForm.getI18nGeneralError();
    }
}
