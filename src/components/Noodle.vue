<template >
 <div id="app">
  <v-app id="inspire">
    <v-data-table
      :headers="headers"
      :items="desserts"
      sort-by="calories"
      class="elevation-1"
    >
  
      <template v-slot:top>
        <v-toolbar
          flat
        >
          <v-toolbar-title>เส้น</v-toolbar-title>
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
            <template v-slot:activator="{ on, attrs }">
              <v-btn
                color="primary"
                dark
                class="mb-2"
                v-bind="attrs"
                v-on="on"
              >
                เพิ่มเส้น
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
                        v-model="editedItem.name_noo"
                        label="ชื่อเส้น"
                      ></v-text-field>
                    </v-col>
                    <v-col
                      cols="12"
                      sm="6"
                      md="4"
                    >
                      <v-text-field
                        v-model="editedItem.quantity_noo"
                        label="จำนวน(g)"
                        type="number"
                      ></v-text-field>
                    </v-col>
                    <!-- <v-col
                      cols="12"
                      sm="6"
                      md="4"
                    >
                      <v-text-field
                        v-model="editedItem.date"
                        label="Fat (g)"
                        
                      ></v-text-field>
                    </v-col>
                    <v-col
                      cols="12"
                      sm="6"
                      md="4"
                    >
                      <v-text-field
                        v-model="editedItem.data"
                        label="Carbs (g)"
                        
                      ></v-text-field>
                    </v-col> -->

                    
                    <!-- ส่วนของเวลา -->
                    <v-col
                      cols="12"
                      sm="6"
                      md="4"
                    >
                      <v-menu
                        ref="menu"
                        v-model="menu"
                        :close-on-content-click="false"
                        :return-value.sync="editedItem.date_noo"
                        transition="scale-transition"
                        offset-y
                        min-width="auto"
                      >
                        <template v-slot:activator="{ on, attrs }">
                          <v-text-field
                            v-model="editedItem.date_noo"
                            label="วันผลิต"
                            prepend-icon="mdi-calendar"
                            readonly
                            v-bind="attrs"
                            v-on="on"
                            locale = "th"
                          ></v-text-field>
                        </template>
                        <v-date-picker
                          v-model="editedItem.date_noo"
                          no-title
                          scrollable
                          locale = "th"
                        >
                          <v-spacer></v-spacer>
                          <v-btn
                            text
                            color="primary"
                            @click="menu = false"
                          >
                            Cancel
                          </v-btn>
                          <v-btn
                            text
                            color="primary"
                            @click="$refs.menu.save(editedItem.date_noo)"
                          >
                            OK
                          </v-btn>
                        </v-date-picker>
                      </v-menu>
                    </v-col>
              <v-spacer></v-spacer>
                    <v-col
                      cols="12"
                      sm="6"
                      md="4"
                    >
                      <v-menu
                        ref="menu2"
                        v-model="menu2"
                        :close-on-content-click="false"
                        :return-value.sync="editedItem.exp_noo"
                        transition="scale-transition"
                        offset-y
                        min-width="auto"
                      >
                        <template v-slot:activator="{ on, attrs }">
                          <v-text-field
                            v-model="editedItem.exp_noo"
                            label="วันหมดอายุ"
                            prepend-icon="mdi-calendar"
                            readonly
                            v-bind="attrs"
                            v-on="on"
                            locale = "th"
                          ></v-text-field>
                        </template>
                        <v-date-picker
                          v-model="editedItem.exp_noo"
                          no-title
                          scrollable
                          locale = "th"
                          :min="nowDate" 
                          format="YYYY-MM-DD"
                          
                        >
                          <v-spacer></v-spacer>
                          <v-btn
                            text
                            color="primary"
                            @click="menu2 = false"

                          >
                            Cancel
                          </v-btn>
                          <v-btn
                            text
                            color="primary"
                            @click="$refs.menu2.save(editedItem.exp_noo)"
                          >
                            OK
                          </v-btn>
                        </v-date-picker>
                      </v-menu>
                      <!-- สิ้นสุดส่วนของเวลา -->
                    </v-col>
                  </v-row>
                </v-container>
              </v-card-text>
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
                  @click="sendData()"
                >
                  save
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
          <v-dialog v-model="dialogDelete" max-width="500px">
            <v-card>
              <v-card-title class="text-h5">Are you sure you want to delete this item?</v-card-title>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
                <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
                <v-spacer></v-spacer>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
       
      </template>
      <template v-slot:[`item.actions`]="{ item }">
        <v-icon
          small
          class="mr-2"
          @click="editItem(item)"
        >
          mdi-pencil
        </v-icon>
        <v-icon
          small
          @click="reloadPage(),deletetable(item.id_noo)"
        >
          mdi-delete
        </v-icon>
      </template>
       <template v-slot:[`item.exp_noo`]="{item }">
       <v-chip 
         :color="getColor3(item.exp_noo)"
         dark
        >
        
        
        {{item.exp_noo}} 
       </v-chip>
      </template>
       <template v-slot:[`item.date_noo`]="{item }">
       <v-chip 
         :color="getColor4(item.date_noo)"
         dark
        >
        
        
        {{item.date_noo}} 
       </v-chip>
      </template>
    </v-data-table>
  </v-app>
