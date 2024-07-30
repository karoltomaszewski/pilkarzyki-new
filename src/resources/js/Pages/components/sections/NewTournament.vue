<template>
    <main class="main_wrapper">
        <Layout>
            <!-- <button @click="test">sadasdas</button> -->
            <p class="slabo__header">Name of tournament:</p>
            <TextField class="input_field" v-model="form.tournamentName"/>
            <ChoosePlayers :players="sortedPlayers" @update:selectedPlayers="handleSelectedPlayers"/>
            <p class="slabo__header">How many revanges:</p>
            <SelectRevanges v-model="form.selectedRevanges"/>
            <GameMode v-model="form.selectedGameMode"/>   
            <Btn class="button" :class="{ disabled: (form.tournamentName.length < 3 || form.selectedPlayers.length < 4) }" btnName="Submit" 
            @click="sendForm"
            />

        </Layout>
    </main> 

</template>

<script setup>
import axios from 'axios';
import { ref } from 'vue';
import { useMainStore } from '../../../store/mainStore';
import Btn from '../universal/Btn.vue';
import ChoosePlayers from '../universal/ChoosePlayers.vue';
import GameMode from '../universal/GameMode.vue';
import Layout from '../../layouts/Layout.vue';
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

const store = useMainStore();

const snackbarHandler = (type, desc) => {
    store.showSnackbar(type, desc);

    setTimeout(() => {
        store.closeSnackbar();
    }, "3000");
}



const sortedPlayers = props.players.sort((a, b) => b.elo - a.elo);
const input = ref('');
const value = ref(null);
const tournamentName = ref('');
const selectedPlayers = ref([]);

const form = ref({
    tournamentName: '',
    selectedGameMode: '1',
    selectedRevanges: null,
    selectedPlayers: []
})



const sendForm = () => {
    // isLoader.value = true;
    store.isLoader = true;
    axios.post(window.route('tournaments.store'), 
        form.value
    ).then((res) => {
        console.log(res);
        snackbarHandler('success', "New tournament created!");

        form.value.push({
            tournamentName: '',
            selectedGameMode: '1',
            selectedRevanges: 0,
            selectedPlayers: []
        });


    })
    .catch((error) => {
        console.error(error);
        snackbarHandler('error', "error");
      
    })
    .finally(() => {
        store.isLoader = false;
    });
}

function handleSelectedPlayers(newSelectedPlayers) {
    form.value.selectedPlayers = newSelectedPlayers;
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