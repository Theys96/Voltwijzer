<template>
  <v-container class="fill-height py-0 justify-center" fluid>
    <v-row class="no-gutters flex-wrap flex-column fill-height px-1">
      <v-col cols="auto" class="shrink text-center py-3">
        <h1
          style="color: white;"
        >
          {{ questions[idx - 1].title }}
        </h1>
      </v-col>
      <v-col 
        cols="auto" 
        class="shrink text-center"
        v-show="idx == questions.length"
      >
        <v-btn @click="showResult()" class="mb-3">
          Naar je uitslag
        </v-btn>
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
        class="no-gutters flex-wrap flex-column shrink white--text py-3"
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
      <v-col cols="auto" class="shrink white--text">
        <v-pagination
          v-model="idx"
          :length="questions.length"
          color="#82D0F4"
          :total-visible="7"
        />
      </v-col>
    </v-row>
  </v-container>
</template>
  
<script>
import VideoPlayer from './VideoPlayer.vue';

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
  'Bereikbaarheid in de provincie',
  'Gronings gas',
  'Ter Apel',
  'Cultuur',
  'Zorg voor iedereen',
];

const VIDEOS = [
  '/video/Stefan.mp4',
  '/video/Stefan2.mp4',
  '/video/Stefan.mp4',
  '/video/Stefan2.mp4',
  '/video/Stefan.mp4',
  '/video/Stefan2.mp4',
  '/video/Stefan.mp4',
  '/video/Stefan2.mp4',
  '/video/Stefan.mp4',
  '/video/Stefan2.mp4',
  '/video/Stefan.mp4',
  '/video/Stefan2.mp4',
  '/video/Stefan.mp4',
  '/video/Stefan2.mp4',
  '/video/Stefan.mp4',
];

function arrayMean(arr) {
  return arr.reduce((a, b) => a + b, 0) / arr.length;
}

export default {
  name: 'HelloWorld',

  components: {
    VideoPlayer
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
    }
  },

  computed: {
    videoBoxStyle () {
      let width = this.videoBoxHeight * (9 / 16);
      return {
        width: `${width}px`
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
  