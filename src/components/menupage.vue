<template>
  <div>
    <v-container fluid ma-0>
      <v-row wrap>
        <v-col cols="9">
          <v-container>
            <v-row wrap>
              <v-col v-for="menu in menu" :key="menu.id">
                <v-card height="100%" width="250" class="text-center" >
                  <v-img
                    
                    height="200px"
                    width="250px"
                  ></v-img>
                  <v-card-text class="text-h6">{{menu.name12}}<br>{{menu.price}} ฿ <br>
                  <v-btn color="primary" class="mt-2">ADD</v-btn></v-card-text>                 
                </v-card>
              </v-col>
            </v-row>
          </v-container>
        </v-col>

        <v-col cols="3">
         <v-container fluid ma-0 wrap>
            <div id="app">
              <v-app id="inspire">
                <v-data-table
                  :headers="headers"
                  :items="menu"
                  sort-by="calories"
                  class="elevation-1"
                >
                  <template v-slot:top>
                    <v-toolbar flat>
                      <v-toolbar-title>Bill</v-toolbar-title>
                      <v-divider class="mx-4" inset vertical></v-divider>
                      <v-spacer></v-spacer>
                      <v-dialog v-model="dialog" max-width="500px">
                        <template v-slot:activator="{ on, attrs }">
                          <v-btn
                            color="primary"
                            dark
                            class="mb-2"
                            v-bind="attrs"
                            v-on="on"
                          >
                            เพิ่มรายการ
                          </v-btn>
                        </template>
                        <v-card>
                          <v-card-title>
                            <span class="text-h5">{{ formTitle }}</span>
                          </v-card-title>

                          <v-card-text>
                            <v-container>
                              <v-row>
                                <v-col cols="12" sm="6" md="4">
                                  <v-text-field
                                    v-model="editedItem.name"
                                    label="name"
                                  ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" md="4">
                                  <v-text-field
                                    v-model="editedItem.noodles"
                                    label="noodles"
                                  ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" md="4">
                                  <v-text-field
                                    v-model="editedItem.vegetable"
                                    label="vegetable"
                                  ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" md="4">
                                  <v-text-field
                                    v-model="editedItem.quantity"
                                    label="quantity"
                                  ></v-text-field>
                                </v-col>
                                <!-- <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="editedItem.date"
                          label="date"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="editedItem.time"
                          label="time"
                        ></v-text-field>
                      </v-col> -->
                                <v-col cols="12" sm="6" md="4">
                                  <v-text-field
                                    v-model="editedItem.price"
                                    label="price (฿)"
                                  ></v-text-field>
                                </v-col>
                              </v-row>
                            </v-container>
                          </v-card-text>

                          <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="close">
                              Cancel
                            </v-btn>
                            <v-btn
                              color="blue darken-1"
                              text
                              @click="submitData"
                            >
                              Save
                            </v-btn>
                          </v-card-actions>
                        </v-card>
                      </v-dialog>
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
                    <v-icon small class="mr-2" @click="editItem(item)">
                      mdi-pencil
                    </v-icon>
                    <v-icon small @click="deleteItem(item)">
                      mdi-delete
                    </v-icon>
                  </template>
                  <template v-slot:no-data> </template>
                </v-data-table>
              </v-app>
            </div>
          </v-container>
        </v-col>
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
      dialog: false,
      dialogDelete: false,
      headers: [
        {
          text: "Name",
          align: "start",
          sortable: false,
          value: "name12",
        },
        { text: "Quantity", value: "quantity" },
        { text: "Price", value: "price" },
        /* { text: "Carbs (g)", value: "carbs" },
        { text: "Protein (g)", value: "protein" },*/
        { text: "Actions", value: "actions", sortable: false },
      ],
      menu: [],
      editedIndex: -1,
      editedItem: {
        name: "",
        noodles: "",
        vegetable: "",
        quantity: "",
        date: "",
        time: "",
        price: "",
      },
      defaultItem: {
        // name: "",
        // noodles: "",
        // vegetable: "",
        // quantity: 0,
        // date: "",
        // time: "",
        // price: 0,
      },

      // menulist: [
      //   { id: 1, name: "ก๋วยเตี๋ยวหมูน้ำใส", price: "80", picture: "https://i0.wp.com/goodlifeupdate.com/app/uploads/2021/04/image-131-edited.png" },
      //   { id: 2, name: "ก๋วยเตี๋ยวหมูน้ำตก", price: "90", picture: "https://envato-shoebox-0.imgix.net/c5ce/722f-b5fb-4917-87b4-67a65d95a8bb/DSC_5037.jpg?auto=compress%2Cformat&fit=max&mark=https%3A%2F%2Felements-assets.envato.com%2Fstatic%2Fwatermark2.png&markalign=center%2Cmiddle&markalpha=18&w=700&s=78ff5709f2f5a29637fed7f8ec23aece" },
      //   { id: 3, name: "ก๋วยเตี๋ยวหมูต้มยำ", price: "70", picture: "https://envato-shoebox-0.imgix.net/a8e4/9a25-dfa0-40e1-a766-6cc80d321954/DSC_4951.jpg?auto=compress%2Cformat&fit=max&mark=https%3A%2F%2Felements-assets.envato.com%2Fstatic%2Fwatermark2.png&markalign=center%2Cmiddle&markalpha=18&w=1600&s=92844d3783ff448a0b2064a8a192a114" },
      //   { id: 4, name: "ก๋วยเตี๋ยวหมูเย็นตาโฟ", price: "90", picture: "https://images.immediate.co.uk/production/volatile/sites/30/2021/05/Roast-broccoli-and-sesame-ramen-noodle-bowls-f57730e.jpg?quality=90&resize=556,505" },
      //   { id: 5, name: "ก๋วยเตี๋ยวหมูต้มยำแห้ง", price: "100", picture: "https://media.discordapp.net/attachments/910553031328800770/936364797350518784/image_750x_5d691a8d5f2f9.png" },
      //   { id: 6, name: "ก๋วยเตี๋ยวปลา", price: "110", picture: "https://www.kitchensanctuary.com/wp-content/uploads/2020/12/Quick-Chicken-Ramen-square-FS-22.jpg" },
      //   { id: 7, name: "ก๋วยเตี๋ยวต้มยำทะเล", price: "75", picture: "https://miro.medium.com/max/1200/1*ZF58Vom2-CpbBEEhIt9TGg.jpeg" },
      //   { id: 8, name: "ก๋วยเตี๋ยวหมูน้ำใสพิเศษ", price: "85", picture: "https://cdn.discordapp.com/attachments/910553031328800770/936365506905116693/hww1zujd6sgvpfpfpfm6eow1qldp6kdsefonjw5w.png" },
      //   { id: 9, name: "ก๋วยเตี๋ยวไก่มะระ", price: "95", picture: "https://cdn.discordapp.com/attachments/910553031328800770/936365410901696602/shutterstock_67514674.png" },
      // ],
    };
  },

  computed: {
    formTitle() {
      return this.editedIndex === -1
        ? "เพิ่มรายการก๋วยเตี๋ยว"
        : "แก้ไขรายการก๋วยเตี๋ยว";
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
   
  },

  methods: {
    /* initialize() {
      this.menu = [
        {
          name: "sdf",
          noodles: "sdsd",
          vegetable: "sdf",
          quantity: 0,
          date: 0,
          time: 0,
          price: 0,
        },
      ];
    }, */

    submitData(e) {
      e.preventDefault();
      if (
        this.editedItem.noodles != "" &&
        this.editedItem.vegetable != "" &&
        this.editedItem.quantity != "" &&
        this.editedItem.price != ""
      ) {
        console.log("complete");
        axios.post("http://localhost/vue/table.php/", {
          name: this.editedItem.name,
          noodles: this.editedItem.noodles,
          vegetable: this.editedItem.vegetable,
          quantity: this.editedItem.quantity,
          date: this.editedItem.date,
          time: this.editedItem.time,
          price: this.editedItem.price,
        });
        this.save();
        this.dialog = false;
      }
    },

    gettable() {
      axios.get("http://localhost/menunoodle/menuapi2.php").then((res) => {
        this.menu = res.data;
      });
    },

    editItem(item) {
      this.editedIndex = this.menu.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      this.editedIndex = this.menu.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      this.menu.splice(this.editedIndex, 1);
      this.closeDelete();
      this.dialogDelete = false;
    },

    close() {
      this.dialog = false;
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