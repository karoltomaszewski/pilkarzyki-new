<template>
    <div class="text_field">
        <label class="label">{{ label }}</label>
        <input class="input_field" :class="{ 'input_error': error }" v-model="model" :minlength="minlength" />
        <p :class="{ 'error': error }">{{ error }}</p>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';


const props = defineProps({
    label: {
        type: String,
        default: ''
    },
    modelValue: {
        type: String,
        default: ''
    },
    maxlength: {
        type: String,
        default: ''
    },
    minlength: {
        type: String,
        default: '0'
    },
    placeholder: {
        type: String,
        default: ''
    },
    error: {
        type: String,
        default: ''
    }

});

const model = defineModel()



</script>
<style lang="scss" scoped>
.text_field {
    display: flex;
    flex-direction: column;

    p {
        color: red;
    }

    .label {
        justify-content: flex-start;

    }

    .input_field {
        border: 2px solid black;
        border-radius: 12px;
        height: 46px;
        width: 392px;
    }

    .input_error {
        border: 2px solid red;
    }
}
</style>