<template>
  <v-container style="max-width: 400px" text-center mt-5 class="white--text">
    <h1>
        <img 
          :src="image" 
          height="22s"
        />wijzer
    </h1>
    <v-card class="mt-4">
      <v-card-text>
        <p class="pb-3" style="color: #502379;">Welkom bij de Voltwijzer, het hulpmiddel waarmee je er achter kunt komen of de partij Volt iets voor jou is.</p>
        <v-btn style="color: white;" color="#502379" @click="$emit('start')">
          Start
        </v-btn>
      </v-card-text>
    </v-card>
  </v-container>
</template>
  
<script>
import image from "../assets/logo.png"

  export default {
    name: 'VoltwijzerIntro',
  data() {
    return {
      image: image
    }
  },
  }
</script>
  