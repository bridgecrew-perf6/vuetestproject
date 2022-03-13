<template>
  <nav>
    <v-toolbar   color="blue-grey lighten-5">
      <v-app-bar-nav-icon
        class="grey--text"
        @click="drawer = !drawer"
      ></v-app-bar-nav-icon>
      <v-toolbar-title class="text-uppercase grey--text">
        <span class="font-weight-light">Teow</span>
        <span>Teow</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn color="lightgrey">
        <span>Sight Out</span>
        <v-icon>exit_to_app</v-icon>
      </v-btn>
    </v-toolbar>

    <v-navigation-drawer
      app
      v-model="drawer"
      class="blue-grey lighten-3"
      temporary
    >
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title class="text-uppercase black--text">
            <v-icon>dashboard</v-icon>
            <span class="font-weight-light">Teow</span>
            <span>Teow</span>
          </v-list-item-title>
          <v-list-item-subtitle> Admin สองรัก</v-list-item-subtitle> <span></span>
        </v-list-item-content>
      </v-list-item>

      <v-divider></v-divider>

      <v-list>
        <v-list-item-group v-for="link in links" :key="link.text">
          <v-list-item :to="link.route">
            <v-list-item-icon>
              <v-icon class="white-text">{{ link.icon }}</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
              <v-list-item-title class="white-text"
                >{{ link.text }}
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>
  </nav>
</template>

<script>
export default {
  data() {
    return {
      drawer: false,
      links: [
        { icon: "restaurant_menu", text: "Menu", route: "/" },
        { icon: "add_to_queue", text: "Order", route: "/Queue" },
        { icon: "add_circle", text: "Addmenu", route: "/Addmenu" },
        { icon: "account_balance_wallet", text: "Finance", route: "/finance" },
        { icon: "dashboard", text: "Dashboard", route: "/dashboard" },
        { icon: "dashboard", text: "Raw Material", route: "/RawMaterial" },
        { icon: "dashboard", text: "Noodle", route: "/Noodle" },
        
      ],
    };
  },
};
</script>

<style>
</style>