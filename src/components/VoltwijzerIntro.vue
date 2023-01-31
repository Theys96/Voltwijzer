<template>
  <v-container style="max-width: 500px" text-center mt-5 class="white--text">
    <h2>
        <img 
          :src="logo" 
          height="22s"
        />wijzer
    </h2>
    <v-card class="mt-4">
      <v-card-text class="pb-1">
        <p style="color: #502379;" class="my-0">Welkom bij de Voltwijzer, het hulpmiddel waarmee je er achter kunt komen of de partij Volt iets voor jou is.</p>
        <v-btn x-large class="py-3 my-10" style="color: white;" color="#502379" @click="$emit('start')">
          Start
        </v-btn>
        <p style="color: #502379;" class="my-0">#GeneratieVolt #ProvincialeStaten2023</p>
      </v-card-text>
      <v-img
        :src="grunn"
      ></v-img>
    </v-card>
  </v-container>
</template>
  
<script>
import logo from "../assets/logo.png"
import grunn from "../assets/grunn.jpg"

  export default {
    name: 'VoltwijzerIntro',
  data() {
    return {
      logo: logo,
      grunn: grunn,
    }
  },
  }
</script>
  