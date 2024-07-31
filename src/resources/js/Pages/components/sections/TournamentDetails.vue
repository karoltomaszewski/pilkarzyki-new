<template>
    <Layout>
        <div> Tournament stats: </div>
        <p @click="back"><- All tournaments</p>
        <div class="tournament_stats">
            <div class="single_round" v-for="game in games" :key="game.id">
                <p>ROUND {{ game.round}}:</p>
                <p>team1:</p>
                <p>{{ game.team1.player1.name }} ({{ game.team1.player1.elo }})</p>
                <p>{{ game.team1.player2.name }} ({{ game.team1.player2.elo }})</p>
                <p>team2:</p>
                <p>{{ game.team2.player1.name }} ({{ game.team2.player1.elo }})</p>
                <p>{{ game.team2.player2.name }} ({{ game.team2.player2.elo }})</p>

                <p>------</p>
                <div class="points">
                    <p>{{ game.points_team1 }}</p>
                    <p>{{ game.points_team2 }}</p>
                </div>
                <div class="elo_change">
                    <p>{{ game.elo_change }}</p>
                    <p>{{ game.elo_change_2 }}</p>
                </div>
            </div>


            <!-- <div class="single_round">
                <p>ROUND 1:</p>
                <p>team1:</p>
                <p>{{ games[0].team1.player1 }}</p>
                <p>{{ games[0].team1.player2 }}</p>
                <p>team2:</p>
                <p>{{ games[0].team2.player1 }}</p>
                <p>{{ games[0].team2.player2 }}</p>
                <div class="points">
                    <p>{{ games[0].points_team1 }}</p>
                    <p>{{ games[0].points_team2 }}</p>
                </div>
                <div class="elo_change">
                    <p>{{ games[0].elo_change }}</p>
                    <p>{{ games[0].elo_change_2 }}</p>
                </div>
            </div>
            
            <div class="single_round">
                <p>ROUND 2:</p>
                <p>team1:</p>
                <p>{{ games[1].team1.player1 }}</p>
                <p>{{ games[1].team1.player2 }}</p>
                <p>team2:</p>
                <p>{{ games[1].team2.player1 }}</p>
                <p>{{ games[1].team2.player2 }}</p>
                <div class="points">
                    <p>{{ games[1].points_team1 }}</p>
                    <p>{{ games[1].points_team2 }}</p>
                </div>
                <div class="elo_change">
                    <p>{{ games[1].elo_change }}</p>
                    <p>{{ games[1].elo_change_2 }}</p>
                </div>
            </div> -->
        </div>
    </Layout>

</template>

<script setup>
import { router, usePage } from '@inertiajs/vue3';
import Layout from '../../layouts/Layout.vue';


const props = defineProps({
    players: {
        type: Array,
        default() {
            return []
        }
    },
    games: {
        type: Array,
        default() {
            return []
        }
    }
});

const page = usePage();

function back() {
    router.visit(window.route('tournaments.store'));
}


</script>

<style lang="scss" scoped>
.tournament_stats {
    display: flex;
    //flex-direction: column;
    .single_round {
        flex-direction: column;
    }
}

</style>