<template>
    <form class="choose_players">
        <p class="slabo__header">Choose players</p>
        <!-- <label class="player_label" v-for="player in players" :key="player.id">
            <p>{{player.name}}</p>
            <input id="player_checkbox" type="checkbox" name="players" value="checked" />
        </label> -->

        <p>{{selectedPlayers}}</p>
        <div class="players_list" v-for="player in players" :key="player.id" @click="addPlayer(player.id)">
            <div class="checkbox">
                <div class="inner_square" :class="[selectedPlayers.includes(player.id) && 'selected']"></div>
            </div>
            <p>{{player.name}}</p>
        </div>
    </form>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
    players: {
        type: Array,
        default() {
            return []
        }
    }
});

const selectedPlayers = ref([]);

// const x = document.getElementById("myCheck").value;

function addPlayer(id) {
    if (selectedPlayers.value.includes(id)) {

    } else {
        selectedPlayers.value.push(id);
    }
}

</script>

<style lang="scss" scoped>
.choose_players {
    display: flex;
    flex-direction: column;
    margin-bottom: 12px;

    .players_list {
        .checkbox {
            align-items: center;
            border: 1px solid black; 
            display: flex;
            justify-content: center;
            height: 20px;
            width: 20px;
        }
        .inner_square {
            background-color: transparent;
            height: 0.5rem;
            width: 0.5rem;

            &.selected {
                background-color: rgb(0, 0, 0);
        }
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
}

</style>