import CarService from "./services";

export default {
    all(page, limit, order, sort){
        return CarService.all(page, limit, order, sort)
    },

    search(by, operator, keyword){
        return CarService.search(by, operator, keyword);
    },

    add(model, year, description, brand_id){
        return CarService.add(model, year, description, brand_id)
    },

    update(id, model, year,  brand_id, description){
        return CarService.update(id, model, year,  brand_id, description)
    },

    destroy(id){
        return Jwt.destroy(id)
    }




}
