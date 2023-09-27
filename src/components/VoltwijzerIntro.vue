<template>
    <v-container style="max-width: 500px" text-center mt-5 class="white--text">
        <h2 style="position: relative;">
                <img 
                    :src="logo" 
                    height="22s"
                />wijzer.nl
        </h2>
        <v-card class="mt-4">
            <v-card-text class="pb-1 intro" :style="{'background-image': 'url(' + profile + ')'}">
                <p style="color: #502379;" v-html="config.welcome" />
                <v-btn x-large class="py-3 my-10" style="color: white;" color="#502379" @click="$emit('start')">
                    Start
                </v-btn>
            </v-card-text>
            <v-img
                :src="grunn"
            ></v-img>
        </v-card>
    </v-container>
</template>
    
<style>
.intro {
    background-position: 95% 100%;
    background-size: 150px;
}
</style>

<script>
import logo from '@/assets/logo.png'
import grunn from '@/assets/grunn.jpg'
import profile from '@/assets/profile.jpg'

export default {
    name: 'VoltwijzerIntro',

    props: {
        config: Object
    },

    data() {
        return {
            logo: logo,
            grunn: grunn,
            profile: profile,
        };
    },
}
</script>
    