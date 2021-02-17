import CarService from "./services";

export default {
    all(page, limit, order, sort){
        return CarService.all(page, limit, order, sort)
    }

}
