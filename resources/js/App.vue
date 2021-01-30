<template>
    <router-view></router-view>
</template>

<script>
export default {
    data() {
      return {
        loggedIn: null
      }
    },

    methods: {
      getLoggedIn() {
        this.loggedIn = localStorage.getItem("loggedIn")
      }
    },

    watch: {
      $route: {
        immediate: true,
        handler() {
          this.getLoggedIn()
        }
      }
    },
}
</script>

<style>
  a{
    text-decoration: none !important;
    color: #000;
  }
</style>