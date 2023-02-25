<template>

<div class="text-center ma-2">
    <v-btn class="mx-1" @click="navigateTo(modelValue - 1)" :disabled="disabled || !(modelValue > 1)">
        <v-icon :color="textColor">mdi-chevron-left</v-icon>
    </v-btn>
    <div
        style="font-weight: bold; width: 100px; display: inline-block;"
    >
        <span style="font-size: 1.4em; ">{{ modelValue }} / {{ length }}</span>
        <span></span>
    </div>
    <v-btn class="mx-1" :color="buttonColor" @click="navigateTo(modelValue + 1)" :disabled="disabled || !(modelValue < length + 1)">
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
        disabled: Boolean,
    },
    
    emits: ['navigate', 'finish'],
    
    methods: {
        navigateTo (val) {
            if (val == this.length + 1) {
                this.$emit('finish');
            } else {
                this.$emit('navigate', Math.max(0, Math.min(val, this.length)))
            }
        }
    },

    computed: {
        buttonColor() {
            return this.modelValue == this.length ? '#FDC220' : null;
        }
    }
}
</script>