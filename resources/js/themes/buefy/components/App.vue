<template>
  <div>
    <Loader></Loader>
    <navigation></navigation>

    <router-view></router-view>
  </div>
</template>
<script>
import store from "../vuex";
export default {
  data() {
    return {
      
    };
  },
  beforeMount() {
    this.$wait.start("loading");
    store.dispatch("topCategory/fetchTopCategories").then(() => {
        this.$wait.end("loading");
    });

    this.$wait.start("loading");
    store.dispatch("category/fetchCategories").then(() => {
        this.$wait.end("loading");
    });

    store.dispatch("auth/setToken")
      .then(() => {
          this.$wait.start("loading");
        store.dispatch("auth/fetchUser").catch(() => {
          store.dispatch("auth/clearAuth");
          router.replace({ name: "login" });
          this.$wait.end("loading");
        });
      })
      .catch(() => {
        store.dispatch("auth/clearAuth");
        this.$wait.end("loading");
      });
  }
};
</script>
<style type="text/scss">
.m-t-50 {
  margin-top: 50px;
}

.m-t-100 {
  margin-top: 100px;
}
</style>