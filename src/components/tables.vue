<template>
  <div>
    <v-container fluid ma-0>
        <v-row no-gutters>
        <v-col cols="9" justify="left">
          <v-container>
            <v-layout row wrap>
              <v-col v-for="menu in menu" :key="menu.id">
                <v-card height="100%" width="250" class="text-center" color="#80CBC4">
                  <v-card-text class="text-h6" 
                    >{{ menu.id_product}}<br />{{ menu.price_product }} ฿ <br />

                    <v-btn
                      color="primary"
                      @click="addItem(menu)"
                      class="mt-2"
                      >Add</v-btn
                    >
                  </v-card-text>
                </v-card>
              </v-col>
            </v-layout>
          </v-container>
        </v-col>
<!-- //////////////////////////////////////////////////// -->
 <v-dialog v-if="item" v-model="dialogAdd" max-width="500px">
          <v-card>
            <v-card-title>
              <span class="text-h5">เพิ่มรายการ</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-form ref="form" v-model="valid" lazy-validation>
                    <v-row>
                      <v-col cols="6">
                        <v-text-field
                          v-model="item.id_product"
                          label="เมนู"
                          readonly
                        ></v-text-field>
                      </v-col>
                     
                    </v-row> 
                    <v-row>
                    <v-col cols="6">
                      <v-text-field
                        v-model="item.quantity"
                        label="จำนวนชาม"
                        type="number"
                        min="1"
                        start ="1"
                        :rules="quantityRules"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="6">
                      <v-text-field
                        v-model="item.price_product"
                        label="ราคา (฿)"
                        type="number"
                        readonly
                      ></v-text-field>
                    </v-col>
                    </v-row>
                  </v-form>
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer> 
              <v-btn
                  class="ma-2"
                  color="primary"
                  dark
                  @click="addToCart(item)"
                >
                  บันทึก
                  <v-icon
                    dark
                    right
                  >
                    mdi-checkbox-marked-circle
                  </v-icon>
                </v-btn>
              <v-btn class="ma-2"
                  color="red"
                  dark  
                  @click="clearcl"
                  >
                ยกเลิก
                <v-icon
                    dark
                    right
                  >
                    mdi-cancel
                  </v-icon>
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <v-col cols="3">
          <v-container fluid ma-0>
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
              <v-card-actions>
                
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
        <v-icon @click="addItem(menu)">receipt_long</v-icon>      
       </v-chip>
      </template>
    </v-data-table>
  </v-app>
</div>
          </v-container>
        </v-col>
<!-- //////////////////////////////////////////////////// -->

      </v-row>
    </v-container>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "menupage",
  data() {
    return {
      valid: true,
      quantityRules: [(v) => v >= 1 || "ขั้นต่ำ 1 ชาม"],
      item: [],
      dialog: false,
      dialogAdd: false,
      dialogDelete: false,
     headers: [
      { text: 'ลำดับ',align: 'start',sortable: false,value: 'id_queue'},
      { text: 'เวลาที่สั่ง', value: 'timebill' },
      { text: 'วันที่ที่สั่ง', value: 'datebill' },
      { text: 'สถานะ', value: 'id_bill' },
      { text: 'Actions', value: 'actions', sortable: false },
      { text: 'Detail', value: 'ac', sortable: false },

    ],
      menuadd:[],
      noodle:[],
      menu: [],
      desserts:[],
      editedIndex: -1,
      editedItem: {
      id_product: "",
      price_product: "",
      },
      defaultItem: {
        name_ingre:"",
        name_noo:"",
        quantity:"1"
     
      },
      ingredient: [],
      ingredients: [],
      menulist: [],
    };
  },

  computed: {
     listTable() {
      return [];
    },
    
   
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },

  created() {
    this.gettable();
    this.consultaritems();
   
   
  },

  methods: {
 

    submitData() {
      {
        if(this.total() != '0' ){
        console.log(this.menuadd);
        axios.post("http://localhost/menunoodle/menuapi14.php", {
          totalbill:this.total(),
          // id_product:this.item.id_product,
          menuadd:this.menuadd,
          // menuadd:this.menuadd()
        }).then(res => {console.log(res)}).catch(err => {console.log(err)});
      }this.cancelmenuadd() 
    
    }}, addToCart(item) {
      if(this.item.quantity  != ''){
        this.menuadd.push({
        id_product:item.id_product,
        // id_product:item.id_product,
        name_noo:item.name_noo,
        name_ingre:item.name_ingre,
        quantity:item.quantity,
        price_product:item.price_product,
        total:item.quantity * item.price_product,
        }),
      this.clear()}console.log(item)},
    
    
    
    // submitData2(){
    //   console.log(this.item.id_product)
    //   axios.post("http://localhost/menunoodle/menuapi15.php",{
    //     id_product:this.item.id_product,
    //     // name_noo: this.noodle.name_noo,
    //     // name_ingre: this.ingredients.name_ingre,
    //     // quantity: this.item.quantity,
    //     // price_product:this.item.price_product

    //   })

      

    // },

    gettable() {
      axios.get("http://localhost/menunoodle/queueOrDetail.php").then((res) => {
        this.menu = res.data;
      });
    },
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
    //  consultaritems(){
    //         fetch('http://localhost/menunoodle/queueOrDetail.php')
    //         .then(respuesta=>respuesta.json())
    //         .then((datosRespuesta)=>{
    //             console.log(datosRespuesta)
    //             if(typeof datosRespuesta[0].success==='undefined'){
    //                 this.ingredients=datosRespuesta;
    //             }
    //         }).catch(console.log)},
            //  consultaritems2(){
            // fetch('http://localhost/menunoodle/menuapi10.php')
            // .then(respuesta=>respuesta.json())
            // .then((datosRespuesta)=>{
            //     console.log(datosRespuesta)
            //     // this.menulist=[]
            //     // this.menulist.calories=Response
            //     if(typeof datosRespuesta[0].success==='undefined'){
            //         this.noodle=datosRespuesta;
            //     }
            // }).catch(console.log)},

    editItem(item) {
      this.editedIndex = this.menu.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      this.editedIndex = this.menuadd.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      this.menuadd.splice(this.editedIndex, 1);
      this.closeDelete();
      this.dialogDelete = false;
    },

    close() {
      this.dialogAdd = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.menu[this.editedIndex], this.editedItem);
      } else {
        this.menu.push(this.editedItem);
      }
      this.close();
    },
     addItem(item) {
      this.item = item;
      this.dialogAdd = true;
      console.log(item);
    },
   
      
      clear () {
      this.item.quantity = ''
      this.item.name_noo = ''
      this.item.name_ingre = null
      this.dialogAdd = !this.dialogAdd;
    },
    clearcl () {
      this.item.quantity = ''
      this.item.name_noo = ''
      this.item.name_ingre = null
      this.dialogAdd = !this.dialogAdd;
      
    },total(){
      var sum=0;
      this.menuadd.forEach(function(item){
        sum+=item.total
      })
      return sum
      
    },cancelmenuadd() {
    this.menuadd = [];
    },checkid(id_product){
      console.log(id_product)
    },
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
    
     

      
    // consultaritems(){
    //         fetch('http://localhost/menunoodle/menuapi2.php')
    //         .then(respuesta=>respuesta.json())
    //         .then((datosRespuesta)=>{
    //             console.log(datosRespuesta)
    //             this.menulist=[]
    //             // this.menulist.calories=Response
    //             if(typeof datosRespuesta[0].success==='undefined'){
    //                 this.desserts=datosRespuesta;
    //             }
    //         }).catch(console.log)}
  },
};
</script>

<style>
.a {
  font-size: 5rem;

}
</style>