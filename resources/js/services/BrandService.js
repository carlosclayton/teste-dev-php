import Vue from 'vue';

export default class BrandService {
    static all(page, limit, order, sort){
        return Vue.http.get(`brands?page=${page}&limit=${limit}&orderBy=${order}&sortedBy=${sort}`);
    }

    static search(by, operator, keyword){
        return Vue.http.get(`brands?search=${keyword}&searchFields=${by}:${operator}`);
    }

    static add(model, year, description, brand_id){
        return Vue.http.post('brands', {
            model: model,
            year: year,
            description: description,
            brand_id: brand_id
        })
    }

}
