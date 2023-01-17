<template>

<div class="text-center ma-2">
    <v-btn class="mx-1" @click="navigateTo(modelValue - 1)" :disabled="!(modelValue > 1)">
        <v-icon :color="textColor">mdi-chevron-left</v-icon>
    </v-btn>
    <div
        style="font-weight: bold; width: 100px; display: inline-block;"
    >
        <span style="font-size: 1.4em; ">{{ modelValue }} / {{ length }}</span>
        <span></span>
    </div>
    <v-btn class="mx-1" @click="navigateTo(modelValue + 1)" :disabled="!(modelValue < length)">
        <v-icon :color="textColor">mdi-chevron-right</v-icon>
    </v-btn>
</div>

</template>

<script>
export default {
    name: 'VoltwijzerNavigation',

    props: {
        modelValue: Number,
        length: Number,
        color: String,
        textColor: String,
    },
    
    emits: ['navigate'],
    
    methods: {
        navigateTo (val) {
            this.$emit('navigate', Math.max(0, Math.min(val, this.length)))
        }
    }
}
</script>