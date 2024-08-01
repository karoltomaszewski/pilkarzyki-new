<template>
    <Layout>
        <div> Tournament stats: </div>
        <p @click="back"><- All tournaments</p>
        

        <div class="tournament_stats">
            <div class="table_naming">
                <div>Elo change:</div>
                <div>Team 1</div>
                <div>Result:</div>
                <div>Team 2</div>
                <div>Elo change:</div>

            </div>
            <div class="single_round" v-for="game in games" :key="game.id">
                <div class="elo_change" :class="{ 'elo_plus': game.elo_change > 0, 'elo_minus': game.elo_change < 0 }"
                    >
                    {{ game.elo_change}}
                </div>
                <div class="team1_players" :class="{ 'winner': game.points_team1 > game.points_team2 }">
                    <p>{{ game.team1.player1.name }}, <br> {{ game.team1.player2.name }} </p>
                </div>
                    
                <div class="game_result">
                    <h3>{{ game.points_team1 }} : {{ game.points_team2 }} </h3>
                </div>
             
                <div class="team2_players" :class="{ 'winner': game.points_team2 > game.points_team1 }">
                    <p> {{ game.team2.player1.name }}, <br> {{ game.team2.player2.name }}</p>
                </div>   
                <div class="elo_change" :class="{ 'elo_plus': game.elo_change_2 > 0, 'elo_minus': game.elo_change_2 < 0 }"
                    >
                    {{ game.elo_change_2}}
                </div>
            </div>
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
    background-color: aliceblue;
    border: 1px solid rgb(39, 39, 39);
    border-radius: 8px;
    display: flex;
    flex-direction: column;
    gap: 32px;
    margin-top: 24px;

    .table_naming {
        display: flex;
        font-size: 24px;
        justify-content: space-between;
        padding: 0px 24px;
    }

    .single_round {
        display: flex;
        flex-direction: row;
        justify-content: space-between;

        .elo_change {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0px 24px;
        }
        
        .elo_plus {
            color: rgb(62, 197, 62);
            font-weight: 900;
        }

        .elo_minus {
            color: rgb(197, 62, 62);
            font-weight: 900;
        }



        .team1_players {
            padding-left: 32px;
        }

        .game_result {
            align-items: center;
            display: flex;
            justify-content: center;
            margin-left: 32px;
            margin-right: 32px;

            :deep(h3) {
                align-items: center;
                font-size: 24px;
                justify-content: center; 
            }
        }

        .team2_players {
            padding-right: 32px;
        }

        .winner {
            font-weight: 700;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        }
    }


}
</style>