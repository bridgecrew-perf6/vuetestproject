<template>
  <div>
    <v-container fluid ma-0>
     <h2>ภาพรวมการเงิน</h2>
      <v-row wrap>
        <v-col cols="9">
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
                          <v-icon color="white" size="50" >monetization_on</v-icon>
                      </div>
                      <v-list-item-title class="headline mb-1 white--text"  v-for="desserts2 in desserts2" :key="desserts2">
                        {{desserts2.ts}} ฿
                      </v-list-item-title>
                      <v-list-item-subtitle class="white--text">รายได้ต่อวัน</v-list-item-subtitle>
                    </v-list-item-content>
                  </v-list-item>
                </v-col>
                <v-col cols="12" sm="4">
                  <v-avatar size="100" class="ml-n10 mt-6" tile>
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
                        <v-icon color="white" size="50" >monetization_on</v-icon>
                      </div>
                      <v-list-item-title class="headline mb-1 white--text"  v-for="desserts3 in desserts3" :key="desserts3">
                        {{desserts3.ts}} ฿
                        
                      </v-list-item-title>
                      <v-list-item-subtitle class="white--text">รายได้ต่อสัปดาห์</v-list-item-subtitle>
                    </v-list-item-content>
                  </v-list-item>
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
                        <v-icon color="white" size="50" >monetization_on</v-icon>
                      </div>
                      <v-list-item-title class="headline mb-1 white--text"  v-for="desserts4 in desserts4" :key="desserts4">
                        {{desserts4.ts}} ฿
                        
                      </v-list-item-title>
                      <v-list-item-subtitle class="white--text">รายได้ต่อเดือน</v-list-item-subtitle>
                    </v-list-item-content>
                  </v-list-item>
                </v-col>
              </v-row>
            </v-card>
          </v-hover>
        </v-col>
      </v-row>
     
    </v-container>
            
          
        </v-col>
      </v-row>
    </v-container>
    <v-container fluid ma-0>
      <v-app >
        <v-card>
          <v-card-title>
            <h3>การทำรายการที่ผ่านมา</h3>
            <v-spacer></v-spacer>
            <v-text-field
              v-model="search"
              append-icon="mdi-magnify"
              label="Search"
              single-line
              hide-details
            ></v-text-field>
          </v-card-title>
          <v-data-table
            :headers="headers"
            :items="desserts"
            :search="search"
          ><template v-slot:[`item.timebill`]="{ item }">
        <v-chip
         :color="getColor2(item.timebill)"
         dark
        >      
        <v-icon>check_circle</v-icon>      
       </v-chip>
      </template></v-data-table>
          

        </v-card>
      </v-app>
    </v-container>
  </div>
</template>

<script>
// import axios from 'axios';
  export default {
    data: () => ({
    dialog: false,
    dialogDelete: false,
    search: '',
    headers: [
      {
        text: 'ลำดับ',
        align: 'start',
        sortable: false,
        value: 'id_bill',
      },
      { text: 'จำนวน(บาท)', value: 'totalbill' },
      { text: 'วันที่', value: 'datebill' },
      { text: 'สถานะ', value: 'timebill' },
      
    ],
    desserts: [],
    desserts2: [],
    desserts3: [],
    desserts4: [],
   
  }),

  

 

  created () {
    this.consultaritems()
    this.consultaritems2()
    this.consultaritems3()
    this.consultaritems4()
  },

  methods: {
    consultaritems(){
            fetch('http://localhost/menunoodle/finanapi.php')
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{
                console.log(datosRespuesta)
                // this.menulist=[]
                // this.menulist.calories=Response
                if(typeof datosRespuesta[0].success==='undefined'){
                    this.desserts=datosRespuesta;
                }
            }).catch(console.log)
        },
        consultaritems2(){
            fetch('http://localhost/menunoodle/finanapi2.php')
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{
                console.log(datosRespuesta)
                // this.menulist=[]
                // this.menulist.calories=Response
                if(typeof datosRespuesta[0].success==='undefined'){
                    this.desserts2=datosRespuesta;
                }
            }).catch(console.log)
        },
        consultaritems3(){
            fetch('http://localhost/menunoodle/finanapi3.php')
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{
                console.log(datosRespuesta)
                // this.menulist=[]
                // this.menulist.calories=Response
                if(typeof datosRespuesta[0].success==='undefined'){
                    this.desserts3=datosRespuesta;
                }
            }).catch(console.log)
        },
        consultaritems4(){
            fetch('http://localhost/menunoodle/finanapi4.php')
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{
                console.log(datosRespuesta)
                // this.menulist=[]
                // this.menulist.calories=Response
                if(typeof datosRespuesta[0].success==='undefined'){
                    this.desserts4=datosRespuesta;
                }
            }).catch(console.log)
        },
         

      // Color of Status
   
      getColor2(timebill){
         if(timebill==timebill) return 'green'
     },
    



     

  },
}

</script>