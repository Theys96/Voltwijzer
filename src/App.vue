<template>
  <v-app :style="{background: '#502379'}">
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
      />
    </v-main>
    <v-footer :style="{background: '#502379', height: '40px'}">
      <VoltwijzerFooter />
    </v-footer>
  </v-app>
</template>

<style lang="scss">
@import url("https://fonts.googleapis.com/css?family=Ubuntu");

body * {
  font-family: 'Ubuntu';
}

body {
  height: 300px;
}
</style>

<script>
import image from "./assets/logo.png"
import VoltwijzerFooter from './components/VoltwijzerFooter';
import MainVoltwijzer from './components/MainVoltwijzer';
import VoltwijzerResult from './components/VoltwijzerResult';
import VoltwijzerIntro from './components/VoltwijzerIntro';

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
      res: 0.0
    }
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
