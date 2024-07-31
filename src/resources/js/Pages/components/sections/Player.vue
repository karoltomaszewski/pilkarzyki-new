<template>
    <Layout>
        <div class="player_info">
            <p> {{ name }} </p>
            <p> ({{ elo }}) </p>
            <p> {{ place }}</p>
        </div>
    </Layout>
</template>


<script setup>
import { computed } from 'vue';
import Layout from '../../layouts/Layout.vue';




const props = defineProps({
    name: {
        type: String,
        default: '',
    },
    id: {
        type: Number,
        default: 0,
    },
    elo: {
        type: Number,
        default: 0
    },
    players: {
        type: Array,
        default() {
            return []
        }
    },
});

// function getOrdinal(n) {
//     const suffixes = ["th", "st", "nd", "rd"];
//     const v = n % 100;
//     if (v >= 11 && v <= 13) {
//         return n + suffixes[0];
//     }
//     return n + (suffixes[n % 10] || suffixes[0]);
// }

// const place = computed(() => {
//     props.players.findIndex((player) => player.name === props.name && player.id === props.id && player.elo === props.elo) + 1;
    //    const suffix = getOrdinal(place);
    //    return `${place} ${suffix}`
// });


</script>

<style lang="scss" scoped>
    .player_info {
        align-items: center;
        display: flex;
        flex-direction: column;
        font-size: 36px;
        margin-top: 256px;
    }

</style>