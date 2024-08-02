<template>
    <Layout>
        <div> Tournament stats: </div>
        <p @click="back"><- All tournaments</p>
        
        <div class="tournament_stats">
            <div class="table_naming">
                <div class="naming_elem small"><span>Elo</span></div>
                <div class="naming_elem large"><span>Team 1</span></div>
                <div class="naming_elem small"><span>Result</span></div>
                <div class="naming_elem large"><span>Team 2</span></div>
                <div class="naming_elem small"><span>Elo</span></div>
            </div>
            <div class="single_round" v-for="game in games" :key="game.id">
                <div class="elo_change small" :class="[game.elo_change > 0 ? 'elo_plus' : 'elo_minus']">
                    {{ game.elo_change }}
                </div>
                <div class="team1_players large" :class="[game.points_team1 > game.points_team2 && 'winner']">
                    <p>{{ game.team1.player1.name }}, <br> {{ game.team1.player2.name }}</p>
                </div>
                
                <div class="game_result small">
                    <h3>{{ game.points_team1 }} : {{ game.points_team2 }}</h3>
                </div>
             
                <div class="team2_players large" :class="[game.points_team1 < game.points_team2 && 'winner']">
                    <p>{{ game.team2.player1.name }}, <br> {{ game.team2.player2.name }}</p>
                </div>
                <div class="elo_change small" :class="[game.elo_change_2 > 0 ? 'elo_plus' : 'elo_minus']">
                    {{ game.elo_change_2 }}
                </div>
            </div>
            
            <div class="scoreboard">
                <div class="team" v-for="team in uniqueTeams" :key="team.id">
                    <div class="single_team">
                        <p v-if="team.player1">{{ team.player1.name }}</p>
                        <p v-if="team.player2">{{ team.player2.name }}</p>
                        <!-- <p>{{ team1.points }}</p> -->
                    </div>
                </div>
            </div>

            <p>{{preparedTableData}}</p>
        </div>
    </Layout>
</template>


<script setup>
import { createApp, ref, computed, onMounted } from 'vue'
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

const dimensions = ['80', '', '80', '', '80']

function back() {
    router.visit(window.route('tournaments.store'));
}

const games = ref(props.games);

function prepareTableData() {
    let res = {};
    games.value.forEach(item => {
        res[item.team1.id] = {
            player1: '',
            player2: '',
            goalsGained: 0,
            goalsLost: 0,
            wins: 0,
            defeats: 0,
            eloChange: 0
        }
        res[item.team2.id] = {
            player1Name: '',
            player2Name: '',
            goalsGained: 0,
            goalsLost: 0,
            wins: 0,
            defeats: 0,
            eloChange: 0
        }
    })

    games.value.forEach(item => {
        res[item.team1.id] = {
            player1: item.team1.player1.name,
            player2: item.team1.player2.name,
            goalsGained: res[item.team1.id].goalsGained + item.points_team1,
            goalsLost: res[item.team1.id].goalsLost + item.points_team2,
            wins: item.points_team1>item.points_team2 ? res[item.team1.id].wins+1 : res[item.team1.id].wins,
            defeats: item.points_team1<item.points_team2 ? res[item.team1.id].defeats+1 : res[item.team1.id].defeats,
            eloChange: res[item.team1.id].eloChange + item.elo_change
        }
        res[item.team2.id] = {
            player1: item.team2.player1.name,
            player2: item.team2.player2.name,
            goalsGained: res[item.team2.id].goalsGained + item.points_team2,
            goalsLost: res[item.team2.id].goalsLost + item.points_team1,
            wins: item.points_team2>item.points_team1 ? res[item.team2.id].wins+1 : res[item.team2.id].wins,
            defeats: item.points_team2<item.points_team1 ? res[item.team2.id].defeats+1 : res[item.team2.id].defeats,
            eloChange: res[item.team2.id].eloChange + item.elo_change_2
        }
    })
    console.log(res)
    return res
}


const preparedTableData = ref(prepareTableData());




</script>

<style lang="scss" scoped>

.tournament_stats {
    align-items: center;
    background-color: aliceblue;
    border: 1px solid rgb(39, 39, 39);
    border-radius: 8px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 32px;
    margin-top: 24px;
    padding-bottom: 24px;
    width: 680px;

    .table_naming {
        border-bottom: 1px solid rgb(39, 39, 39);
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        

        .naming_elem {
            display: flex;
            justify-content: center;

            &.small {
                width: 70px;
            }
    
            &.large {
                width: 200px;
            }

            span {
                font-size: 24px;
            }
        }
    }

    .single_round {
        display: flex;
        flex-direction: row;
        justify-content: space-between;

        .small,
        .large {
            display: flex;
            flex-shrink: 0;
            justify-content: center;

            p {
                width: max-content;
            }
        }

        .small {
            width: 70px;
        }

        .large {
            width: 200px;
        }

        .elo_change {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .elo_plus {
            color: rgb(62, 197, 62);
            font-weight: 900;
        }

        .elo_minus {
            color: rgb(197, 62, 62);
            font-weight: 900;
        }

        .game_result {
            align-items: center;
            display: flex;
            justify-content: center;

            :deep(h3) {
                align-items: center;
                font-size: 24px;
                justify-content: center; 
            }
        }

        .winner {

            //color: green;
            font-weight: 900;
            //text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        }
    }

    
    .scoreboard {
        border: 1px solid black;
        display: flex;
        flex-direction: column;

        .single_team {
            display: flex;
        }
    }
}

</style>