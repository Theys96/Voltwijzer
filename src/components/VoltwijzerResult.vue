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
        <h2 class="mb-8" style="color: #502379;">Uitslag</h2>
        <v-row class="">
          <v-col class="col-3 py-0">
            <p style="font-size: 2em; color: #502379;">{{ (result/4*100).toFixed(0) }}%</p>
          </v-col>
          <v-col class="col-9 text-justify py-0">
            <p style="color: #502379;">{{ result_text }}</p>
          </v-col>
          <v-col class="col-12 mb-6 py-2">
            <v-btn href="https://provincie-groningen.voltnederland.org/programma" target="_blank" class="ma-2" style="color: white;" color="#502379">
              Verkiezingsprogramma
            </v-btn>
            <v-btn class="ma-2" outlined color="#502379" @click="$emit('restart')">
              Opnieuw
            </v-btn>
          </v-col>
        </v-row>
        <p style="color: #502379;" class="my-0">#GeneratieVolt #ProvincialeStaten2023</p>
      </v-card-text>
      <v-img
        :src="grunn"
      ></v-img>
    </v-card>
  </v-container>
</template>
  
<script>
const negative_result = 
  "Het lijkt er op dat je nog niet helemaal overtuigd bent van de standpunten van Volt. " + 
  "Misschien vind je het toch interessant om meer over ons te weten te komen. " + 
  "Neem dan eens een kijkje in ons verkiezings-programma.";
const neutral_result = 
  "Je lijkt open te staan voor de boodschap van Volt, al ben je het nog niet altijd met ons eens. " + 
  "Misschien vind je het interessant om meer over ons te weten te komen. " + 
  "Neem dan eens een kijkje in ons verkiezings--programma. ";
const positive_result = 
  "Jij bent klaar voor Volt! Je bent het grotendeels met ons eens. " + 
  "Wil je meer over Volt te weten komen? " + 
  "Neem dan eens een kijkje in ons verkiezings-programma. ";
const optimal_result =
  "Jij bent klaar voor Volt! Je bent het helemaal met ons eens. " +
  "Wil je toch nog meer weten over Volt? " + 
  "Lees dan ons verkiezings-programma en overweeg eens om lid worden!";

import logo from "../assets/logo.png"
import grunn from "../assets/grunn.jpg"

export default {
  name: 'VoltwijzerResult',
  props: {
    result: Number
  },
  data() {
    return {
      logo: logo,
      grunn: grunn,
    }
  },
  computed: {
    result_text() {
      if (this.result <= 1) {
        return negative_result;
      }
      if (this.result > 3) {
        return optimal_result;
      }
      if (this.result > 2) {
        return positive_result;
      }
      return neutral_result;
    }
  }
}
</script>
  