<template>
        <button class="button">{{ btnName }}</button>
</template>

<script setup>
const props = defineProps({
    btnName: {
        type: String,
        default: ""
    }
});

</script>

<style lang="scss" scoped>
.button {
    background-color: #E0F9FF;
    border: 2px solid #A0B9BF;
    border-radius: 8px;
    font-family: sans-serif;
    font-size: 16px;
    line-height: 20px;
    margin-bottom: 16px;
    padding: 12px;
    width: 100px;

    &.disabled {
        background-color: #d7d7d7;
        border: 2px solid #a4a4a4;
        cursor: not-allowed;
    }
}
</style>
