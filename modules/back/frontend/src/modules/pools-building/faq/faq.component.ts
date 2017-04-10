import { Component, Type, ViewChild } from '@angular/core';
import {FaqItemsManager} from "./faq-items-manager";
import {FaqItemForm} from "./faq-item-form";
import {MyCropperComponent} from "../../../common/my-cropper/my-cropper.component";
import {MyWysiwygComponent} from "../../../common/my-wysiwyg/my-wysiwyg.component";
import {I18nTabsComponent} from "../../../common/i18n-tabs/i18n-tabs.component";
import {I18nCheckbox} from "../../../common/i18n-checkbox/i18n-checkbox.component";
import {FormGroupComponent} from "../../../common/form-group/form-group.component";
import {FaqItem} from "./faq-item";
import {MyModalComponent} from "../../../common/my-modal/my-modal.component";
import {PanelSpinnerComponent} from "../../../common/panel-spinner/panel-spinner.component";
import {FormButtonComponent} from "../../../common/form-button/form-button.component";

@Component({
    selector: 'faq-items',
    templateUrl: './faq.html',
    directives: [
        <Type>PanelSpinnerComponent,
        <Type>MyWysiwygComponent,
        <Type>I18nTabsComponent,
        <Type>I18nCheckbox,
        <Type>FormGroupComponent,
        <Type>FormButtonComponent,
        <Type>MyModalComponent,
    ],
    providers: [FaqItemsManager, FaqItemForm],
})
export class FaqComponent {

    @ViewChild(<Type>I18nTabsComponent, undefined)
    public i18nTabs: I18nTabsComponent;

    @ViewChild(<Type>MyModalComponent, undefined)
    public modal: MyModalComponent;

    private activeItem: FaqItem = null;

    constructor(public manager: FaqItemsManager, public form: FaqItemForm) {
        manager.loadItems();
    }

    public toggleActiveItem(item: FaqItem) {
        if(this.activeItem && this.activeItem.id == item.id) {
            this.activeItem = null;
            return;
        }
        this.activeItem = item;
    }

    public itemIsActive(item: FaqItem): boolean {
        return this.activeItem && this.activeItem.id == item.id;
    }

    public deleteItem(item: FaqItem) {
        if(confirm('Удалить вопрос?')) {
            this.manager.deleteItem(item);
        }
    }

    public createItem() {
        this.openModal();
    }

    public updateItem(item: FaqItem) {
        this.openModal(item);
    }

    private openModal(item: FaqItem = null) {
        var title = item ? 'Редактирование вопроса' : 'Добавление вопроса';
        this.modal.setTitle(title);
        this.modal.open();
        this.form.init(item)
            .then(() => {
                this.i18nTabs.init(this.form);
                if(!item) {
                    this.form.getI18ns()[0].saveI18n = true;
                }
            })
            .catch((message: string) => {
                if(message) {
                    alert(message);
                }
            });
    }

    public save() {
        this.form.save()
            .then(() => {
                this.modal.close();
                this.manager.loadItems();
            })
            .catch((message) => {
                if(message) {
                    alert(message);
                }
            });
    }
}
