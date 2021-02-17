import Vue from 'vue';

export default class CarService {
    static all(page, limit, order, sort){
        return Vue.http.get(`cars?page=${page}&limit=${limit}&orderBy=${order}&sortedBy=${sort}`);
    }
}
