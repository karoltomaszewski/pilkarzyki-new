<template>
    <div>
        <div v-if="snackbarCp.isVisible" class="snackbar" :class="{ error: snackbarCp.type==='error', success: snackbarCp.type === 'success' }">
            <p>{{ snackbarCp.desc }}</p>
            <p>(X)</p>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useMainStore } from '../../../store/mainStore';

const store = useMainStore();

const snackbarCp = computed(() => {
    return store.snackbar;
})

</script>


<style lang="scss" scoped>
.snackbar {
    align-items: center;
    background-color: rgb(185, 84, 84);
    border: 2px solid black;
    display: flex;
    justify-content: space-between;
    height: 50px;
    padding-left: 10px;
    padding-right: 10px;
    position: fixed;
    visibility: hidden;
    width: 350px;

    &.error {
        background-color: rgb(185, 84, 84);
        visibility: visible;

    }

    &.success {
        background-color: rgb(99, 185, 84);
        visibility: visible;

    }
}
</style>