<template>
  <v-app :style="{background: $vuetify.theme.themes.light.background}">
        <v-app style="background-color: grey lighten-1;" class="rounded">
          <v-row>
            <v-col cols="12" md="8" class="ligne">
            <v-container>
              <v-row>
                <v-col cols="12" md="12">
                  <h1 class="headline mb-2 grey--text">Money status </h1>
                  <template>
                    <div id="app">
                      <GChart
                        type="ColumnChart"
                        :data="chartData"
                        
                      />    
                    </div>
                  </template>
                </v-col>
              </v-row>
        </v-container>
            </v-col>
          </v-row>
     </v-app>

  </v-app>
</template>

<script>
import { GChart } from "vue-google-charts";
export default {
   data: () => ({
    chartData: [
        ['วัน', "หมู", "ไก่", "เนื้อ","กุ้ง"],
        ["อาทิตย์", 1000, 400, 200,20],
        ["จันทร์", 1000, 400, 200,20],
        ["อังคาร", 1170, 460, 250,40],
        ["พุธ", 0, 1120, 300,10],
        ["พฤหัสบดี", 1030, 540, 350,12],
        ["ศุกร์", 1025, 530, 302,12],
        ["เสาร์", 1040, 560, 356,10],
      ],
      
  }),
  name: 'App',
  components: {
    GChart
  },
  computed:{
    theme(){
      return (this.$vuetify.theme.dark) ? 'dark' : 'light'
    }
  }
};
</script>
<style scoped>
.rounded{
    border-radius:30px;
}
.ligne{
  border-right: solid 1px #95a5a6;
}
</style>