<template>
  <v-container class="fill-height pb-0 justify-center" fluid>
    <v-row class="no-gutters flex-wrap flex-column fill-height px-1">
      <v-col cols="auto" class="shrink white--text">
        <v-pagination
          v-model="idx"
          :length="questions.length"
          color="#82D0F4"
          :total-visible="7"
        />
      </v-col>
      <v-col cols="auto" class="shrink text-center">
        <h1
          style="color: white;"
        >
          {{ questions[idx - 1].title }}
        </h1>
      </v-col>
      <v-col 
        cols="auto" 
        class="no-gutters flex-wrap flex-column shrink pt-4 white--text"
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
            />
          </v-col>
          <v-col class="col-2 px-0 pt-4 text-left">
            Eens
          </v-col>
        </v-row>
      </v-col>
      <v-col 
        cols="auto" 
        class="shrink text-center mb-2"
        v-show="idx == questions.length"
      >
        <v-btn @click="showResult()">
          Naar je uitslag
        </v-btn>
      </v-col>
      <v-col cols="auto" class="grow" >
        <v-card
          elevation="2"
          class="fill-height mx-auto"
          width="500px"
        >
        <v-card-text class="text-center">
          Video goes here
        </v-card-text>
        </v-card>
      </v-col>
      </v-row>
    </v-container>
</template>
  
<script>
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

function arrayMean(arr) {
  return arr.reduce((a, b) => a + b, 0) / arr.length;
}

export default {
  name: 'HelloWorld',

  data() {
    let data = {
      idx: 1,
      questions: []
    }
    for (let i = 0; i < QUESTIONS.length; i++) {
      data.questions.push({
        'title': QUESTIONS[i],
        'vote': 50
      })
    }
    return data
  },

  methods: {
    showResult() {
      let score = arrayMean(this.questions.map(
        (q) => q.vote
      ))
      this.$emit('result', score)
    }
  }

}
</script>
  