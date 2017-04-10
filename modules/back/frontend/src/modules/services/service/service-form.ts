import { Injectable } from '@angular/core';
import { BackendService } from "../../../services/backend.service";
import { I18nForm } from "../../../common/i18n-form";
import { LanguagesManager } from "../../../services/languages-manager";
import { Language } from "../../../services/language";
import { FormPanelForm } from "../../../common/form-panel/form-panel-form";
import {MyCropperImage} from "../../../common/my-cropper/my-cropper-image";
import {ServiceI18nForm} from "./service-i18n-form";
import {AdvantageForm} from "./advantage-form";
import {TypeForm} from "./type-form";

export abstract class ServiceForm extends FormPanelForm {

    public bg: MyCropperImage = new MyCropperImage();

    public advantages: AdvantageForm[] = [];

    public types: TypeForm[] = [];

    reset(): any {
        this.bg.reset();
        this.advantages = [];
        if(this.hasTypes()) {
            this.types = [];
        }
    }

    populate(data: any): any {
        this.bg.currentImageUrl = data['bgUrl'];
        for(let advData of data['advantages']) {
            var advantage = new AdvantageForm(this.getLanguagesManager());
            advantage.populate(advData);
            this.advantages.push(advantage);
        }
        if(this.hasTypes()) {
            for(let typeData of data['types']) {
                var type = new TypeForm(this.getLanguagesManager());
                type.populate(typeData);
                this.types.push(type);
            }
        }
    }

    getData(): any {
        var advsData: Object[] = [];
        for(let advantage of this.advantages) {
            advsData.push(advantage.getData());
        }
        var returnData = {
            bg: this.bg.croppedImage,
            advantages: advsData,
        };

        if(this.hasTypes()) {
            var typesData: Object[] = [];
            for(let type of this.types) {
                typesData.push(type.getData());
            }
            returnData['types'] = typesData;
        }
        return returnData;
    }

    public setErrors(errors: Object) {
        super.setErrors(errors);
        var i = 0;
        for(let advErrors of errors['advantages']) {
            this.advantages[i].setErrors(advErrors);
            i++;
        }
        if(this.hasTypes()) {
            i = 0;
            for(let typeErrors of errors['types']) {
                this.types[i].setErrors(typeErrors);
                i++;
            }
        }
    }

    public abstract hasBg(): boolean;

    public abstract hasTypes(): boolean;

}
