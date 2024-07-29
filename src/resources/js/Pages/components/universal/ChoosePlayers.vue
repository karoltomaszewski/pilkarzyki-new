<template>
    <form class="choose_players">
        <p class="slabo__header">Choose players</p>
        <label class="player_label" v-for="player in players" :key="player.id">
            <p>{{player.name}}</p>
            <input type="checkbox" name="players" value="player" />
        </label>
    </form>
</template>

<script setup>
const props = defineProps({
    players: {
        type: Array,
        default() {
            return []
        }
    }
});

</script>

<style lang="scss" scoped>
.choose_players {
    display: flex;
    flex-direction: column;
    margin-bottom: 12px;

    .player_label {
        display: flex;
        flex-direction: row-reverse;
        gap: 8px;
        justify-content: flex-end;
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