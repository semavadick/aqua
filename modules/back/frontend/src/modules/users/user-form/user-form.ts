import {Injectable} from "@angular/core";
import {Response} from "@angular/http";
import {BackendService} from "../../../services/backend.service.ts";
import {LanguagesManager} from "../../../services/languages-manager";
import {Language} from "../../../services/language";
import {I18nForm} from "../../../common/i18n-form";
import {MyDatatableEntityForm} from "../../../common/my-datatable/my-datatable-entity-form";
import {MyDatatableEntity} from "../../../common/my-datatable/my-datatable-entity";
import {Category} from "./category";
import {AdditionCategory} from "./addition-category";
import {User} from "../user";

@Injectable()
export class UserForm extends MyDatatableEntityForm {

    public email: string;
    public password: string;
    public phone: string;
    public fullName: string;

    public status: number = UserForm.STATUS_ACTIVE;
    public static STATUS_NOT_VERIFIED = 1;
    public static STATUS_ACTIVE = 2;
    public static STATUS_BLOCKED = 3;
    public statuses: Object[] = [
        {
            id: UserForm.STATUS_NOT_VERIFIED,
            label: 'Не подтвержден',
        },
        {
            id: UserForm.STATUS_ACTIVE,
            label: 'Активный',
        },
        {
            id: UserForm.STATUS_BLOCKED,
            label: 'Заблокирован',
        },
    ];

    public role: number = UserForm.ROLE_CLIENT;
    public static ROLE_CLIENT = 1;
    public static ROLE_MANAGER = 2;
    public static ROLE_ADMIN = 3;
    public roles: Object[] = [
        {
            id: UserForm.ROLE_CLIENT,
            label: 'Клиент',
        },
        {
            id: UserForm.ROLE_MANAGER,
            label: 'Менеджер',
        },
        {
            id: UserForm.ROLE_ADMIN,
            label: 'Админинстратор',
        },
    ];

    public type: number = UserForm.TYPE_PERSON;
    public static TYPE_PERSON = 0;
    public static TYPE_COMPANY = 1;
    public types: Object[] = [
        {
            id: UserForm.TYPE_PERSON,
            label: 'Физ. лицо',
        },
        {
            id: UserForm.TYPE_COMPANY,
            label: 'Компания',
        },
    ];

    public companyType: number = UserForm.COMPANY_TYPE_OOO;
    public static COMPANY_TYPE_ZAO = 0;
    public static COMPANY_TYPE_OOO = 1;
    public static COMPANY_TYPE_IP = 2;
    public companyTypes: Object[] = [
        {
            id: UserForm.COMPANY_TYPE_ZAO,
            label: 'ЗАО',
        },
        {
            id: UserForm.COMPANY_TYPE_OOO,
            label: 'ООО',
        },
        {
            id: UserForm.COMPANY_TYPE_IP,
            label: 'ИП',
        },
    ];

    public companyName: string;
    public companyINN: string;
    public companyKPP: string;
    public companyBank: string;
    public companyCheckingAccount: string;
    public companyCreditAccount: string;
    public companyLegalAddress: string;
    public companyActualAddress: string;
    public companyCEO: string;

    public discount: number;

    public isNewUser: boolean = true;

    public constructor(private backend: BackendService, private langsManager: LanguagesManager) {
        super();
    }

    public init(entity: MyDatatableEntity = null): Promise<string> {
        return super.init(entity)
            .then((message: string) => {
                return this.initDiscountCategories(<User>entity);
            });
    }

    public discountCategories: Category[] = [];

    public discountAdditionCategories: AdditionCategory[] = [];

    private initDiscountCategories(user: User): Promise<string> {
        this.isLoading = true;
        return new Promise<string>((resolve, reject) => {
            var url = 'users/discount-categories';
            if(user) {
                url += '/' + user.id;
            }
            this.getBackend().get(url)
                .then((resp: Response) => {
                    var data = resp.json();
                    this.discountCategories = [];
                    this.discountAdditionCategories = [];
                    for(var categoryDataType in data) {
                        for(let categoryData of data[categoryDataType]) {
                            switch(categoryDataType) {
                                case 'main': {
                                    this.discountCategories.push(this.getCategoryFromData(categoryData));
                                    break;
                                }
                                case 'addition': {
                                    this.discountAdditionCategories.push(this.getAdditionCategoryFromData(categoryData));
                                    break;
                                }
                            }
                        }
                    }
                    this.isLoading = false;
                    resolve('ok');
                })
                .catch((resp: Response) => {
                    this.isLoading = false;
                    reject(resp.text());
                });
        });
    }

