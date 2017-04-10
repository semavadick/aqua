import { Component, Input, Type, OnInit, ViewChildren} from '@angular/core';
import {LanguagesManager} from "../../../../services/languages-manager";
import {MyGridComponent} from "../../../../common/my-grid/my-grid.component";
import {MyCheckbox} from "../../../../common/my-checkbox/my-checkbox.component";
import {FormGroupComponent} from "../../../../common/form-group/form-group.component";
import {AdditionOptionForm} from "./addition-option-form";
import {I18nTabsComponent} from "../../../../common/i18n-tabs/i18n-tabs.component";

@Component({
    selector: 'addition-product-options',
    templateUrl: './addition-product-options.html',
    directives: [
        <Type>MyGridComponent,
        <Type>FormGroupComponent,
        <Type>I18nTabsComponent,
        <Type>I18nTabsComponent,
        <Type>MyCheckbox,
    ]
})
export class AdditionProductOptionsComponent {

    @Input()
    public options: AdditionOptionForm[] = [];

    constructor(private langsManager: LanguagesManager) { }

    public addOption() {
        this.options.push(new AdditionOptionForm(this.langsManager));
    }

    public deleteOption(option: AdditionOptionForm) {
        if(confirm('Удалить характеристику?')) {
            var index = this.options.indexOf(option);
            this.options.splice(index, 1);
        }
    }

    public changeOptionType(option: AdditionOptionForm, type) {
        var index = this.options.indexOf(option),
            oldType = this.options[index].type;
            this.options[index].type = type;
        if(type == 5 || type == 4 || type == 3 || type == 2) {
            this.options[index].show_default = true;
            this.options[index].main = 0;
        } else {
            if(oldType && this.options[index].main) {
                $.each(this.options, function(i, e){
                    if(parseInt(e.type) == parseInt(oldType)) {
                        e.main = 1;
                        return false;
                    }
                });
            }
            this.options[index].main = 0;
            this.options[index].show_default = false;
        }
    }

    public changeMain(option: AdditionOptionForm){
        var index = this.options.indexOf(option);
        var main = $(event.target).prop("checked");
        if(main){
            $.each(this.options, function(i, e){
                if(parseInt(e.type) == parseInt(option.type) && e.main) {
                    e.main = 0;
                }
            });
        }
        this.options[index].main = 1;
    }

}
