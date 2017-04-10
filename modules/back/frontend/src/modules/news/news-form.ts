import {Injectable} from "@angular/core";
import {BackendService} from "../../services/backend.service";
import {LanguagesManager} from "../../services/languages-manager";
import {PublicationForm} from "../publications/publication-form";

@Injectable()
export class NewsForm extends PublicationForm {

    public constructor(private backend: BackendService, private langsManager: LanguagesManager) {
        super();
    }

    protected getBackendUrl():string {
        return 'news';
    }

    protected getBackend():BackendService {
        return this.backend;
    }

    protected getLanguagesManager():LanguagesManager {
        return this.langsManager;
    }

}