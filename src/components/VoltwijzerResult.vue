<template>
  <v-container fluid text-center mt-5 class="white--text">
    <h1>Uitslag</h1>
    <p>Je gemiddelde score was:</p>
    <p style="font-size: 3em;">{{ (result / 10).toFixed(1) }}</p>
    <v-btn @click="$emit('restart')">
      Opnieuw
    </v-btn>
  </v-container>
</template>
  
<script>
  export default {
    name: 'VoltwijzerResult',
    props: {
      result: Number
    },
    data() {
      return {
        page: 1,
        numPages: 6
      }
    }
  }
</script>
  