<template>
  <div>
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
                </div>
              </div>
              <div class="content article-body">
                <div v-html="category.desc"></div>
                <hr />
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
    return {};
  },
  computed: mapState({
    category: state => state.category.category.category
  }),
  mounted() {
    this.$wait.start("loading");
    store.dispatch("category/fetchCategory", this.$route.params.id).then(() => {
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
</style>