<template>
    <Layout>
        <div class="tournaments_list">
            <p class="tournaments_header">Tournaments:</p>
            <div class="tournament" v-for="tournament in tournaments" :key="tournament.id" @click="$redirect('tournaments.show', tournament.id)">
                <p class="tournament_name">{{ tournament.name }}</p>
            </div>
        </div>
    </Layout>

</template>

<script setup>
import Layout from '../../layouts/Layout.vue';

const props = defineProps({
    players: {
        type: Array,
        default() {
            return []
        }
    },
    tournaments: {
        type: Array,
        default() {
            return []
        }
    }
});

</script>

<style lang="scss" scoped>
.tournaments_list {
    .tournaments_header {
        font-size: 36px;
        text-align: center;
    }
    .tournament {
        display: flex;
        background-color: #E0F9FF;
        border: 2px solid #A0B9BF;
        border-radius: 8px;
        cursor: pointer;
        flex-direction: row;
        margin-bottom: 4px;
        transition: background-color .3s ease-in-out;

        &:hover {
            background-color: #bfecf7;
        }
        
        .tournament_name {
            margin-left: auto;
            margin-right: auto;
        }
    }
}
</style>