<template>
    <div class="dashboard">
        <v-subheader class="py-0 d-flex justify-space-between rounded-lg">
            <h1><tr>Dashboard</tr> </h1>
            
            <v-btn color="success">
                View Orders
            </v-btn>
        </v-subheader>
       <v-container fluid ma-0 >
            <v-row wrap >
              <v-col cols="4"   v-for="(item,desserts)  in desserts" :key="desserts.id">
                <v-card elevation="2" class="rounded-lg" height="100%" width="500" >
                            <v-card-text class="d-flex justify-space-between align-center" >
                                <div>
                                    <strong>{{item.name_ingre}}</strong> <br>
                                    <span>Last 1 days</span>
                                </div>
                                <v-avatar size="70" :color="item.color" style="border: 3px solid #000">
                                    <span style="color: green"><h4>{{item.quantity_ingre}} g</h4></span>
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
               
            }
        },created () {
    // this.initialize()
    this.consultaritems()
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