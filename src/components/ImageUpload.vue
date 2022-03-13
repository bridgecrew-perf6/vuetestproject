<template>
  <v-container>
    <v-row class="text-center">
      <input type="file" @change="onFileSelected" />
      <button @click="onUpload">Upload</button>
    </v-row>
  </v-container>
</template>

<script>
import axios from 'axios';
export default {
  name: "ImageUpload",
  data() {
    return {
      selectedFile: null
    };
  },
  methods: {
    onFileSelected(event) {
      this.selectedFile = event.target.files[0]
    },
    onUpload() {
      axios.post('')
    }
  },
};
</script>

<style>
</style>