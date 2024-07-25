<template>
    <main class="main_wrapper">
        <p class="slabo__header">Give me your first and last name</p>
            <form class="input_name" @submit.prevent="addPlayer">
                <TextField class="input_field" v-model="playerName"/>
                <Btn :class="{'submit_btn': true, 'disabled': playerName.length <= 2}" btnName="Submit"/>
            </form>
        <a class="anchor_tag" href="#">Go to select players and game mode</a>
        
        <div class="player_list">
            <Player class="player_and_id" v-for="player in players" :key="player.id" :player="player.name" :id="player.id"/>
        </div>
    </main>
</template>

<script setup>
import axios from 'axios';
import { ref } from 'vue';
import Btn from '../universal/Btn.vue';
import Player from '../universal/Player.vue';
import TextField from '../universal/TextField.vue';

const playerName = ref('');

const props = defineProps({
    players: {
        type: Array,
        default() {
            return []
        }
    }
});

// console.log(props.players)

const addPlayer = () => {
    axios.post(window.route('players.store'), {
        name: playerName.value
    }).then((res) =>{
        console.log(res)

    })
    .catch(err => {
        console.log(err)

    })
    .finally(() => {

    })
    console.log("test", playerName)
}

</script>

<style lang="scss" scoped>
.main_wrapper {
    align-items: center;
    display: flex;
    flex-direction: column;
    
    .input_name {
        align-items: center;
        display: flex;
        justify-content: center;
        margin-bottom: 7px;
        
        .submit_btn {
            :deep(button){
                margin: 0;
                margin-left: 8px;
                width: 87px;
            }

        }
        .disabled {
            :deep(button) {
                background-color: #dcdcdc;
                border: 2px solid #c9c9c9;
            }
        }
        
    }

    .player_list {
        background-color: #EEEEEE;
        border-radius: 8px;
        width: 498px;
        
    }
}
.slabo {
    font-family: "Slabo 13px", serif;
    
    &__header {
        font-size: 24px;
        font-weight: 400;
        line-height: 16px;
        margin-top: 56px;
        margin-bottom: 12px;
    }
}

.anchor_tag {
    font-size: 16px;
    font-weight: 400;
    line-height: 20px;
    margin-bottom: 126px;
}

</style>
