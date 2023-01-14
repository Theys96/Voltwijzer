<template>
  <v-app :style="{background: '#502379'}">
    <v-main>
      <MainVoltwijzer v-if="!result"
        @result="(res) => showResult(res)"
      />
      <VoltwijzerResult v-if="result"
        @restart="restart()"
        :result="res"
      />
    </v-main>
    <v-footer :style="{background: '#502379'}">
      <VoltwijzerFooter />
    </v-footer>
  </v-app>
</template>

<style lang="scss">
@import url("https://fonts.googleapis.com/css?family=Ubuntu");

body * {
  font-family: 'Ubuntu';
}
</style>

<script>
import image from "./assets/logo.png"
import VoltwijzerFooter from './components/VoltwijzerFooter';
import MainVoltwijzer from './components/MainVoltwijzer';
import VoltwijzerResult from './components/VoltwijzerResult';

export default {
  name: 'App',

  components: {
    MainVoltwijzer,
    VoltwijzerFooter,
    VoltwijzerResult
  },

  data: function () {
    return {
      image: image,
      result: false,
      res: 0.0
    }
  },

  methods: {
    restart() {
      this.result = false
    },
    showResult(res) {
      this.result = true
      this.res = res
    }
  }
};
</script>