    private getCategoryFromData(data: any): Category {
        var category = new Category();
        category.id = data['id'];
        category.name = data['name'];
        category.discount = data['discount'];
        category.hasDiscount = data['hasDiscount'];
        for(let childData of data['children']) {
            category.children.push(this.getCategoryFromData(childData));
        }
        return category;
    }

    private getAdditionCategoryFromData(data: any): AdditionCategory {
        var category = new AdditionCategory();
        category.id = data['id'];
        category.name = data['name'];
        category.discount = data['discount'];
        category.hasDiscount = data['hasDiscount'];
        for(let childData of data['children']) {
            category.children.push(this.getAdditionCategoryFromData(childData));
        }
        return category;
    }

    protected getBackend():BackendService {
        return this.backend;
    }

    protected getLanguagesManager():LanguagesManager {
        return this.langsManager;
    }

    protected getBackendUrl():string {
        return 'users';
    }

    reset():any {
        this.email = '';
        this.password = '';
        this.phone = '';
        this.fullName = '';
        this.status = UserForm.STATUS_ACTIVE;
        this.role = UserForm.ROLE_CLIENT;
        this.type = UserForm.TYPE_PERSON;
        this.companyType = UserForm.COMPANY_TYPE_OOO;
        this.companyName = '';
        this.companyINN = '';
        this.companyKPP = '';
        this.companyBank = '';
        this.companyCheckingAccount = '';
        this.companyCreditAccount = '';
        this.companyLegalAddress = '';
        this.companyActualAddress = '';
        this.companyCEO = '';
        this.generatedPassword = '';
        this.isNewUser = true;
        this.discount = null;
    }

    populate(data:any):any {
        this.isNewUser = false;
        Object.assign(this, data);
    }


    private getDiscountData(category: Category): Object[] {
        var data: Object[] = [];
        if(category.hasDiscount && category.discount > 0) {
            data.push({
                categoryId: category.id,
                discount: category.discount
            });
        }
        for(let child of category.children) {
            data = data.concat(this.getDiscountData(child));
        }
        return data;
    }

    private getAdditionDiscountData(category: AdditionCategory): Object[] {
        var data: Object[] = [];
        if(category.hasDiscount && category.discount > 0) {
            data.push({
                categoryId: category.id,
                discount: category.discount
            });
        }
        for(let child of category.children) {
            data = data.concat(this.getAdditionDiscountData(child));
        }
        return data;
    }

    getData():any {
        var discountData: Object[] = [];
        for(let category of this.discountCategories) {
            discountData = discountData.concat(this.getDiscountData(category));
        }
        var additionDiscountData: Object[] = [];
        for(let category of this.discountAdditionCategories) {
            additionDiscountData = additionDiscountData.concat(this.getAdditionDiscountData(category));
        }
        return {
            email: this.email,
            password: this.password,
            phone: this.phone,
            fullName: this.fullName,
            status: this.status,
            role: this.role,
            type: this.type,
            companyType: this.companyType,
            companyName: this.companyName,
            companyINN: this.companyINN,
            companyKPP: this.companyKPP,
            companyBank: this.companyBank,
            companyCheckingAccount: this.companyCheckingAccount,
            companyCreditAccount: this.companyCreditAccount,
            companyLegalAddress: this.companyLegalAddress,
            companyActualAddress: this.companyActualAddress,
            companyCEO: this.companyCEO,
            discount: this.discount,
            categoriesDiscounts: discountData,
            additionCategoriesDiscounts: additionDiscountData
        };
    }

    public isClient(): boolean {
        return this.role == UserForm.ROLE_CLIENT;
    }

    public isCompany(): boolean {
        return this.type == UserForm.TYPE_COMPANY;
    }

    public getI18ns(): I18nForm[] {
        return [];
    }

    protected getI18nFormClass(): { new(language: Language): I18nForm} {
        return null;
    }

    public generatedPassword: string = '';

    public generatePassword() {
        function s4() {
            return Math.floor((1 + Math.random()) * 0x10000)
                .toString(16)
                .substring(1);
        }
        this.generatedPassword = s4() + s4();
        this.password = this.generatedPassword;
    }

}