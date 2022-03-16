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
                    >{{ menu.name_product}}<br />{{ menu.price_product }} ฿ <br />
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
                          v-model="item.name_product"
                          label="เมนู"
                          readonly
                        ></v-text-field>
                      </v-col>
                      <v-col cols="6">
                        <v-select
                        v-model="item.name_noo"
                        :items="noodle"
                        attach
                        item-text="name_noo"
                        item-value="id"
                        label="เลือกเส้น"
                        return-object
                        
                        
                        ></v-select>
                      </v-col>
                    </v-row> 
                    <v-col cols="12" >
                      <v-select
                        v-model="item.name_ingre"
                        :items="ingredients"
                        attach
                        item-text="name_ingre"
                        item-value="id"
                        chips
                        label="ส่วนผสม"
                        return-object
                        multiple
                      ></v-select>
                    </v-col>
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
                  :items="menuadd"
                  class="elevation-1"
                >
                  <template v-slot:top>
                    <v-toolbar flat>
                      <v-toolbar-title>Bill</v-toolbar-title>
                      <v-divider class="mx-4" inset vertical></v-divider>
                      <v-spacer></v-spacer>
                          <v-btn
                            color="primary"
                            dark
                            class="mb-2"
                            @click="submitData"
                          >
                            เพิ่มรายการก๋วยเตี๋ยว
                          </v-btn>
                       
                      
                      <v-dialog v-model="dialogDelete" max-width="500px">
                        <v-card>
                          <v-card-title class="text-h5"
                            >Are you sure you want to delete this
                            item?</v-card-title
                          >
                          <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn
                              color="blue darken-1"
                              text
                              @click="closeDelete"
                              >Cancel</v-btn
                            >
                            <v-btn
                              color="blue darken-1"
                              text
                              @click="deleteItemConfirm"
                              >OK</v-btn
                            >
                            <v-spacer></v-spacer>
                          </v-card-actions>
                        </v-card>
                      </v-dialog>
                    </v-toolbar>
                  </template>
                  <template v-slot:[`item.actions`]="{ item }">
                    <v-icon small @click="checkid(item.id_product)">
                      mdi-delete
                    </v-icon>
                  </template>
                   <template slot="body.append" >
                    <tr class="pink--text" >
                        <th class="title" >รวม</th>
                        <th class="title">{{total()}}</th>
                        <th class="title" >บาท</th>
                        
                    </tr>
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
        {
          text: "เมนู",
          align: "start",
          value: "name_product",
        },
        { text: "จำนวน", value: "quantity" },
        { text: "ราคา", value: "price_product" }, 
        { text: "รวม", value: "total" },
        { text: "555", value: "actions", sortable: false },
        
        
      ],
      menuadd:[],
      noodle:[],
      menu: [],
      editedIndex: -1,
      editedItem: {
      name_product: "",
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
    this.consultaritems2()
   
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
        name_product:item.name_product,
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
      axios.get("http://localhost/menunoodle/menuapi2.php").then((res) => {
        this.menu = res.data;
      });
    },
     consultaritems(){
            fetch('http://localhost/menunoodle/menuapi8.php')
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{
                console.log(datosRespuesta)
                if(typeof datosRespuesta[0].success==='undefined'){
                    this.ingredients=datosRespuesta;
                }
            }).catch(console.log)},
             consultaritems2(){
            fetch('http://localhost/menunoodle/menuapi10.php')
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{
                console.log(datosRespuesta)
                // this.menulist=[]
                // this.menulist.calories=Response
                if(typeof datosRespuesta[0].success==='undefined'){
                    this.noodle=datosRespuesta;
                }
            }).catch(console.log)},

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
    }
    
     

      
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