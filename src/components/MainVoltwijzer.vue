<template>
  <v-container class="fill-height py-0 justify-center" fluid>
    <v-row class="no-gutters flex-wrap flex-column fill-height px-1">
      <v-col cols="auto" class="shrink text-center py-3" style="height: 100px;">
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
          <video-player 
            v-if="renderVideo"
            :video="videos[this.idx - 1]"
            @hook:mounted="setVideoHeight"
          />
        </div>
      </v-col>
      <v-col 
        cols="auto" 
        class="shrink text-center"
        v-show="idx == questions.length"
      >
        <v-btn @click="showResult()" class="mt-3">
          Naar je uitslag
        </v-btn>
      </v-col>
      <v-col 
        cols="auto" 
        class="no-gutters flex-wrap flex-column shrink white--text py-3"
        style="height: 50px;"
      >
        <v-row style="max-width: 600px" class="mx-auto">
          <v-col class="col-2 px-0 pt-4 text-right">
            Oneens
          </v-col>
          <v-col class="col-8 px-2">
            <v-slider
              v-model="questions[idx - 1].vote"
              min="0"
              max="100"
              color="white"
              track-color="white"
              hide-details
            />
          </v-col>
          <v-col class="col-2 px-0 pt-4 text-left">
            Eens
          </v-col>
        </v-row>
      </v-col>
      <v-col cols="auto" class="shrink white--text"
        style="height: 60px;">
        <VoltwijzerNavigation
          :modelValue="idx"
          @navigate="idx = $event"
          :length="questions.length"
          color="#82D0F4"
          :total-visible="1"
          text-color="#502379"
        />
      </v-col>
    </v-row>
  </v-container>
</template>
  
<script>
import VideoPlayer from './VideoPlayer.vue';
import VoltwijzerNavigation from './VoltwijzerNavigation.vue';

const QUESTIONS = [
  'Europees denken, lokaal doen',
  'Generatie Volt',
  'Onze kandidaten',
  'Teelt volgt peil',
  'Duurzaam wonen',
  'Energieprovincie',
  'Stikstof',
  'Moderne overheid',
  'Vertrouwen in de politiek',
  'Bereikbaarheid over grenzen',
];

const VIDEOS = [
  '/video/01.mp4',
  '/video/02.mp4',
  '/video/03.mp4',
  '/video/04.mp4',
  '/video/05.mp4',
  '/video/06.mp4',
  '/video/07.mp4',
  '/video/08.mp4',
  '/video/09.mp4',
  '/video/10.mp4',
];

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
  },

  data() {
    let data = {
      idx: 1,
      questions: [],
      videos: VIDEOS,
      videoBoxHeight: 300,
      renderVideo: true,
    }
    for (let i = 0; i < QUESTIONS.length; i++) {
      data.questions.push({
        'title': QUESTIONS[i],
        'vote': 50
      })
    }
    return data
  },

  mounted () {
    this.setVideoHeight();
  },

  methods: {
    showResult() {
      let score = arrayMean(this.questions.map(
        (q) => q.vote
      ))
      this.$emit('result', score)
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
  },

  computed: {
    videoBoxStyle () {
      let width = this.videoBoxHeight;// * (9 / 16);
      return {
        maxWidth: `${width}px`
      }
    }
  },

  watch: {
    idx () {
      this.rerenderVideo();
    }
  }
}
</script>
  