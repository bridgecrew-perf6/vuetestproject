<template>
    <div class="dashboard">
        <br>
        <v-subheader class="py-0 d-flex justify-space-between rounded-lg">
            <h1><tr>ประวัติการใช้วัตถุดิบประจำวัน {{date_now}}</tr> </h1>
            
            <!-- <v-btn color="success">
                View Orders
            </v-btn> -->
        </v-subheader>
       <v-container fluid ma-0 >
            <v-row wrap >
              <v-col cols="4"   v-for="(item,ingredients)  in ingredients" :key="ingredients.id">
                <v-card elevation="2" class="rounded-lg" height="100%" width="500" color="#B3E5FC" >
                            <v-card-text class="d-flex justify-space-between align-center">
                                <div>
                                    <h2 style="color: #01579B" >{{item.name_ingre}}</h2> 
                                    <span  style="color: #01579B">Last 1 days</span>
                                </div>
                                <v-avatar size="70" :color="item.color"  style="border: 3px solid #29B6F6" >
                                    <h3 style="color:  #01579B"><h4>{{item.total}} g</h4></h3>
                                </v-avatar>
                            </v-card-text>
                            <v-card-actions class="d-flex justify-space-between">
                            </v-card-actions>
                        </v-card>
              </v-col>
            </v-row>
          </v-container>
            <br> <br>
            <v-subheader class="py-0 d-flex justify-space-between rounded-lg">
            <h1><tr>ประวัติการใช้วัตถุดิบย้อนหลัง 3 วัน</tr> </h1>
            
            <!-- <v-btn color="success">
                View Orders
            </v-btn> -->
        </v-subheader>
      <v-container fluid ma-0 >
            <v-row wrap >
              <v-col cols="4"   v-for="(item,ingredients3day)  in ingredients3day" :key="ingredients3day.id">
                <v-card elevation="2" class="rounded-lg" height="100%" width="500" color="#B3E5FC" >
                            <v-card-text class="d-flex justify-space-between align-center">
                                <div>
                                    <h2 style="color: #01579B" >{{item.name_ingre}}</h2> 
                                    <span  style="color: #01579B">Last 1 days</span>
                                </div>
                                <v-avatar size="70" :color="item.color"  style="border: 3px solid #29B6F6" >
                                    <h3 style="color:  #01579B"><h4>{{item.total}} g</h4></h3>
                                </v-avatar>
                            </v-card-text>
                            <v-card-actions class="d-flex justify-space-between">
                            </v-card-actions>
                        </v-card>
              </v-col>
            </v-row>
          </v-container>
    </div>
</template>

<script>
    export default {
        name: "Dashboard",
        data() {
            return {
                date_now: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
                ingredients: [],
                ingredients3day:[]
                 
            }
        },
        
        
        created () {
            this.getShowDataIngredients()
            this.getShowDataIngredients3Day()
    },
    methods: {
        onButtonClick(item) {
            console.log('click on ' + item.no)
            },

        getShowDataIngredients(){
            fetch('http://localhost/menunoodle/fetchDashB.php')
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{
                console.log(datosRespuesta)
                // this.menulist.calories=Response
                if(typeof datosRespuesta[0].success==='undefined'){
                    this.ingredients=datosRespuesta;
                }
            }).catch(console.log)
        },

        getShowDataIngredients3Day(){
            fetch('http://localhost/menunoodle/fetchDashB3day.php')
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{
                console.log(datosRespuesta)
                // this.menulist.calories=Response
                if(typeof datosRespuesta[0].success==='undefined'){
                    this.ingredients3day=datosRespuesta;
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