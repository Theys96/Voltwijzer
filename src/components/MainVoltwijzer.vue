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
              <v-card-text class="pb-1 intro" :style="{'background-image': 'url(' + jj + ')'}">
                <p style="color: #502379; text-align: justify;">
                  Zometeen vertellen onze kandidaten in <b>14 korte video's</b> over de standpunten van Volt Groningen. <br />
                  Geef je <b>mening</b> over ieder standpunt met de <b>schuif</b> aan de onderkant.<br />
                  Zodra je de schuif hebt <b>aangeraakt</b>, kun je verder naar de volgende video met de navigatie-knoppen.<br />
                  Aan het einde geven we jou een <b>passend stemadvies</b>!
                </p>
                <v-btn class="py-3 my-4" style="color: white;" color="#502379" @click="started = true">
                  Ik begrijp het
                </v-btn>
                <!--<p style="color: #502379;" class="my-0">#GeneratieVolt #ProvincialeStaten2023</p>-->
              </v-card-text>
              <v-img
                :src="grunn"
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

const TICK_LABELS = [
  'Oneens',
  '',
  'Neutraal',
  '',
  'Eens',
]

const QUESTIONS = [
  'Europees denken, lokaal doen',
  'Generatie Volt',
  'Duurzaam wonen',
  'Energieprovincie',
  'Ter Apel',
  'Teelt volgt peil',
  'Bereikbaarheid in de provincie',
  'Stikstof',
  'Moderne overheid',
  'Cultuur',
  'Vertrouwen in de politiek',
  'Zorg voor iedereen',
  'Gronings gas',
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
  '/video/11.mp4',
  '/video/12.mp4',
  '/video/13.mp4',
  '/video/14.mp4',
];

const COLORS = [
  '#E63E12',
  '#E63E12',
  'white',
  '#1BBE6F',
  '#1BBE6F'
]

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
      tickLabels: TICK_LABELS,
      started: false,
    }
    for (let i = 0; i < QUESTIONS.length; i++) {
      data.questions.push({
        'title': QUESTIONS[i],
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
        (q) => q.vote == 3 ? (.85 * 4) : q.vote
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
      return COLORS[this.questions[this.idx - 1].vote]
    }
  },

  watch: {
    idx () {
      this.rerenderVideo();
    }
  }
}
</script>
  