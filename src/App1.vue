
<template>
  <v-app class="grey lighten-4">
    <navbar />
    <v-content>
      <router-view></router-view>
    </v-content>
  </v-app>
</template>

<script>
import navbar from "./components/navbar.vue";

export default {
  name: "App",
  components: {
    navbar,
  },
  data() {
    return {
      //
    };
  },
};
</script>


