<template>
    <main class="main_wrapper">
        <p class="slabo__header">Name of tournament:</p>
        <TextField class="input_field" v-model="tournamentName"/>
        <p>{{input}}</p>
        <ChoosePlayers :players="sortedPlayers" @update:selectedPlayers="handleSelectedPlayers"/>
        <p class="slabo__header">How many revanges:</p>
        <SelectRevanges />
        <GameMode v-model="form.selectedGameMode"/>   
        <Btn class="button" :class="{ disabled: (tournamentName.length < 3 || selectedPlayers.length < 4) }" btnName="Submit" 
        @click="sendForm"
        />
        <Loader v-if="!isLoader"/>
        <Team />
    </main> 

</template>

<script setup>
import axios from 'axios';
import { ref } from 'vue';
import Btn from '../universal/Btn.vue';
import ChoosePlayers from '../universal/ChoosePlayers.vue';
import GameMode from '../universal/GameMode.vue';
import SelectRevanges from '../universal/SelectRevanges.vue';
import TextField from '../universal/TextField.vue';
import Loader from '../universal/Loader.vue';
import Team from '../universal/Team.vue';


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
const selectedPlayers = ref([]);
const isLoader = 'false';

const form = ref({
    tournamentName: '',
    selectedGameMode: '1',
    selectedRevanges: 0,
    selectedPlayers: []
})


const sendForm = () => {
    isLoader.value = ref('true');
    axios.post(window.route('players.store'), 
        form.value
    ).then((res) => {
        console.log(res);
        //router.reload()

        

        form.value.push({
            tournamentName: '',
            selectedGameMode: '1',
            selectedRevanges: 0,
            selectedPlayers: []
        });
    })
    .catch((error) => {
        console.error(error);
      
    })
    .finally(() => {
        isLoader.value = false; 
    });
}

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


        overflow-x: hidden;
        overflow-y: hidden;

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