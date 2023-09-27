<template>
    <v-container class="fill-height py-0 justify-center" fluid>
        <v-row class="no-gutters flex-wrap flex-column fill-height px-1">
            <v-col cols="auto" class="shrink text-center py-3" style="height: 140px;">
                <h1
                    style="color: white;"
                >
                    {{ questions[idx - 1].title }}
                </h1>
            </v-col>
            <v-col cols="auto" class="grow" >
                <div
                    class="fill-height mx-auto"
                    :style="videoBoxStyle"
                    ref="videoBox"
                >
                    <v-container style="max-width: 500px" text-center class="white--text" v-if="!started">
                        <v-card>
                            <v-card-text class="pb-1 intro">
                                <p style="color: #502379; text-align: justify;" v-html="instructions" />
                                <v-btn class="py-3 my-4" style="color: white;" color="#502379" @click="started = true">
                                    Ik begrijp het
                                </v-btn>
                            </v-card-text>
                            <v-img
                                src="@/assets/grunn.jpg"
                            ></v-img>
                        </v-card>
                    </v-container>
                    <video-player 
                        v-if="started && renderVideo"
                        :video="videos[this.idx - 1]"
                        @hook:mounted="setVideoHeight"
                    />
                </div>
            </v-col>
            <v-col 
                cols="auto" 
                class="no-gutters flex-wrap flex-column shrink white--text pt-6"
                style="height: 90px;"
            >
                <div
                    style="max-width: 600px"
                    class="mx-auto"
                >
                    <v-slider
                        v-model="questions[idx - 1].vote"
                        min="0"
                        max="4"
                        step="1"
                        hide-details
                        ticks="always"
                        tick-size="4"
                        :tick-labels="tickLabels"
                        :color="color"
                        track-color="white"
                        track-fill-color="white"
                        @start="touch"
                    />
                </div>
            </v-col>
            <v-col cols="auto" class="shrink white--text"
                style="height: 60px;">
                <VoltwijzerNavigation
                    :modelValue="idx"
                    @navigate="navigateTo($event)"
                    @finish="showResult()"
                    :length="questions.length"
                    color="#82D0F4"
                    :total-visible="1"
                    text-color="#502379"
                    :disabled="!started || !questions[idx - 1].touched"
                />
            </v-col>
        </v-row>
    </v-container>
</template>
    
<script>
import axios from 'axios';
import VideoPlayer from './VideoPlayer.vue';
import VoltwijzerNavigation from './VoltwijzerNavigation.vue';

function arrayMean(arr) {
    return arr.reduce((a, b) => a + b, 0) / arr.length;
}

export default {
    name: 'MainVoltwijzer',

    components: {
        VideoPlayer,
        VoltwijzerNavigation
    },

    props: {
        height: Number,
        config: Object,
    },

    data() {
        let data = {
            videos: this.config.videos,
            instructions: this.config.instructions,
            idx: 1,
            questions: [],
            videoBoxHeight: 300,
            renderVideo: true,
            tickLabels: [this.config.labels[0], '', this.config.labels[1], '', this.config.labels[2]],
            started: false,
            tickColors: [
                this.config.colors[0],
                this.config.colors[0],
                this.config.colors[1],
                this.config.colors[2],
                this.config.colors[2]
            ],
        }
        for (let i = 0; i < this.config.titles.length; i++) {
            data.questions.push({
                'title': this.config.titles[i],
                'vote': 2,
                'touched': false,
            })
        }
        return data
    },

    mounted () {
        this.setVideoHeight();
        axios.get('/action/?x=start');
    },

    methods: {
        showResult() {
            let score = arrayMean(this.questions.map(
                (q) => q.vote === 3 ? (.85 * 4) : q.vote
            ))
            this.$emit('result', score)
            axios.get('/action/?x=vote-' + this.idx + '-' + this.questions[this.idx - 1].vote);
            axios.get('/action/?x=score-' + ((score/4*100).toFixed(0)));
        },
        rerenderVideo() {
            this.renderVideo = false;
            this.$nextTick(() => {
                this.videoBoxHeight = 300
                this.renderVideo = true;
            });
        },
        setVideoHeight() {
            this.videoBoxHeight = this.$refs.videoBox.clientHeight;
        },
        touch() {
            this.questions[this.idx - 1].touched = true;
        },
        navigateTo(newIdx) {
            let oldIdx = this.idx;
            this.idx = newIdx;
            axios.get('/action/?x=navigate-' + oldIdx + '-' + newIdx);
            axios.get('/action/?x=vote-' + oldIdx + '-' + this.questions[oldIdx - 1].vote);
        }
    },

    computed: {
        videoBoxStyle () {
            let width = this.videoBoxHeight;// * (9 / 16);
            return {
                maxWidth: `${width}px`
            }
        },

        color () {
            return this.tickColors[this.questions[this.idx - 1].vote]
        }
    },

    watch: {
        idx () {
            this.rerenderVideo();
        }
    }
}
</script>
    