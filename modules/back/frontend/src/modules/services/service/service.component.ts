import {ServiceForm} from "./service-form";
import {LanguagesManager} from "../../../services/languages-manager";
import {AdvantageForm} from "./advantage-form";
import {TypeForm} from "./type-form";

export abstract class ServiceComponent {

    protected abstract getForm(): ServiceForm;
    protected abstract getLangsManager(): LanguagesManager;

    public addAdvantage() {
        this.getForm().advantages.push(new AdvantageForm(this.getLangsManager()));
    }

    public deleteAdvantage(advantage: AdvantageForm) {
        var index = this.getForm().advantages.indexOf(advantage);
        this.getForm().advantages.splice(index, 1);
    }

    public addType() {
        this.getForm().types.push(new TypeForm(this.getLangsManager()));
    }

    public deleteType(type: TypeForm) {
        var index = this.getForm().types.indexOf(type);
        this.getForm().types.splice(index, 1);
    }

}
