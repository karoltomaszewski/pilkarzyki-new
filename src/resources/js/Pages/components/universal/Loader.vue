<template>
<div class="loader">
    <LoaderIcon class="loader_icon"/>
</div>
</template>
<script setup>
import LoaderIcon from '../../assets/icons/LoaderIcon.vue';
</script>
<style lang="scss" scoped>
.loader {
    background-color: #00000099;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    position: fixed;
    height: 100vh;
    width: 100vw;
    z-index: 1;
    display: flex;
    align-items: center;
    justify-content: center;

    .loader_icon {
        height: 10%;
        width: 10%;
    }
}
</style>