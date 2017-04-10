import { Injectable } from '@angular/core';
import { BackendService } from "../../services/backend.service";
import { I18nForm } from "../../common/i18n-form";
import { LanguagesManager } from "../../services/languages-manager";
import { Language } from "../../services/language";
import { FormPanelForm } from "../../common/form-panel/form-panel-form";

@Injectable()
export class SettingsForm extends FormPanelForm {

    public phone1: string = '';
    public phone2: string = '';
    public colnsultEmail: string = '';
    public calcEmail: string = '';
    public feedbackEmail: string = '';
    public facebookLink: string = '';
    public twitterLink: string = '';
    public youtubeLink: string = '';
    public countersCode: string = '';

    constructor(private backend: BackendService, private langsManager: LanguagesManager) {
        super();
    }

    protected getBackend():BackendService {
        return this.backend;
    }

    protected getBackendUrl():string {
        return 'settings';
    }

    protected getLanguagesManager():LanguagesManager {
        return this.langsManager;
    }

    reset(): any {

    }

    populate(data: any): any {
        Object.assign(this, data);
    }

    getData(): any {
        return {
            phone1: this.phone1,
            phone2: this.phone2,
            colnsultEmail: this.colnsultEmail,
            calcEmail: this.calcEmail,
            feedbackEmail: this.feedbackEmail,
            facebookLink: this.facebookLink,
            twitterLink: this.twitterLink,
            youtubeLink: this.youtubeLink,
            countersCode: this.countersCode,
        };
    }

    protected getI18nFormClass(): { new(language: Language): I18nForm }  {
        return null;
    }

}
