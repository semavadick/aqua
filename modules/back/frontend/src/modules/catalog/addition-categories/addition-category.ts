
export class AdditionCategory {

    public id: number;
    public name: string;
    public children: AdditionCategory[] = [];

    public hasChild(child: AdditionCategory): boolean {
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
