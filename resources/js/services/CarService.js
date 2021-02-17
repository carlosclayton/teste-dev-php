import Vue from 'vue';

export default class CarService {
    static all(page, limit, order, sort){
        return Vue.http.get(`cars?page=${page}&limit=${limit}&orderBy=${order}&sortedBy=${sort}`);
    }

    static search(by, operator, keyword){
        return Vue.http.get(`cars?search=${keyword}&searchFields=${by}:${operator}`);
    }

    static add(model, year, brand_id, description){
        return Vue.http.post('cars', {
            model: model,
            year: year,
            brand_id: brand_id,
            description: description
        })
    }
    static update(id, model, year, brand_id, description){
        return Vue.http.put(`cars/${id}`, {
            model: model,
            year: year,
            brand_id: brand_id,
            description: description
        })
    }

    static destroy(id){
        return Vue.http.delete(`cars/${id}`)
    }


}
