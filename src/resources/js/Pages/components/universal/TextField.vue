<template>
    <div class="text_field">
        <label class="label">{{ label }}</label>
        <input
            class="input_field"
            :class="{'input_error': error}"
            :value="modelValue"
            @input="updateValue($event.target.value)"
            minlength="3"
            />
            <p :class="{'error': error}">{{error}}</p>
    </div>
</template>

<script setup>
import { ref, defineProps, defineEmits } from 'vue';


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
placeholder: {
type: String,
default: ''
},
error: {
type: String,
default: ''
}


});
const emit = defineEmits(['update:modelValue']);

const updateValue = (value) => {
emit('update:modelValue', value);
};



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