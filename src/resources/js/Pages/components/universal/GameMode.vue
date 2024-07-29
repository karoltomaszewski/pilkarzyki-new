<template>
    <form class="game_mode">
        <p class="slabo__header">Choose game mode:</p>
        <input type="radio" id="ladder" name="game_mode" value="ladder">
        <label for="html">Ladder</label><br>
        <input type="radio" id="table" name="game_mode" value="table">
        <label for="css">Table</label><br>
        <input type="radio" id="ladder_with_loser" name="game_mode" value="Ladder_with_loser">
        <label for="javascript">Ladder with loser</label>
    </form>
</template>

<script setup>

</script>

<style lang="scss" scoped>
.game_mode {
    margin-bottom: 12px;

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