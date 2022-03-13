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
                      <v-list-item-title class="headline mb-1 white--text">
                        1,950฿
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
                      <v-list-item-title class="headline mb-1 white--text">
                        9,450฿
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
                      <v-list-item-title class="headline mb-1 white--text">
                        10,550฿
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
            การทำรายการที่ผ่านมา
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
          ></v-data-table>

        </v-card>
      </v-app>
    </v-container>
  </div>
</template>

<script>
export default {
  name: 'finance',
  data() {
    return {
      search: "",
      headers: [
        {
          text: "วัน/เดือน/ปี",
          align: "start",
          sortable: false,
          value: "date",
        },
        { text: "รายละเอียด", value: "details" },
        { text: "จำนวน", value: "quantity" },
        { text: "สถานะ", value: "status" },
      ],
      desserts: [
        {
          date: "01/03/2564",
          details: '#001',
          quantity: 80,
          a: "dasaf",
          status: "เสร็จสิ้น",
        },
        {
          date: "11/09/2564",
          details: '#002',
          quantity: 200,
          status: "เสร็จสิ้น",
        },
        {
          date: "21/08/2564",
          details: '#003',
          quantity: 420,
          status: "เสร็จสิ้น",
        },
        {
          date: "31/12/2564",
          details: '#004',
          quantity: 560,
          status: "เสร็จสิ้น",
        },
        {
          date: "04/12/2564",
          details: '#005',
          quantity: 120,
          status: "เสร็จสิ้น",
        },
        {
          date: "01/06/2564",
          details: '#006',
          quantity: 200,
          status: "เสร็จสิ้น",
        },
        {
          date: "24/11/2564",
          details: '#007',
          quantity: 80,
          status: "เสร็จสิ้น",
        },
        {
          date: "14/07/2564",
          details: '#008',
          quantity: 150,
          status: "เสร็จสิ้น",
        },
        {
          date: "07/05/2564",
          details: '#009',
          quantity: 160,
          status: "เสร็จสิ้น",
        },
      ],
    };
  },
};
</script>

<style>
.a{
  background-color: blue;
}
</style>