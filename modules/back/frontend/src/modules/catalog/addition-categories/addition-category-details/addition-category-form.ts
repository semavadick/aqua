import { Injectable } from '@angular/core';
import { BackendService } from "../../../../services/backend.service";
import { I18nForm } from "../../../../common/i18n-form";
import { LanguagesManager } from "../../../../services/languages-manager";
import { Language } from "../../../../services/language";
import {MyCropperImage} from "../../../../common/my-cropper/my-cropper-image";
import {AdditionCategoryI18nForm} from "./addition-category-i18n-form";
import {EntityForm} from "../../../../common/entity-form";
import {FilterForm} from "./filter-form";
import {AdditionCategory} from "../addition-category";

@Injectable()
export class AdditionCategoryForm extends EntityForm {

    public image: MyCropperImage = new MyCropperImage();
    public bg: MyCropperImage = new MyCropperImage();
    public relatedCategoriesIds: number[] = [];
    public hasDiscount: boolean = false;

    public parent: AdditionCategory = null;

    public filters: FilterForm[] = [];

    private backendUrl: string = 'catalog/addition-categories';

    public constructor(private backend: BackendService, private langsManager: LanguagesManager) {
        super();
    }

    private category: AdditionCategory = null;

    public init(category: AdditionCategory = null, parent: AdditionCategory = null): Promise<string> {
        this.category = category;
        this.parent = parent;
        if(!category) {
            return this.initLocally();
        }
        return this.initFromUrl(this.backendUrl + '/' + category.id);
    }

    public save(): Promise<string> {
        var url = this.backendUrl;
        var isNewEntity = true;
        if(this.category) {
            url += '/' + this.category.id;
            isNewEntity = false;
        }
        return this.saveViaUrl(url, isNewEntity);
    }

    reset(): any {
        this.image.reset();
        this.bg.reset();
        this.filters = [];
        this.relatedCategoriesIds = [];
        this.hasDiscount = false;
    }

    populate(data: any): any {
        this.image.currentImageUrl = data['imageUrl'];
        this.bg.currentImageUrl = data['bgUrl'];
        this.relatedCategoriesIds = data['relatedCategoriesIds'];
        this.hasDiscount = data['hasDiscount'];
        for(let filterData of data['filters']) {
            var filter = new FilterForm(this.getLanguagesManager());
            filter.populate(filterData);
            this.filters.push(filter);
        }
    }

    getData(): any {
        var filtersData: Object[] = [];
        for(let filter of this.filters) {
            filtersData.push(filter.getData());
        }
        return {
            bg: this.bg.croppedImage,
            image: this.image.croppedImage,
            filters: filtersData,
            parentId: this.parent ? this.parent.id : null,
            relatedCategoriesIds: this.relatedCategoriesIds,
            hasDiscount: this.hasDiscount,
        };
    }

    protected getBackend():BackendService {
        return this.backend;
    }

    protected getLanguagesManager():LanguagesManager {
        return this.langsManager;
    }

    protected getI18nFormClass(): { new(language: Language): I18nForm } {
        return AdditionCategoryI18nForm;
    }

    public getRelatedCategories(): AdditionCategory[] {
        var categories: AdditionCategory[] = [];
        for(let id of this.relatedCategoriesIds) {
            var category = new AdditionCategory();
            category.id = id;
            categories.push(category);
        }
        return categories;
    }

    public setRelatedCategories(categories: AdditionCategory[]) {
        this.relatedCategoriesIds = [];
        for(let category of categories) {
            this.relatedCategoriesIds.push(category.id);
        }
    }

}
