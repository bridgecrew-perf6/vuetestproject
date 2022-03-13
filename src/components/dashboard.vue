<template>
    <div class="dashboard">
        <v-subheader class="py-0 d-flex justify-space-between rounded-lg">
            <h1><tr>Dashboard</tr> </h1>
            
            <v-btn color="success">
                View Orders
            </v-btn>
        </v-subheader>
       <v-container fluid ma-0>
            <v-row wrap>
              <v-col cols="4"   v-for="(item,desserts)  in desserts" :key="desserts.id">
                <v-card elevation="2" class="rounded-lg" height="100%" width="500">
                            <v-card-text class="d-flex justify-space-between align-center">
                                <div>
                                    <strong>{{item.title}}</strong> <br>
                                    <span>Last 1 days</span>
                                </div>
                                <v-avatar size="70" :color="item.color" style="border: 3px solid #444">
                                    <span style="color: white"><h4>{{item.amount}} g</h4></span>
                                </v-avatar>
                            </v-card-text>
                            <v-card-actions class="d-flex justify-space-between">
                            </v-card-actions>
                        </v-card>
              </v-col>
            </v-row>
          </v-container>
            <!-- <v-col>
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
            </v-col> -->
        
    </div>
</template>

<script>
    export default {
        name: "Dashboard",
        data() {
            return {
                desserts: [
                    {title: 'หมู' , amount: '220' , icon: 'mdi-account', color: 'cyan lighten-3'},
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
                // headers: [
                //     {
                //         text: 'Dessert (100g serving)',
                //         align: 'start',
                //         sortable: false,
                //         value: 'name',
                //     },
                //     {text: 'Calories', value: 'calories'},
                //     {text: 'Fat (g)', value: 'fat'},
                //     {text: 'Carbs (g)', value: 'carbs'},
                //     {text: 'Protein (g)', value: 'protein'},
                //     {text: 'Iron (%)', value: 'iron'},
                //     {text: 'Actions', value: 'action'},
                // ],
                // desserts: [
                //     {
                //         name: 'Frozen Yogurt',
                //         calories: 159,
                //         fat: 6.0,
                //         carbs: 24,
                //         protein: 4.0,
                //         iron: '1%',
                //     },
                //     {
                //         name: 'Ice cream sandwich',
                //         calories: 237,
                //         fat: 9.0,
                //         carbs: 37,
                //         protein: 4.3,
                //         iron: '1%',
                //     },
                //     {
                //         name: 'Eclair',
                //         calories: 262,
                //         fat: 16.0,
                //         carbs: 23,
                //         protein: 6.0,
                //         iron: '7%',
                //     },
                //     {
                //         name: 'Cupcake',
                //         calories: 305,
                //         fat: 3.7,
                //         carbs: 67,
                //         protein: 4.3,
                //         iron: '8%',
                //     },
                //     {
                //         name: 'Gingerbread',
                //         calories: 356,
                //         fat: 16.0,
                //         carbs: 49,
                //         protein: 3.9,
                //         iron: '16%',
                //     },
                //     {
                //         name: 'Jelly bean',
                //         calories: 375,
                //         fat: 0.0,
                //         carbs: 94,
                //         protein: 0.0,
                //         iron: '0%',
                //     },
                //     {
                //         name: 'Lollipop',
                //         calories: 392,
                //         fat: 0.2,
                //         carbs: 98,
                //         protein: 0,
                //         iron: '2%',
                //     },
                //     {
                //         name: 'Honeycomb',
                //         calories: 408,
                //         fat: 3.2,
                //         carbs: 87,
                //         protein: 6.5,
                //         iron: '45%',
                //     },
                //     {
                //         name: 'Donut',
                //         calories: 452,
                //         fat: 25.0,
                //         carbs: 51,
                //         protein: 4.9,
                //         iron: '22%',
                //     },
                //     {
                //         name: 'KitKat',
                //         calories: 518,
                //         fat: 26.0,
                //         carbs: 65,
                //         protein: 7,
                //         iron: '6%',
                //     },
                // ],
            }
        },
        methods: {
            onButtonClick(item) {
                console.log('click on ' + item.no)
            },
             consultaritems(){
            fetch('http://localhost/menunoodle/menuapi4.php')
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{
                console.log(datosRespuesta)
                // this.menulist.calories=Response
                if(typeof datosRespuesta[0].success==='undefined'){
                    this.desserts=datosRespuesta;
                }
            }).catch(console.log)
},
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