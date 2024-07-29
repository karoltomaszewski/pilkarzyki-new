<template>
    <form class="choose_players">
        <p class="slabo__header">Choose players</p>
        <!-- <p>{{selectedPlayers}}</p> -->
        <div class="players_list" v-for="player in players" :key="player.id" @click="addPlayer(player.id)">
            <div class="checkbox">
                <div class="inner_square" :class="[selectedPlayers.includes(player.id) && 'selected']"></div>
            </div>
            <p>{{player.name}}  ({{ player.elo}})</p>
        </div>
    </form>
</template>

<script setup>
import { ref, watch } from 'vue';

const emit = defineEmits(['update:selectedPlayers']);

const props = defineProps({
    players: {
        type: Array,
        default() {
            return []
        }
    }
});

const selectedPlayers = ref([]);

function addPlayer(id) {
    if (selectedPlayers.value.includes(id)) {
        // console.log(selectedPlayers.value.toSpliced(id, 1));
        selectedPlayers.value = selectedPlayers.value.filter(player => player !== id)
    } else {
        selectedPlayers.value.push(id);
    }
}

watch(selectedPlayers, (newValue) => {
    emit('update:selectedPlayers', newValue);
});



</script>

<style lang="scss" scoped>
.choose_players {
    display: flex;
    flex-direction: column;
    margin-bottom: 12px;

    .players_list {
        display: flex;
        gap: 8px;
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