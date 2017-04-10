import { Component, Input, Type, OnInit, ViewChildren} from '@angular/core';
import {LanguagesManager} from "../../../../services/languages-manager";
import {MyWysiwygComponent} from "../../../../common/my-wysiwyg/my-wysiwyg.component";
import {FormGroupComponent} from "../../../../common/form-group/form-group.component";
import {AdditionTabForm} from "./addition-tab-form";
import {I18nTabsComponent} from "../../../../common/i18n-tabs/i18n-tabs.component";

@Component({
    selector: 'addition-product-tabs',
    templateUrl: './addition-product-tabs.html',
    directives: [
        <Type>MyWysiwygComponent,
        <Type>FormGroupComponent,
        <Type>I18nTabsComponent,
    ]
})
export class AdditionProductTabsComponent {

    @Input()
    public tabs: AdditionTabForm[] = [];

    constructor(private langsManager: LanguagesManager) { }

    public addTab() {
        this.tabs.push(new AdditionTabForm(this.langsManager));
    }

    public deleteTab(tab: AdditionTabForm) {
        if(confirm('Удалить вкладку?')) {
            var index = this.tabs.indexOf(tab);
            this.tabs.splice(index, 1);
        }
    }
}
