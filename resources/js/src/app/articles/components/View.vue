<template>
  <div v-if="article">
    <section :style="'background-image: url(/storage/thumbnail/article/' + article.cover + ');'" class="hero is-info is-medium is-bold">
      <div class="hero-body"></div>
    </section>

    <div class="container">
      <section class="articles">
        <div class="column is-8 is-offset-2">
          <div class="card article">
            <div class="card-content">
              <div class="media">
                <div class="media-content has-text-centered">
                  <p class="title article-title">{{ article.title }}</p>
                   <div class="tags has-addons level-item">
                    <span class="tag is-rounded is-info"><router-link :to="'/category/' + article.category.id" class="has-text-white">{{ article.category.title }}</router-link></span>
                    <span class="has-text-centered tag is-rounded">{{ moment(article.created_at).fromNow() }}</span>
                   </div>
                </div>
              </div>
              <div class="content article-body">
                <div v-html="article.content"></div>
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

export default {
  data() {
    return {
      moment: moment
    };
  },
  computed: mapState({
    article: state => state.article.article.article
  }),
  mounted() {
    this.$wait.start("loading");
    store.dispatch("article/fetchArticle", this.$route.params.id).then(() => {
      this.$wait.end("loading");
    });
  },
  watch: {
    '$route.params': {
        handler(params) {
            store.dispatch("article/fetchArticle", params.id).then(() => {
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
</style>