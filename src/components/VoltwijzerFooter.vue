<template>
    <v-container fluid pa-0>
      <a href="https://provincie-groningen.voltnederland.org/" target="_blank" style="text-decoration: none;">
        <h3 
          style="color: white; text-align: center;"
        >
          <img 
            :src="image" 
            height="16s"
          />
          Groningen
        </h3>
      </a>
    </v-container>
</template>
  
<script>
import image from "../assets/logo.png"

export default {
  name: 'VoltwijzerFooter',
  data() {
    return {
      image: image
    }
  },
}
</script>
  