<template>
  <v-app :style="{background: '#502379'}">
    <div class="top-stripe"></div>
    <div class="bottom-stripe"></div>
    <v-main :style="{maxHeight: (windowHeight - 40) + 'px'}">
      <VoltwijzerIntro v-if="!started"
        @start="() => restart()"
      />
      <MainVoltwijzer v-if="started && !result"
        @result="(res) => showResult(res)"
        :height="windowHeight - 40"
      />
      <VoltwijzerResult v-if="started && result"
        @restart="restart()"
        :result="res"
        :result-texts="resultTexts"
      />
    </v-main>
    <v-footer class="footer">
      <VoltwijzerFooter />
    </v-footer>
  </v-app>
</template>

<style lang="scss">
@import url("https://fonts.googleapis.com/css?family=Ubuntu");

body * {
  font-family: 'Ubuntu';
}

body, html {
  margin: 0;
  height: 100%;
  overflow: hidden;
}

.footer {
  background-color: #50237900 !important;
  height: 40px;
}

.top-stripe, .bottom-stripe {
  height: 30vmin;
  width: 30vmax;
  position: absolute;
}

.top-stripe {
  top: 0;
  left: 0;
  background-image: linear-gradient(90deg,#1bbe6f,#502379);
  transform: rotate(-21deg);
  transform-origin: bottom left;
}

.bottom-stripe {
  bottom: 0;
  right: 0;
  background-image: linear-gradient(-90deg,#fdc220,#502379);
  transform: rotate(-21deg);
  transform-origin: top right;
}
</style>

<script>
import image from "./assets/logo.png"
import VoltwijzerFooter from './components/VoltwijzerFooter';
import MainVoltwijzer from './components/MainVoltwijzer';
import VoltwijzerResult from './components/VoltwijzerResult';
import VoltwijzerIntro from './components/VoltwijzerIntro';
import axios from 'axios';

export default {
  name: 'App',

  components: {
    MainVoltwijzer,
    VoltwijzerFooter,
    VoltwijzerResult,
    VoltwijzerIntro
  },

  data: function () {
    return {
      windowHeight: window.innerHeight,
      image: image,
      result: false,
      started: false,
      res: 0.0,
      resultTexts: {},
    }
  },

  created: function () {
    let app = this

    axios.get('/texts.json')
      .then(
        function (response) {
          app.resultTexts = response.data;
        }
      );
  },

  methods: {
    restart() {
      this.started = true
      this.result = false
    },
    showResult(res) {
      this.result = true
      this.res = res
    }
  }
};
</script>
