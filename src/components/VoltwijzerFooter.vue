<template>
        <v-container fluid pa-0>
            <h3 
                style="color: white; text-align: center;"
            >
                <img 
                    :src="image" 
                    height="16s"
                />
                Groningen
            </h3>
        </v-container>
</template>
    
<script>
import image from '../assets/logo.png'

export default {
    name: 'VoltwijzerFooter',
    data() {
        return {
            image: image
        }
    },
}
</script>
    