<template>
    <v-container style="max-width: 500px" text-center mt-5 class="white--text">
        <h2 style="position: relative;">
            <img
                :src="logo"
                height="22s"
          />wijzer.nl
        </h2>
        <v-card class="mt-4">
            <v-card-text class="pb-1">
                <v-row class="">
                    <v-col class="col-12 text-justify py-5">
                        <h2 class="float-left" style="color: #502379;">Uitslag</h2>
                        <h2 class="float-right" style="color: #502379;">{{ (result/4*100).toFixed(0) }}%</h2>
                    </v-col>
                    <v-col class="col-12 text-justify py-0">
                        <p style="color: #502379;">{{ result_text }}</p>
                    </v-col>
                    <v-col class="col-12 mb-6 py-2">
                        <v-btn :href="link" target="_blank" class="ma-2" style="color: white;" color="#502379">
                            Verkiezingsprogramma
                        </v-btn>
                        <v-btn class="ma-2" outlined color="#502379" @click="restart">
                            Opnieuw
                        </v-btn>
                    </v-col>
                </v-row>
                <p style="color: #502379;" class="my-0">{{ tag_line }}</p>
            </v-card-text>
            <v-img
                :src="grunn"
            ></v-img>
        </v-card>
    </v-container>
</template>
  
<script>
import logo from '../assets/logo.png';
import grunn from '../assets/grunn.jpg';
import axios from 'axios';

export default {
    name: 'VoltwijzerResult',

    props: {
        result: Number,
        config: Object
    },

    data() {
        return {
            logo: logo,
            grunn: grunn,
            link: this.config.link,
            tag_line: this.config.tag_line,
        }
    },

    computed: {
        result_text() {
            if (this.result <= .25 * 4) {
                return this.config.negative_result;
            }
            if (this.result > .85 * 4) {
                return this.config.optimal_result;
            }
            if (this.result > .50 * 4) {
                return this.config.positive_result;
            }
            return this.config.neutral_result;
        }
    },

    methods: {
        restart: function () {
            this.$emit('restart');
            axios.get('/action/?x=restart');
        }
    }
}
</script>
