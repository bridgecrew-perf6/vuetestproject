<template>
  <div id="app">
  <v-app id="inspire">
    <v-data-table
      :headers="headers"
      :items="desserts"
      sort-by=""
      class="elevation-1"
    >
      <template v-slot:top>
        <v-toolbar
          flat
        >
          <v-toolbar-title>Order</v-toolbar-title>
          <v-divider
            class="mx-4"
            inset
            vertical
          ></v-divider>
          <v-spacer></v-spacer>
          <v-dialog
            v-model="dialog"
            max-width="500px"
          >
            <!-- <template v-slot:activator="{ on,attrs }">
              <v-btn
                color="primary"
                dark
                class="mb-2"
                v-bind="attrs"
                v-on="on"
              >
                New Item
              </v-btn>
            </template>
            <v-card>
              <v-card-title>
                <span class="text-h5">{{ formTitle }}</span>
              </v-card-title>
  
              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col
                      cols="12"
                      sm="6"
                      md="4"
                    >
                      <v-text-field
                        v-model="editedItem.name"
                        label="Dessert name"
                      ></v-text-field>
                    </v-col>
                    <v-col
                      cols="12"
                      sm="6"
                      md="4"
                    >
                      <v-text-field
                        v-model="editedItem.calories"
                        label="Calories"
                      ></v-text-field>
                    </v-col>
                    <v-col
                      cols="12"
                      sm="6"
                      md="4"
                    >
                      <v-text-field
                        v-model="editedItem.fat"
                        label="Fat (g)"
                      ></v-text-field>
                    </v-col>
                    <v-col
                      cols="12"
                      sm="6"
                      md="4"
                    >
                      <v-text-field
                        v-model="editedItem.carbs"
                        label="Carbs (g)"
                      ></v-text-field>
                    </v-col>
                    <v-col
                      cols="12"
                      sm="6"
                      md="4"
                    >
                      <v-text-field
                        v-model="editedItem.protein"
                        label="Protein (g)"
                      ></v-text-field>
                    </v-col>
                  </v-row>
                </v-container>
              </v-card-text> -->
  
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                  color="blue darken-1"
                  text
                  @click="close"
                >
                  Cancel
                </v-btn>
                <v-btn
                  color="blue darken-1"
                  text
                  @click="save"
                >
                  Save
                </v-btn>
              </v-card-actions>
            <!-- </v-card> -->
          </v-dialog>
          <v-dialog v-model="dialogDelete" max-width="500px">
            <v-card>
              <v-card-title class="text-h5" center>รายละเอียด</v-card-title>
              <v-card-actions v-for="desserts1 in desserts1" :key="desserts1.id">
                {{desserts1.id_product}}
                <v-spacer></v-spacer>
                
                <v-spacer></v-spacer>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
      </template>


       <!-- Show Status -->
      <template v-slot:[`item.id_bill`]="{ item }">
        <v-chip
         :color="getColor(item.id_bill)"
         dark
        >      
        <v-icon>watch_later</v-icon>      
       </v-chip>
      </template>


      
      <!-- Edit & Delete -->
      <template v-slot:[`item.actions`]="{ item }">
       <v-chip
         :color="getColor2(item.actions)"
         dark
        >      
        <v-icon @click="reloadPage(),deletetable(item.id_queue)">delete</v-icon>      
       </v-chip>
      </template>


      <template v-slot:[`item.ac`]="{ item }">
       <v-chip
         :color="getColor3(item.ac)"
         dark
        >      
        <v-icon @click="dialogDelete=true">receipt_long</v-icon>      
       </v-chip>
      </template>
    </v-data-table>
  </v-app>
</div>
</template>

<script>
// import axios from 'axios';
  export default {
    data: () => ({
    dialog: false,
    dialogDelete: false,
    headers: [
      {text: 'ลำดับ',align: 'start',sortable: false,value: 'id_queue'},
      { text: 'เวลาที่สั่ง', value: 'timebill' },
      { text: 'วันที่ที่สั่ง', value: 'datebill' },
      { text: 'สถานะ', value: 'id_bill' },
      { text: 'Actions', value: 'actions', sortable: false },
    { text: 'Detail', value: 'ac', sortable: false },
    ],
    desserts: [],
    desserts1: [],
   
  }),

  watch: {
    dialog (val) {
      val || this.close()
    },
     dialogDelete (val) {
      val || this.closeDelete()
    },
    
  },

    created () {
      this.consultaritems()
      this.datatDetail()
    },

  methods: {
    consultaritems(){
            fetch('http://localhost/menunoodle/queueOr.php')
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
    datatDetail(){
            fetch('http://localhost/menunoodle/queueOrDetail.php')
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{
                console.log(datosRespuesta)
                // this.menulist=[]
                // this.menulist.calories=Response
                if(typeof datosRespuesta[0].success==='undefined'){
                    this.desserts1=datosRespuesta;
                }
            }).catch(console.log)
      },
    deletetable(id_queue){
            console.log(id_queue);
            fetch('http://localhost/menunoodle/queueOr.php/?deletetablee='+id_queue)
            .then(respuesta=>respuesta.json())
            .then((desserts)=>{
              console.log(desserts)
            }).catch(console.log)
    },
    reloadPage() {
            window.location.reload();
    },

      // Color of Status
    getColor (id_bill) {
            if (id_bill == 1) return '#4CAF50'
            else return '#FF9800' 
       
    },
    getColor2(actions,){
            if(actions==actions) return 'red'
    },
    getColor3(ac){
            if(ac==ac) return '#1E88E5'
     },
  },
}
</script>