</div>
</template>

<script>
import axios from 'axios';
// import moment from 'moment';
  export default {
data() {
  return{
    dialog: false,
    dialogDelete: false,
    due:null,
    nowDate: new Date().toISOString().slice(0,10),
    date_noo: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
    exp_noo: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
    menu: false,
    modal: false,
    modal1: false,
    menu2: false,
    // rawmaterial:{
    //     name_noo:"",
    //     quantity_noo:"",
    //     data1:"",
    //     exp_noo:"",
    // },
    headers: [
      {
        text: 'ชื่อเส้น',
        align: 'start',
        sortable: false,
        value: 'name_noo',
      },
      { text: 'จำนวน(g)', value: 'quantity_noo' },
      { text: 'วันที่ผลิต', value: 'date_noo' },
      { text: 'วันหมดอายุ', value: 'exp_noo' },
      { text: 'Actions', value: 'actions', sortable: false },
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      name_noo: '',
      quantity_noo: '',
      date_noo: '',
      exp_noo: '',
    },
    defaultItem: {
      name_noo: '',
      quantity_noo: '',
      date_noo: '',
      exp_noo: '',
    },
  }},

  computed: {
    formTitle () {
      return this.editedIndex === -1 ? 'เพิ่มเส้น' : 'แก้ไขเส้น'
    },
    // computedDateFormattedMomentjs() {
    //   return this.date_noo ? moment(this.date_noo).format('D M y'):''
    // },
    
  },

  watch: {
    dialog (val) {
      val || this.close()
    },
    dialogDelete (val) {
      val || this.closeDelete()
    },
  },

  created () {
    // this.initialize()
    this.consultaritems()
  },

  methods: {
    initialize () {
      this.desserts = [
        {
            name_noo: 'เนื้อหมู',
            quantity_noo: 0,
            date_noo: 0,
            exp_noo: 159,
         
        },
        {
            name_noo: 'เนืื้อวัว',
            quantity_noo: 0,
            date_noo: 0,
            exp_noo: 159,
        },
        {
            name_noo: 'ตับ',
            quantity_noo: 0,
            date_noo: 0,
            exp_noo: 159,
        },
        {
            name_noo: 'ลูกชิ้น',
            quantity_noo: 0,
            date_noo: 5,
            exp_noo: 5,
        },
      ]
    },
   

    editItem (item) {
      this.editedIndex = this.desserts.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialog = true
    },

    deleteItem (item) {
      this.editedIndex = this.desserts.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialogDelete = true
    },

    deleteItemConfirm () {
      this.desserts.splice(this.editedIndex, 1)
      this.closeDelete()
    },

    close () {
      this.dialog = false
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      })
    },

    closeDelete () {
      this.dialogDelete = false
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      })
    },

    save () {
      if (this.editedIndex > -1) {
        Object.assign(this.desserts[this.editedIndex], this.editedItem)
      } else {
        this.desserts.push(this.editedItem)
      }
      this.close()
    },
     sendData(){
        console.log("ส่งข้อมูลแล้ว")
        // if(this.rawmaterial.name_noo  != '' && this.rawmaterial.quantity_noo!= '' && this.rawmaterial.date_noo != '' && this.rawmaterial.exp_noo ){
        axios.post("http://localhost/menunoodle/menuapi5.php", {
        name_noo:this.editedItem.name_noo,
        quantity_noo:this.editedItem.quantity_noo,
        date_noo:this.editedItem.date_noo,
        exp_noo:this.editedItem.exp_noo,
        })
        this.save();this.reloadPage()
  },
      consultaritems(){
            fetch('http://localhost/menunoodle/menuapi6.php')
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{
                console.log(datosRespuesta)
                // this.menulist.calories=Response
                if(typeof datosRespuesta[0].success==='undefined'){
                    this.desserts=datosRespuesta;
                }
            }).catch(console.log)
},    reloadPage() {
          window.location.reload();
          },
      deletetable(id_noo){
         console.log(id_noo);
         fetch('http://localhost/menunoodle/menuapi6.php/?deletenoodle='+id_noo)
            .then(respuesta=>respuesta.json())
            .then((desserts)=>{
              console.log(desserts)
              
            }).catch(console.log)
          },
       getColor3(exp_noo){
         if(exp_noo<=this.exp_noo) return 'red'
     }, getColor4(date_noo){
         if(date_noo==date_noo) return 'green'
     }, 
          }
}
</script>