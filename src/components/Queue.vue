<template>
  <div id="app">
    <v-app id="inspire">
      <v-data-table
        group-by="ลำดับ"
        :headers="headers"
        :items="listOrder"
        sort-by=""
        class="elevation-1"
        
       
      >
        <template v-slot:top>
          <v-toolbar flat>
            <v-toolbar-title>Order</v-toolbar-title>
            <v-divider class="mx-4" inset vertical></v-divider>
          </v-toolbar>
        </template>

        <!-- vEdit & Delete -->
        <template v-slot:[`item.actions`]="{ item }">
          <v-chip :color="getColor2(item.actions)" dark>
            <v-icon @click="reloadPage(),deleteDataQueue(item.id_bill)"
              >delete</v-icon
            >
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
      { text: "ลำดับ", align: "start", sortable: false, value: "ลำดับ" },
      { text: "เวลาที่สั่ง", value: "timebill" },
      { text: "วันที่ที่สั่ง", value: "datebill" },
      { text: "รายละเอียด", value: "id_product", sortable: false },
      { text: "จำนวน", value: "quantity"},
      { text: "", value: "actions", sortable: false },
    ],
    listOrder: [],
  }),
 
  created() {
    this.getDataQueueOrder();
   
  },

  methods: {
    async getDataQueueOrder() {
      await fetch("http://localhost/menunoodle/fetchQueueOrder.php")
        .then((res) => res.json())
        .then((dataRes) => {
          console.log(dataRes);
          // this.menulist=[]
          // this.menulist.calories=Response
          if (typeof dataRes[0].success === "undefined") {
            this.listOrder = dataRes;
          }
        })
        .catch(console.log);
    },
    async deleteDataQueue(id_bill) {
      await fetch(
        "http://localhost/menunoodle/fetchQueueOrder.php/?deletetablee=" +id_bill)
        .then((res) => res.json())
        .catch(console.log);
    },
    reloadPage() {
      window.location.reload();
    },

    getColor2(actions) {
      if (actions == actions) return "red";
    },
    
  },
};
</script>
