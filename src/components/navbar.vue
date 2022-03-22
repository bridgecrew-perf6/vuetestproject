<template>
  <nav>
    <v-toolbar color="blue-grey lighten-5">
      <v-app-bar-nav-icon
        class="grey--text"
        @click="drawer = !drawer"
      ></v-app-bar-nav-icon>
      <v-toolbar-title class="text-uppercase grey--text">
        <span class="font-weight-light">Teow</span>
        <span>Teow</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <div v-if="checkUser()">
        <v-btn color="lightgrey" @click="logout">
        <span>Logout</span>
        <v-icon>exit_to_app</v-icon>
      </v-btn>
      </div>
      
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
            <!-- <v-icon>dashboard</v-icon> -->
            <span class="font-weight-light">Teow</span>
            <span>Teow</span>
          </v-list-item-title>
          <v-list-item-subtitle class="font-weight-light">Admin</v-list-item-subtitle>
          <span></span>
        </v-list-item-content>
      </v-list-item>

      <v-divider></v-divider>

      <v-list>
        <div v-if="checkUser()">
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
        </div>
         <!-- <div v-else>
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
        </div> -->
        <!-- <div v-else>
          <v-list-item-group>
          <v-list-item to="/">
            <v-list-item-icon>
              <v-icon class="white-text">{{ link.icon }}</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
              <v-list-item-title class="white-text"
                >Login
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          </v-list-item-group>
        </div>
         -->
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
        { icon: "restaurant_menu", text: "สั่งอาหาร", route: "/menupage" },
        { icon: "fact_check", text: "คำสั่งซื้อ", route: "/Queue" },
        { icon: "receipt_long", text: "ยอดขาย", route: "/finance" }, 
        { icon: "set_meal", text: "วัตถุดิบ", route: "/RawMaterial" },
        { icon: "ramen_dining", text: "เส้นก๋วยเตี๋ยว", route: "/Noodle" },
        { icon: "history", text: "ประวัติการใช้วัตถุดิบ", route: "/dashboard" },
        { icon: "menu_book", text: "รายการอาหาร", route: "/Addmenu" },
       
        // { icon: "dashboard", text: "test", route: "/test" },
        // { icon: "dashboard", text: "tables", route: "/tables" },
        // { icon: "dashboard", text: "login", route: "/" },
      ],
    };
  },
  methods: {
    checkUser() {
      const userToken = localStorage.getItem("token");
      
      if (userToken) {
        return true;
      }
    },
    logout(){
      localStorage.clear()
       this.$router.replace({ path: "/" });
    }
  },
};
</script>

<style></style>
