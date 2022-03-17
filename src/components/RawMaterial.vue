<template >
  <div id="app">
    <v-app id="inspire">
      <v-data-table
        :headers="headers"
        :items="ingre"
        sort-by="exp_ingre"
        class="elevation-1"
      >
        <template v-slot:top>
          <v-toolbar flat>
            <v-toolbar-title>วัตถุดิบ</v-toolbar-title>
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
                  เพิ่มวัตถุดิบ
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
                          v-model="editedItem.name_ingre"
                          label="ชื่อวัตถุดิบ"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="editedItem.quantity_ingre"
                          label="จำนวน(g)"
                          type="number"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-menu
                          ref="menu"
                          v-model="menu"
                          :close-on-content-click="false"
                          :return-value.sync="editedItem.date_ingre"
                          transition="scale-transition"
                          offset-y
                          min-width="auto"
                        >
                          <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                              v-model="editedItem.date_ingre"
                              label="วันผลิต"
                              prepend-icon="mdi-calendar"
                              readonly
                              v-bind="attrs"
                              v-on="on"
                              locale="th"
                            ></v-text-field>
                          </template>
                          <v-date-picker
                            v-model="editedItem.date_ingre"
                            no-title
                            scrollable
                            locale="th"
                          >
                            <v-spacer></v-spacer>
                            <v-btn text color="primary" @click="menu = false">
                              Cancel
                            </v-btn>
                            <v-btn
                              text
                              color="primary"
                              @click="$refs.menu.save(editedItem.date_ingre)"
                            >
                              OK
                            </v-btn>
                          </v-date-picker>
                        </v-menu>
                      </v-col>
                      <v-spacer></v-spacer>
                      <v-col cols="12" sm="6" md="4">
                        <v-menu
                          ref="menu2"
                          v-model="menu2"
                          :close-on-content-click="false"
                          :return-value.sync="editedItem.exp_ingre"
                          transition="scale-transition"
                          offset-y
                          min-width="auto"
                        >
                          <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                              v-model="editedItem.exp_ingre"
                              label="วันหมดอายุ"
                              prepend-icon="mdi-calendar"
                              readonly
                              v-bind="attrs"
                              v-on="on"
                              locale="th"
                            ></v-text-field>
                          </template>
                          <v-date-picker
                            v-model="editedItem.exp_ingre"
                            no-title
                            scrollable
                            locale="th"
                            :min="nowDate"
                            format="YYYY-MM-DD"
                          >
                            <v-spacer></v-spacer>
                            <v-btn text color="primary" @click="menu2 = false">
                              Cancel
                            </v-btn>
                            <v-btn
                              text
                              color="primary"
                              @click="$refs.menu2.save(editedItem.exp_ingre)"
                            >
                              OK
                            </v-btn>
                          </v-date-picker>
                        </v-menu>
                      </v-col>
                    </v-row>
                  </v-container>
                </v-card-text>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="blue darken-1" text @click="close">
                    Cancel
                  </v-btn>
                  <v-btn color="blue darken-1" text @click="sendDataIngre()">
                    save
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
            <v-dialog v-model="dialogDelete" max-width="500px">
              <v-card>
                <v-card-title class="text-h5"
                  >Are you sure you want to delete this item?</v-card-title
                >
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="blue darken-1" text @click="closeDelete"
                    >Cancel</v-btn
                  >
                  <v-btn color="blue darken-1" text @click="deleteItemConfirm"
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
          <v-icon small @click="reloadPage(), deleteDataIngre(item.id_ingre)">
            mdi-delete
          </v-icon>
        </template>
        <template v-slot:[`item.exp_ingre`]="{ item }">
          <v-chip :color="getColor3(item.exp_ingre)" dark>
            {{ item.exp_ingre }}
          </v-chip>
        </template>
        <template v-slot:[`item.date_ingre`]="{ item }">
          <v-chip :color="getColor4(item.date_ingre)" dark>
            {{ item.date_ingre }}
          </v-chip>
        </template>
      </v-data-table>
    </v-app>
  </div>
</template>

<script>
import axios from "axios";
// import moment from 'moment';
export default {
  data() {
    return {
      dialog: false,
      dialogDelete: false,
      due: null,
      nowDate: new Date().toISOString().slice(0, 10),
      date_ingre: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
        .toISOString()
        .substr(0, 10),
      exp_ingre: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
        .toISOString()
        .substr(0, 10),
      menu: false,
      modal: false,
      modal1: false,
      menu2: false,
      headers: [
        {
          text: "ชื่อวัตถุดิบ",
          align: "start",
          sortable: false,
          value: "name_ingre",
        },
        { text: "จำนวน(g)", value: "quantity_ingre" },
        { text: "วันที่ผลิต", value: "date_ingre" },
        { text: "วันหมดอายุ", value: "exp_ingre" },
        { text: "Actions", value: "actions", sortable: false },
      ],
      ingre: [],
      editedIndex: -1,
      editedItem: {
        name_ingre: "",
        quantity_ingre: "",
        date_ingre: "",
        exp_ingre: "",
      },
      defaultItem: {
        name_ingre: "",
        quantity_ingre: "",
        date_ingre: "",
        exp_ingre: "",
      },
    };
  },

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "เพิ่มวัตถุดิบ" : "แก้ไขวัตถุดิบ";
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
    this.getDataIngre();
  },

  methods: {
    editItem(item) {
      this.editedIndex = this.ingre.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      this.editedIndex = this.ingre.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      this.ingre.splice(this.editedIndex, 1);
      this.closeDelete();
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
        Object.assign(this.ingre[this.editedIndex], this.editedItem);
      } else {
        this.ingre.push(this.editedItem);
      }
      this.close();
    },
    sendDataIngre(){
      console.log("ส่งข้อมูลแล้ว");
      if(this.editedItem.name_ingre  != '' && this.editedItem.quantity_ingre!= '' && this.editedItem.date_ingre != '' && this.editedItem.exp_ingre ){
      axios.post("http://localhost/menunoodle/sendDataingre.php", {
        name_ingre: this.editedItem.name_ingre,
        quantity_ingre: this.editedItem.quantity_ingre,
        date_ingre: this.editedItem.date_ingre,
        exp_ingre: this.editedItem.exp_ingre,
      });
      this.save();
      this.reloadPage();}
    },
    getDataIngre() {
      fetch("http://localhost/menunoodle/fetchIngredients.php")
        .then((respuesta) => respuesta.json())
        .then((datosRespuesta) => {
          console.log(datosRespuesta);
          // this.menulist.calories=Response
          if (typeof datosRespuesta[0].success === "undefined") {
            this.ingre = datosRespuesta;
          }
        })
        .catch(console.log);
    },
    reloadPage() {
      window.location.reload();
    },
    deleteDataIngre(id_ingre) {
      console.log(id_ingre);
      fetch(
        "http://localhost/menunoodle/fetchIngredients.php/?deletetablee=" + id_ingre
      )
        .then((respuesta) => respuesta.json())
        .then((ingre) => {
          console.log(ingre);
        })
        .catch(console.log);
    },
    getColor3(exp_ingre) {
      if (exp_ingre <= this.exp_ingre) return "red";
    },
    getColor4(date_ingre) {
      if (date_ingre == date_ingre) return "green";
    },
  },
};
</script>