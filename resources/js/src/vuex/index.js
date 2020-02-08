import Vue from 'vue'
import Vuex from 'vuex'
import auth from '../app/auth/vuex'
import stats from '../components/widgets/Stats/vuex';
import topCategory from '../app/topCategories/vuex'
import category from '../app/categories/vuex'
import article from '../app/articles/vuex'
import setup from '../app/setup/vuex'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        auth: auth,
        stats: stats,
        topCategory: topCategory,
        category: category,
        article: article,
        setup: setup
    }
});
