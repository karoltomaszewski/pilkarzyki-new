<template>
    <div>
        <Snackbar />
        <Navbar />
        <slot />
        <Loader v-if="isLoaderCp"/>
    </div>
</template>
<script setup>
import { useMainStore } from '../../store/mainStore';
import { computed } from 'vue';
import Navbar from '../components/sections/Navbar.vue';
import Loader from '../components/universal/Loader.vue';
import Snackbar from '../components/universal/Snackbar.vue';

const store = useMainStore();

const isLoaderCp = computed(() => {
    return store.isLoader
})
</script>
<style lang="scss" scoped>
</style>