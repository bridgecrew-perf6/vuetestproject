<template>
  <div>
    <v-container fluid ma-0>
      <v-row no-gutters>
        <v-col cols="9" justify="left">
          <v-container>
            <v-layout row wrap>
              <v-col v-for="product in product" :key="product.id">
                <v-card
                  height="100%"
                  width="250"
                  class="text-center"
                  color="#80CBC4"
                >
                  <v-card-text class="text-h6"
                    >{{ product.name_product }}<br />{{ product.price_product }} ฿
                    <br />
                    <v-btn color="primary" @click="addItem(product)" class="mt-2"
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
                    <v-col cols="12">
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
                          start="1"
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
              <v-btn class="ma-2" color="primary" dark @click="addToCart(item)">
                บันทึก
                <v-icon dark right> mdi-checkbox-marked-circle </v-icon>
              </v-btn>
              <v-btn class="ma-2" color="red" dark @click="clearcl">
                ยกเลิก
                <v-icon dark right> mdi-cancel </v-icon>
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
                  :items="menuAdd"
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
                        @click="sendDataBill"
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
                    <v-icon small @click="deleteItem(item)">
                      mdi-delete
                    </v-icon>
                  </template>
                  <template slot="body.append">
                    <tr class="pink--text">
                      <th class="title">รวม</th>
                      <th class="title">{{ total() }}</th>
                      <th class="title">บาท</th>
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
        { text: "", value: "actions", sortable: false },
      ],
      menuAdd: [],
      noodle: [],
      product: [],
      editedIndex: -1,
      editedItem: {
        name_product: "",
        price_product: "",
      },
      defaultItem: {
        name_ingre: "",
        name_noo: "",
        quantity: "1",
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
    this.getDataProduct();
    this.getDataIngredients();
    this.getDataNoodle();
  },

  methods: {
    sendDataBill() {
      {
        if (this.total() != "0") {
          console.log(this.menuAdd);
          axios
            .post("http://localhost/menunoodle/sendDataBill.php", {
              totalbill: this.total(),
              menuAdd: this.menuAdd,
              })
            .then((res) => {
              console.log(res);
            })
            .catch((err) => {
              console.log(err);
            });
        }
        this.cancelmenuAdd();
      }
    },
    addToCart(item) {
      if (this.item.quantity != "") {
        this.menuAdd.push({
          id_product: item.id_product,
          name_product: item.name_product,
          name_noo: item.name_noo,
          name_ingre: item.name_ingre,
          quantity: item.quantity,
          price_product: item.price_product,
          total: item.quantity * item.price_product,
        }),
          this.clear();
      }
      console.log(item);
    },

    getDataProduct() {
      axios.get("http://localhost/menunoodle/fetchProduct.php").then((res) => {
        this.product = res.data;
      });
    },
    getDataIngredients() {
      fetch("http://localhost/menunoodle/fetchIngredients.php")
        .then((respuesta) => respuesta.json())
        .then((datosRespuesta) => {
          console.log(datosRespuesta);
          if (typeof datosRespuesta[0].success === "undefined") {
            this.ingredients = datosRespuesta;
          }
        })
        .catch(console.log);
    },
    getDataNoodle() {
      fetch("http://localhost/menunoodle/fetchNoodle.php")
        .then((respuesta) => respuesta.json())
        .then((datosRespuesta) => {
          console.log(datosRespuesta);
          // this.menulist=[]
          // this.menulist.calories=Response
          if (typeof datosRespuesta[0].success === "undefined") {
            this.noodle = datosRespuesta;
          }
        })
        .catch(console.log);
    },

    deleteItem(item) {
      this.editedIndex = this.menuAdd.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      this.menuAdd.splice(this.editedIndex, 1);
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

    addItem(item) {
      this.item = item;
      this.dialogAdd = true;
      console.log(item);
    },

    clear() {
      this.item.quantity = "";
      this.item.name_noo = "";
      this.item.name_ingre = null;
      this.dialogAdd = !this.dialogAdd;
    },
    clearcl() {
      this.item.quantity = "";
      this.item.name_noo = "";
      this.item.name_ingre = null;
      this.dialogAdd = !this.dialogAdd;
    },
    total() {
      var sum = 0;
      this.menuAdd.forEach(function (item) {
        sum += item.total;
      });
      return sum;
    },
    cancelmenuAdd() {
      this.menuAdd = [];
    },
  },
};
</script>

<style>
.a {
  font-size: 5rem;
}
</style>