
export class Category {

    public id: number;
    public name: string;
    public children: Category[] = [];

    public hasChild(child: Category): boolean {
        for(let category of this.children) {
            if(category.id == child.id) {
                return true;
            }
            for(let categoryChild of category.children) {
                if(categoryChild.hasChild(child)) {
                    return true;
                }
            }
        }
        return false;
    }

}
