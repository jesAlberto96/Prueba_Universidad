import { createStore } from 'vuex'
import config from '@/store/config'
import { API } from '@/config/api/API'

export default createStore({
    actions: {
        async findAll(context: any){
            return await API.GET(`${config.getters.getPath}/api/v1/estudiantes`);
        },

        async findByID(context: any, { id }){
            return await API.GET(`${config.getters.getPath}/api/v1/estudiantes/${id}`);
        },

        async create(context: any, payload: any){
            return await API.POST(`${config.getters.getPath}/api/v1/estudiantes`, payload);
        },

        async update(context: any, payload: any){
            return await API.PUT(`${config.getters.getPath}/api/v1/estudiantes/${payload.id}`, payload);
        },

        async delete(context: any, { id }: any){
            return await API.DELETE(`${config.getters.getPath}/api/v1/estudiantes/${id}`);
        },
    }
})