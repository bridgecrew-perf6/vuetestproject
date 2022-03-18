<template>
   <v-app>
    <v-main>
      <div v-if="userID.error" class="error">{{userID.error.message}}</div>
    
      <v-container class="fill-height"  fluid >
        <v-row align="center" justify="center" dense >
          <v-col cols="10" md="4" >
            <v-card elevation="0">

              <v-img src="../assets/TEOWS.png" alt="Fedorae Education Log" contain 
              height="200"></v-img>
          

            <v-card-text>
              
              <v-form @submit.prevent="pressed" ref="from">

              
              <v-text-field 
              type="email"
              label="Email"
              placeholder="Email"
              prepend-inner-icon="mdi-account"
              outlined
              v-model="userID.email"
              :rules="emailRules" 
              required>
              </v-text-field>

              <!-- Password -->
              <v-text-field 
              :type="userID.passwordShow ? 'text':'password'"
              label="Password"
              placeholder="Password"
              prepend-inner-icon="mdi-lock"
              :append-icon="userID.passwordShow ? 'mdi-eye': 'mdi-eye-off'"
              @click:append="userID.passwordShow = !userID.passwordShow"
              outlined
              v-model="userID.password"
              :rules="passwordRules" 
              required>
              </v-text-field>

              <!-- Cpassword -->
              <v-text-field 
              :type="userID.cpasswordShow ? 'text':'password'"
              label="Confirm Password"
              placeholder="Confirm Password"
              prepend-inner-icon="mdi-lock"
              :append-icon="userID.cpasswordShow ? 'mdi-eye': 'mdi-eye-off'"
              @click:append="userID.cpasswordShow = !userID.cpasswordShow"
              outlined
              v-model="userID.cpassword"
              :rules="passwordRules" 

              required>
              </v-text-field>

              <!-- Button -->
              <v-btn class="rounded-0"
              color="green" 
              x-large block dark
              type="submit" 
              >
              Register
              </v-btn>
              <br>
              <v-btn
                    type="submit"
                    class="rounded-0"
                    color="#01579B"
                    x-large
                    block
                    dark
                    to="/"
                    >Login</v-btn>
                    

              <!-- Checkbox -->
              <v-card-actions class="text--secondary">
                <!-- <v-checkbox 
                color="#01579B" 
                label="Accept" 
                :rules="[v => !!v || 'You must agree ']" 
                required>
                </v-checkbox> -->
                </v-card-actions>
              </v-form>                                                                     
             </v-card-text>
            </v-card>
          </v-col>
        </v-row>
      </v-container>  
    </v-main>
  </v-app>
</template>

<script>
import firebase from 'firebase/compat/app';
import 'firebase/compat/auth';
import 'firebase/compat/firestore';



export default {
data(){
   return{
      userID : {
          // username:'',
          email:'',
          password:'',
          cpassword:'',
          error:'',
          passwordShow:false,
          cpasswordShow:false       
      },

    


      // valid: true,
      // name: '',
      // nameRules: [
      //   v => !!v || 'Name is required',
      //   v => (v && v.length <= 10) || 'Name must be less than 10 characters',
      // ],
      email: '',
      emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
      ],
      password: '',
      passwordRules: [
        v => !!v || 'Password is required',
        v => (v && v.length >= 8) || 'Password must be less than 8 characters',
      ],
      cpassword: '',
      cpasswordRules: [
        v => !!v || 'Password is required',
        v => (v && v.length >= 8) || 'Password must be less than 8 characters',
        v => (v &&this.userID.password == this.userID.cpassword) || 'this password not correct'
      ],
      // checkbox: false,
   }
},
  
  methods:{
   async pressed(){
   if(this.userID.email == ""  || this.userID.password == ""){
         alert("กรุณากรอกข้อมูลให้ครบถ้วน")
   }else{
       try{      
        alert("บันทึกข้อมูลสำเร็จ"); 
        const user = firebase.auth().createUserWithEmailAndPassword(this.userID.email,this.userID.password)
        console.log(user)
        this.$router.replace({ path: "/"});
      }catch(err){
          console.log(err)
       }
     }
   } 
  }  
}
</script>