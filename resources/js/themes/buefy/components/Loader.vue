//Loader Component

<template>
  <b-loading :is-full-page="true" v-if="$wait.is('loading')" active>
    <b-icon pack="fas" icon="cubes" id="icon-load" size="is-large" custom-class="fa-spin"></b-icon>
    <p class="loading-text">Loading...</p>
  </b-loading>
</template>

<script>
export default {
  data() {
    return {
      isFullPage: true
    };
  }
};
</script>

<style lang="scss">
#icon-load svg {
  width: 100px;
  height: 100px;
}

.loading-text {
  font-size: 27px;
  z-index: 1000;
  margin-top: 200px;
  margin-left: -80px;
}
</style>