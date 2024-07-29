<template>
    <form class="game_mode">
        <p class="slabo__header">Choose game mode:</p>
        <div class="radio">
            <input type="radio" id="ladder" name="game_mode" value="1" v-model="selectedGameMode">
            <label for="ladder">Ladder</label><br>
            <input type="radio" id="table" name="game_mode" value="2" v-model="selectedGameMode">
            <label for="table">Table</label><br>
            <input type="radio" id="ladder_with_loser" name="game_mode" value="3" v-model="selectedGameMode">
            <label for="ladder_with_loser">Ladder with loser</label>
        </div>
    </form>
</template>

<script setup>
import { ref } from 'vue';
const selectedGameMode = defineModel();
</script>

<style lang="scss" scoped>
.game_mode {
    align-items: center;
    margin-bottom: 12px;

    label {
        margin-left: 8px;
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