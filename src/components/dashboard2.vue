<template>
    <div class="dashboard">
        <v-subheader class="py-0 d-flex justify-space-between rounded-lg">
            <h1>Dashboard</h1>
            <v-btn color="success">
                View Orders
            </v-btn>
        </v-subheader>
        <template>
  <div class="home">
 
    <v-container class="mt-5">
      <v-row>
        <v-col cols="12" sm="4">
          <v-hover v-slot="{ hover }" open-delay="200">
            <v-card color="cyan darken-1" :elevation="hover ? 16 : 2">
              <v-row>
                <v-col cols="12" sm="8">
                  <v-list-item three-line>
                    <v-list-item-content>
                      <div class="mb-4">
                        <v-btn fab color="cyan lighten-2" elevation="0">
                          <v-icon color="white">fab fa-bitcoin</v-icon>
                        </v-btn>
                      </div>
                      <v-list-item-title class="headline mb-1 white--text">
                        $8520.50
                      </v-list-item-title>
                      <v-list-item-subtitle class="white--text">Market Cap $151.458</v-list-item-subtitle>
                    </v-list-item-content>
                  </v-list-item>
                </v-col>
                <v-col cols="12" sm="4">
                  <v-avatar size="100" class="ml-n10 mt-6" tile>
                    <v-img src="wallet.png"></v-img>
                  </v-avatar>
                </v-col>
              </v-row>
            </v-card>
          </v-hover>
        </v-col>
        <v-col cols="12" sm="4">
          <v-hover v-slot="{hover }" open-delay="200">
            <v-card color="pink darken-1" :elevation="hover ? 16 : 2">
              <v-row>
                <v-col cols="12" sm="8">
                  <v-list-item three-line>
                    <v-list-item-content>
                      <div class="mb-4">
                        <v-btn fab color="pink lighten-2" elevation="0">
                          <v-icon color="white">fas fa-rupee-sign</v-icon>
                        </v-btn>
                      </div>
                      <v-list-item-title class="headline mb-1 white--text">
                        $7220.50
                      </v-list-item-title>
                      <v-list-item-subtitle class="white--text">Market Cap $151.458</v-list-item-subtitle>
                    </v-list-item-content>
                  </v-list-item>
                </v-col>
                <v-col cols="12" sm="4">
                  <v-avatar size="100" class="ml-n10 mt-6" tile>
                    <v-img src="wallet.png"></v-img>
                  </v-avatar>
                </v-col>
              </v-row>
            </v-card>
          </v-hover>
        </v-col>
        <v-col cols="12" sm="4">
          <v-hover v-slot="{ hover }" open-delay="200">
            <v-card color="orange darken-1" :elevation="hover ? 16 :2">
              <v-row>
                <v-col cols="12" sm="8">
                  <v-list-item three-line>
                    <v-list-item-content>
                      <div class="mb-4">
                        <v-btn fab color="orange lighten-2" elevation="0">
                          <v-icon color="white">fas fa-pound-sign</v-icon>
                        </v-btn>
                      </div>
                      <v-list-item-title class="headline mb-1 white--text">
                        $350.50
                      </v-list-item-title>
                      <v-list-item-subtitle class="white--text">Market Cap $151.458</v-list-item-subtitle>
                    </v-list-item-content>
                  </v-list-item>
                </v-col>
              </v-row>
            </v-card>
          </v-hover>
        </v-col>
      </v-row>
     
    </v-container>
  </div> 
  <v-col>
                <v-card>
                    <v-data-table
                            caption="Recent Order list"
                            :headers="headers"
                            :items="desserts"
                            :items-per-page="15"
                            class="elevation-1"
                    >
                        <template v-slot:[`item.action`]="">
                            <v-btn color="success" outlined small shaped >View</v-btn>
                        </template>
                    </v-data-table>
                </v-card>
            </v-col>
</template>
           
        
    </div>
</template>

<script>
    export default {
        name: "Dashboard",
        data() {
            return {
                activityLog: [
                    {title: 'เนื้อหมู', amount: 512, icon: 'mdi-account', color: 'cyan lighten-3'},
                    {title: 'เนื้อไก่', amount: 203, icon: 'mdi-account-group-outline', color: 'green darken-2'},
                    {title: 'เนื้อวัว', amount: 120, icon: 'mdi-account-group-outline', color: 'blue-grey darken-1'},
                    {
                        title: 'ตับ',
                        amount: 3433,
                        icon: 'mdi-account-group-outline',
                        color: 'deep-orange darken-1'
                    },
                    {title: 'ปลาหมึก', amount: 150, icon: 'mdi-account', color: 'cyan lighten-3'},
                    {title: 'กุ้ง', amount: 100, icon: 'mdi-account-group-outline', color: 'green darken-2'},
                    {title: 'ลูกชิ้น', amount: 5465, icon: 'mdi-account-group-outline', color: 'blue-grey darken-1'},
                    {
                        title: 'เส้น',
                        amount: 8800,
                        icon: 'mdi-account-group-outline',
                        color: 'deep-orange darken-1'
                    },
                ],
                headers: [
                    {
                        text: 'Dessert (100g serving)',
                        align: 'start',
                        sortable: false,
                        value: 'name',
                    },
                    {text: 'Calories', value: 'calories'},
                    {text: 'Fat (g)', value: 'fat'},
                    {text: 'Carbs (g)', value: 'carbs'},
                    {text: 'Protein (g)', value: 'protein'},
                    {text: 'Iron (%)', value: 'iron'},
                    {text: 'Actions', value: 'action'},
                ],
                desserts: [
                    {
                        name: 'Frozen Yogurt',
                        calories: 159,
                        fat: 6.0,
                        carbs: 24,
                        protein: 4.0,
                        iron: '1%',
                    },
                    {
                        name: 'Ice cream sandwich',
                        calories: 237,
                        fat: 9.0,
                        carbs: 37,
                        protein: 4.3,
                        iron: '1%',
                    },
                    {
                        name: 'Eclair',
                        calories: 262,
                        fat: 16.0,
                        carbs: 23,
                        protein: 6.0,
                        iron: '7%',
                    },
                    {
                        name: 'Cupcake',
                        calories: 305,
                        fat: 3.7,
                        carbs: 67,
                        protein: 4.3,
                        iron: '8%',
                    },
                    {
                        name: 'Gingerbread',
                        calories: 356,
                        fat: 16.0,
                        carbs: 49,
                        protein: 3.9,
                        iron: '16%',
                    },
                    {
                        name: 'Jelly bean',
                        calories: 375,
                        fat: 0.0,
                        carbs: 94,
                        protein: 0.0,
                        iron: '0%',
                    },
                    {
                        name: 'Lollipop',
                        calories: 392,
                        fat: 0.2,
                        carbs: 98,
                        protein: 0,
                        iron: '2%',
                    },
                    {
                        name: 'Honeycomb',
                        calories: 408,
                        fat: 3.2,
                        carbs: 87,
                        protein: 6.5,
                        iron: '45%',
                    },
                    {
                        name: 'Donut',
                        calories: 452,
                        fat: 25.0,
                        carbs: 51,
                        protein: 4.9,
                        iron: '22%',
                    },
                    {
                        name: 'KitKat',
                        calories: 518,
                        fat: 26.0,
                        carbs: 65,
                        protein: 7,
                        iron: '6%',
                    },
                ],
            }
        },
        methods: {
            onButtonClick(item) {
                console.log('click on ' + item.no)
            }
        }
    }
</script>

<style scoped>
    .overlap-icon {
        position: absolute;
        top: -33px;
        text-align: center;
        padding-top: 12px;
    }
</style>