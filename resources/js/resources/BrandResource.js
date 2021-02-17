import BrandService from "./services";

export default {
    all(page, limit, order, sort){
        return BrandService.all(page, limit, order, sort)
    },

    search(by, operator, keyword){
        return BrandService.search(by, operator, keyword);
    },

    add(name, description){
        return BrandService.add(name, description)
    }



}
