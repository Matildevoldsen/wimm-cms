<template>
  <div v-if="category">
    <section :style="'background-image: url(/storage/thumbnail/category/' + category.thumbnail + ');'" class="hero is-info is-medium is-bold">
      <div class="hero-body"></div>
    </section>

    <div class="container">
      <section class="articles">
        <div class="column is-8 is-offset-2">
          <div class="card article">
            <div class="card-content">
              <div class="media">
                <div class="media-content has-text-centered">
                  <p class="title article-title">{{ category.title }}</p>
                  <span class="tag is-rounded">{{ moment(category.created_at).fromNow() }}</span>
                </div>
              </div>
              <div class="content article-body">
                <div v-html="category.desc"></div>
                <div class="separator">Articles</div>
                <template v-if="articles">
                  <div v-for="(article, index) in articles" v-bind:key="index">
                    <template v-if="article.category[0].id == category.id">
                      <p class="title article-title has-text-centered">
                        <router-link class="has-text-black" :to="'/articles/' + article.id">{{ article.title }}</router-link>
                      </p>
                      <div class="tags has-addons level-item">
                        <span class="tag is-rounded is-info">{{ article.category[0].title }}</span>
                        <span class="has-text-centered tag is-rounded">{{ moment(article.created_at).fromNow() }}</span>
                      </div>

                      <div class="has-text-cented" v-html="truncate(article.content, 200)"></div> 
                      <router-link class="is-link" :to="'/articles/' + article.id">Read more</router-link>
                    </template>
                  </div>
                </template>
                <template v-if="!articles">
                  <p>There is no articles here.</p>
                </template>
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
import store from "../../../vuex";
import moment from "moment";
import filters from  '../../../helpers/filters'

export default {
  data() {
    return {
      moment: moment,
    };
  },
  computed: mapState({
    category: state => state.category.category.category,
    articles: state => state.article.articles.article,
  }),
  methods: {
    truncate(value, limit) {
      return filters.truncate(value, limit);
    }
  },
  mounted() {
    this.$wait.start("loading");
    store.dispatch("category/fetchCategory", this.$route.params.id).then(() => {
      this.$wait.end("loading");
    });

    store.dispatch("article/fetchArticles").then(() => {
      this.$wait.end("loading");
    });
  },
  watch: {
    '$route.params': {
        handler(params) {
            store.dispatch("category/fetchCategory", params.id).then(() => {
              this.$wait.end("loading");
              $( ".dropdown-menu" ).hide();
            });
        },
        immediate: true,
    }
}
};
</script>
<style lang="scss">
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
.separator::before, .separator::after {
    content: '';
    flex: 1;
    border-bottom: 2px solid #efefef;
    background: #fff;
}
.separator::before {
    margin-right: .25em;
}
.separator::after {
    margin-left: .25em;
}
</style>