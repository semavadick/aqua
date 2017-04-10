import {EntityForm} from "../../common/entity-form";

export abstract class FormPanelForm extends EntityForm {

    public init(): Promise<string> {
        return this.initFromUrl(this.getBackendUrl());
    }

    public save(): Promise<string> {
        return this.saveViaUrl(this.getBackendUrl(), false)
            .then(() => {
                return this.init();
            });
    }

    protected abstract getBackendUrl(): string;

}

