import Vue from 'vue'
import Vuex from 'vuex'
import auth from '../app/auth/vuex'
import stats from '../components/widgets/Stats/vuex';
import topCategory from '../app/topCategories/vuex'
import category from '../app/categories/vuex'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        auth: auth,
        stats: stats,
        topCategory: topCategory,
        category: category
    }
});
