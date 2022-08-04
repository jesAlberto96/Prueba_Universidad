import { createStore } from 'vuex'

export default createStore({
    state () {
        return {
            path: "http://127.0.0.1:8000",
        }
    },
    getters: {
        getPath: (state: any) => state.path,
    },
})