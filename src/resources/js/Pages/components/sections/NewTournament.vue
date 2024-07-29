<template>
    <main class="main_wrapper">
        <p class="slabo__header">Name of tournament:</p>
        <TextField class="input_field" v-model="tournamentName"/>
        <p>{{input}}</p>
        <ChoosePlayers :players="sortedPlayers" @update:selectedPlayers="handleSelectedPlayers"/>
        <p>{{selectedPlayers}}</p>
        <p class="slabo__header">How many revanges:</p>
        <SelectRevanges />
        <GameMode v-model="form.selectedGameMode"/>   
        <Btn class="button" :class="{ disabled: (tournamentName.length < 3 || selectedPlayers.length < 4) }" btnName="Submit" />
    </main>

</template>

<script setup>
import { ref } from 'vue';
import Btn from '../universal/Btn.vue';
import ChoosePlayers from '../universal/ChoosePlayers.vue';
import GameMode from '../universal/GameMode.vue';
import SelectRevanges from '../universal/SelectRevanges.vue';
import TextField from '../universal/TextField.vue';

const props = defineProps({
    players: {
        type: Array,
        default() {
            return []
        }
    }
});


const sortedPlayers = props.players.sort((a, b) => b.elo - a.elo);
const input = ref('');
const value = ref(null);
const tournamentName = ref('');

const form = ref({
    tournamentName: '',
    selectedGameMode: '1',
})

const selectedPlayers = ref([]);

function handleSelectedPlayers(newSelectedPlayers) {
    selectedPlayers.value = newSelectedPlayers;
}

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