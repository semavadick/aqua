import { Component, Input, Type, OnInit, ViewChildren} from '@angular/core';
import {LanguagesManager} from "../../../../services/languages-manager";
import {MyGridComponent} from "../../../../common/my-grid/my-grid.component";
import {FormGroupComponent} from "../../../../common/form-group/form-group.component";
import {AttributeForm} from "./attribute-form";
import {I18nTabsComponent} from "../../../../common/i18n-tabs/i18n-tabs.component";

@Component({
    selector: 'product-attributes',
    templateUrl: './product-attributes.html',
    directives: [
        <Type>MyGridComponent,
        <Type>FormGroupComponent,
        <Type>I18nTabsComponent,
    ]
})
export class ProductAttributesComponent {

    @Input()
    public attributes: AttributeForm[] = [];

    constructor(private langsManager: LanguagesManager) { }

    public addAttribute() {
        this.attributes.push(new AttributeForm(this.langsManager));
    }

    public deleteAttribute(attribute: AttributeForm) {
        if(confirm('Удалить характеристику?')) {
            var index = this.attributes.indexOf(attribute);
            this.attributes.splice(index, 1);
        }
    }

}
