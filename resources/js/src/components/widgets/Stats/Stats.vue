<template>
  <div>
    <nav class="level is-mobile">
      <div class="level-item has-text-centered">
        <div>
          <p class="heading">New Users</p>
          <p class="title">{{ stats.stats.users }}</p>
        </div>
      </div>
      <div class="level-item has-text-centered">
        <div>
          <p class="heading">New Articles</p>
          <p class="title">{{ stats.stats.articles }}</p>
        </div>
      </div>
      <div class="level-item has-text-centered">
        <div>
          <p class="heading">New Categories</p>
          <p class="title">{{ stats.stats.categories }}</p>
        </div>
      </div>
      <div class="level-item has-text-centered">
        <div>
          <p class="heading">New Top Categories</p>
          <p class="title">{{ stats.stats.topCategories }}</p>
        </div>
      </div>
    </nav>
    <hr />
    <p>All of the data below is for the current month.</p>
  </div>
</template>
<script>
import store from "../../../vuex";
import { mapState } from "vuex";

export default {
  mounted() {
    this.$wait.start("loading");
    store.dispatch("stats/fetchStats").then(() => {
      this.$wait.end("loading");
    });
  },
  computed: mapState({
    stats: state => state.stats
  })
};
</script>