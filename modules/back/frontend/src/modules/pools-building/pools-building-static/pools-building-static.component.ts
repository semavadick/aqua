import {PoolsBuildingStaticForm} from "./pools-building-static-form";
import {LanguagesManager} from "../../../services/languages-manager";

export abstract class PoolsBuildingStaticComponent {

    protected abstract getForm(): PoolsBuildingStaticForm;
    protected abstract getLangsManager(): LanguagesManager;

}
