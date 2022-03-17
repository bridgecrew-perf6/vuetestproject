<template>
  <div id="app">
    <v-app id="inspire">
      <v-data-table
        :headers="headers"
        :items="desserts"
        sort-by=""
        class="elevation-1"
        group-by="ลำดับ"
       
      >
        <template v-slot:top>
          <v-toolbar flat>
            <v-toolbar-title>Order</v-toolbar-title>
            <v-divider class="mx-4" inset vertical></v-divider>
            <v-spacer></v-spacer>
            <v-dialog v-model="dialog" max-width="500px"> </v-dialog>
            <v-dialog v-model="dialogDelete" max-width="500px">
              <v-card>
                <v-card-title class="text-h5" center>รายละเอียด</v-card-title>
                <!-- <v-card-actions> -->
                  <v-card-actions
                  v-for="(desserts3, index) in desserts3"
                  :key="desserts3.id_bill"
                >
                  <v-col row>
                    <!-- <v-col v-if="index == 0" row> -->
                    <div>{{ index }}</div>
                    <div>{{ desserts3.name_product }}</div>
                  </v-col>
                  <div>{{ desserts3.quantity }}</div>
                  <!-- <div v-if="index == 0">{{ desserts3.quantity }}</div> -->
                  <v-col row>ชาม</v-col>
                  <!-- <v-col v-if="index == 0" row>ชาม</v-col> -->
                  <v-spacer></v-spacer>
                  <v-spacer></v-spacer>
                </v-card-actions>
              </v-card>
            </v-dialog>
          </v-toolbar>
        </template>

        <!-- vEdit & Delete -->
        <template v-slot:[`item.actions`]="{ item }">
          <v-chip :color="getColor2(item.actions)" dark>
            <v-icon @click="reloadPage(), deletetable(item.id_bill)"
              >delete</v-icon
            >
          </v-chip>
        </template>

        <!-- <template v-slot:[`item.ac`]="{ item }">
          <v-chip :color="getColor3(item.ac)" dark>
            <v-icon @click="getItemDetails(index)">receipt_long</v-icon>
          </v-chip>
        </template> -->
          <!-- <v-icon @click="dialogDelete = true">receipt_long</v-icon> -->
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
      { text: "ลำดับ", align: "start", sortable: false, value: "ลำดับ" },
      { text: "เวลาที่สั่ง", value: "timebill" },
      { text: "วันที่ที่สั่ง", value: "datebill" },
      // { text: 'สถานะ', value: 'id_bill' },
      { text: "รายละเอียด", value: "id_product", sortable: false },
      { text: "จำนวน", value: "quantity"},
      { text: "", value: "actions", sortable: false },
    ],
    desserts: [],
    desserts1: [],
    desserts2: [],
    desserts3: [],
    orderData: [],
  }),
  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },
  created() {
    this.consultaritems();
    // this.getOrderTime();
    // this.getOrderDetails();
    // console.log(111, orderData)
  },
  async mounted() {
    // console.log(111, this.dialogDelete);
    this.orderData = await [...this.desserts2, ...this.desserts3];
    console.log('222 orderData', this.orderData);
  },
  methods: {
    getItemDetails(index) {
      // console.log(this.getItemIndex());
      // console.log()
      alert(index);
      this.dialogDelete = true;
    },
    async consultaritems() {
      await fetch("http://localhost/menunoodle/queueOr.php")
        .then((res) => res.json())
        .then((dataRes) => {
          console.log(dataRes);
          // this.menulist=[]
          // this.menulist.calories=Response
          if (typeof dataRes[0].success === "undefined") {
            this.desserts = dataRes;
          }
        })
        .catch(console.log);
    },
    async deletetable(id_bill) {
      // console.log(id_bill);
      await fetch(
        "http://localhost/menunoodle/queueOr.php/?deletetablee=" +id_bill)
        .then((res) => res.json())
        .catch(console.log);
    },
    // async getOrderDetails() {
    //   await fetch("http://localhost/menunoodle/testdatabase2.php", )
    //     .then((res) => res.json())
    //     .then((dataRes) => {
    //       if (typeof dataRes[0].success === "undefined") {
    //         this.desserts3 = dataRes;
    //       }
    //     })
    //     .catch(console.log);
    // },
    // async getOrderTime() {
    //   await fetch("http://localhost/menunoodle/testdatabase.php")
    //     .then((res) => res.json())
    //     .then((dataRes) => {
    //       console.log(dataRes);
    //       if (typeof dataRes[0].success === "undefined") {
    //         this.desserts2 = dataRes;
    //       }
    //     })
    //     .catch(console.log);
    // },

    reloadPage() {
      window.location.reload();
    },

    // Color of Status
    getColor(id_bill) {
      if (id_bill == 1) return "#4CAF50";
      else return "#FF9800";
    },
    getColor2(actions) {
      if (actions == actions) return "red";
    },
    getColor3(ac) {
      if (ac == ac) return "#1E88E5";
    },
  },
};
</script>
