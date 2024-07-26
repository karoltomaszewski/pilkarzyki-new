<template>
    <main class="main_wrapper">
        <p class="slabo__header">Name of tournament:</p>
            <TextField class="input_field" />
            <div class="players">
            <p class="slabo__header">Choose players:</p>
            <p v-for="player in players" :key="player.id">
                {{ player.name }}
            </p>
        </div>
  
        <p class="slabo__header">How many revanges:</p>
        <TextField class="input_field" />
        <p class="slabo__header">Choose game mode:</p>
            
        <Btn class="submit_btn" btnName="Submit" />
    </main>

</template>

<script setup>
import Btn from '../universal/Btn.vue';
import TextField from '../universal/TextField.vue';

const props = defineProps({
    players: {
        type: Array,
        default() {
            return []
        }
    }
});

// const tournamentName = ref('');

</script>

<style lang="scss" scoped>
.main_wrapper {
    align-items: center;
    display: flex;
    flex-direction: column;

    .input_name {
        margin-bottom: 48px;
    }

    .players {
        align-items: center;
        display: flex;
        flex-direction: column;
        max-height: 400px;
        overflow-y: auto;
        width: 324px;
      }
}

.slabo {
    font-family: "Slabo 13px", serif;

    &__header {
        font-size: 24px;
        font-weight: 400;
        line-height: 16px;
        margin-top: 61px;
        margin-bottom: 20px;
    }
}

</style>