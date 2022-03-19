<template>
  <v-app>
    <v-main>
      <v-container class="fill-height" fluid>
        <v-row align="center" justify="center" dense>
          <v-col cols="10" md="4">
            <v-card elevation="0">
              <!-- Picture -->
              <v-img
                src="../assets/TEOWS.png"
                alt="Fedorae Education Log"
                contain
                height="200"
              ></v-img>

              <v-card-text>
                <v-form @submit.prevent="pressed">
                  <!-- username -->
                  <v-text-field
                    type="email"
                    label="Email"
                    placeholder="Enter your Email"
                    prepend-inner-icon="mdi-account"
                    v-model="email"
                    :rules="validation.emailRules"
                    outlined
                  >
                  </v-text-field>

                  <!-- Password -->
                  <v-text-field
                    :type="passwordShow ? 'text' : 'password'"
                    label="Password"
                    placeholder="Enter your Password"
                    prepend-inner-icon="mdi-lock"
                    v-model="password"
                    :rules="validation.passwordRules"
                    :append-icon="passwordShow ? 'mdi-eye' : 'mdi-eye-off'"
                    @click:append="passwordShow = !passwordShow"
                    outlined
                  >
                  </v-text-field>

                  <!-- button -->
                  <v-btn
                    type="submit"
                    class="rounded-0"
                    color="#01579B"
                    x-large
                    block
                    dark
                    >Login</v-btn
                  >
                </v-form>
                <br />
                <v-btn
                  type="submit"
                  class="rounded-0"
                  color="green"
                  x-large
                  block
                  dark
                  to="/Register"
                  >Register</v-btn
                >
                <div class="error" v-if="error">{{ error.message }}</div>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import firebase from "firebase/compat/app";
import "firebase/compat/auth";
import "firebase/compat/firestore";

export default {
  data() {
    return {
      passwordShow: false,
      email: "",
      password: "",
      error: "",

      validation: {
        email: "",
        emailRules: [
          (v) => !!v || "E-mail is required",
          (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
        ],
        password: "",
        passwordRules: [
          (v) => !!v || "Password is required",
          (v) =>
            (v && v.length >= 8) || "Password must be less than 8 characters",
        ],
      },
    };
  },

  methods: {
    async pressed() {
      if (this.email == "" || this.password == "") {
        alert("กรุณากรอกข้อมูลให้ครบถ้วน");
      } else {
        await firebase
          .auth()
          .signInWithEmailAndPassword(this.email, this.password)
          .then((result) => {
            // This gives you a Google Access Token. You can use it to access the Google API.
            if (result) {
              localStorage.setItem("token", "xx1122");
            }
            const userToken = localStorage.getItem("token");
            if (userToken) {
              alert("ลงชื่อเข้าใช้สำเร็จ");
              this.$router.replace({ name: "menupage" });
            }
          })
          .catch((err) => {
            console.log("err", err);
            alert("กรุณาตรวจสอบ Email หรือ Password ให้ถูกต้อง");
          });
      }
    },
  },
};
</script>
