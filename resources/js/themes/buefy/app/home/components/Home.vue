<template>
  <div v-if="articles">
    <section class="hero is-info is-medium is-bold">
      <div class="hero-body"></div>
    </section>

    <div class="container">
      <section class="articles">
        <div class="column is-8 is-offset-2">
          <div class="card article" v-for="(article, index) in articles" v-bind:key="index">
            <div class="card-content" v-if="article">
              <div class="media">
                <div class="media-content has-text-centered">
                  <p class="title article-title"><router-link class="has-text-black" :to="'/articles/' + article.id">{{ article.title }}</router-link></p>
                  <div class="tags has-addons level-item">
                    <span class="tag is-rounded is-info"><router-link :to="'/category/' + article.category[0].id" class="has-text-white">{{ article.category[0].title }}</router-link></span>
                    <span class="has-text-centered tag is-rounded">{{ moment(article.created_at).fromNow() }}</span>
                   </div>
                </div>
              </div>
              <div class="content article-body">
                  <div v-html="truncate(article.content, 200)"></div>
                  <router-link class="is-link" :to="'/articles/' + article.id">Read more...</router-link>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</template>
<script>
import { mapState } from "vuex";
import moment from "moment";
import store from "../../../vuex";
import filters from '../../../../../helpers/filters'

export default {
  data() {
    return {
      moment: moment
    };
  },
  computed: mapState({
    articles: state => state.article.articles.article
  }),
  methods: {
    truncate(value, limit) {
      return filters.truncate(value, limit)
    }
  },
  beforeMount() {
      this.$wait.start("loading");
    store.dispatch("article/fetchArticles").then(() => {
      this.$wait.end("loading");
    });
  }
};
</script>
<style>
.hero {
  background-position: center;
  background-size: cover;
  background-repeat: no-repeat;
  height: 500px;
}

.separator {
  display: flex;
  align-items: center;
  text-align: center;
  font-size: 20px;
  font-weight: 600;
}
.separator::before,
.separator::after {
  content: "";
  flex: 1;
  border-bottom: 2px solid #efefef;
  background: #fff;
}
.separator::before {
  margin-right: 0.25em;
}
.separator::after {
  margin-left: 0.25em;
}
</style>