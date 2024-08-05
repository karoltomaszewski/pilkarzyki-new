<template>
    <Layout>
        <div class="go_back">
            <p @click="back">← Go back</p>
        </div>
        
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
            
            
        </div>
        <div class="sorting">
            <p>Sort type: <span>{{sortType}}</span></p>
            <div class="sorting_types">
                <p @click="sortType='rank_asc'">RANK ↑</p>
                <p @click="sortType='rank_desc'">RANK↓</p>
                <p @click="sortType='alphabet_asc'">A-Z</p>
                <p @click="sortType='alphabet_desc'">Z-A</p>
                <p @click="sortType='goalbalance_asc'">GB↑</p>
                <p @click="sortType='goalbalance_desc'">GB↓</p>
                <p @click="sortType='elochange_asc'">ELO↑</p>
                <p @click="sortType='elochange_desc'">ELO↓</p>
            </div>

        </div>
        
        <div class="scoreboard">
            <div class="scoreboard_desc">
                <p v-for="item in summaryDimensions" :key="item.desc" :style="`width: ${item.dimension}px`" @click="handleTabClicked(item.type)"> {{item.desc}}</p>
            </div>
            
            <div class="team" v-for="(team, index) in preparedTableDataCp" :key="team.id">
                <div class="single_team">
                    <div class="team_position" :style="`width: ${summaryDimensions[0].dimension}px`">{{ team.position}}</div>
                    <div class="team_names" :style="`width: ${summaryDimensions[1].dimension}px`"><p>{{ team.names }}</p></div>
                    <!-- <div class="team_stats"> -->
                        <div class="goal_balance" :style="`width: ${summaryDimensions[2].dimension}px`"><p>{{ team.goalsBalance }}</p></div>
                        <div class="team_wins" :style="`width: ${summaryDimensions[3].dimension}px`"><p>{{ team.wins }}</p></div>
                        <div class="team_defeats" :style="`width: ${summaryDimensions[4].dimension}px`"><p>{{ team.defeats }}</p></div>
                        <div class="team_elo" :style="`width: ${summaryDimensions[5].dimension}px`"><p>{{ team.elo.toFixed(2) }}</p></div>
                    <!-- </div> -->
                </div>
            </div>
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


const summaryDimensions = [
    {
        desc: 'Pos',
        dimension: 25,
        type: 'rank_asc'
    },
    {
        desc: 'Team',
        dimension: 353,
        type: 'alphabet_asc'
    },
    {
        desc: 'GB',
        dimension: 50,
        type: 'goalbalance_asc'
    },
    {
        desc: 'Wins',
        dimension: 50,
        type: 'wins_asc'
    },
    {
        desc: 'Defeats',
        dimension: 50,
        type: 'defeats_asc'
    },
    {
        desc: 'Elo change',
        dimension: 80,
        type: 'elochange_asc'
    },
]

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

    let preparedArray = Object.values(res).map((item) => {
        return {
            defeats: item.defeats,
            elo: item.eloChange,
            goalsBalance: item.goalsGained - item.goalsLost,
            names: item.player1 + ', ' + item.player2 + ':',
            wins: item.wins
        }
    }).sort((a,b) => a.goalsBalance > b.goalsBalance ? 1 : -1).sort((a,b) => a.wins < b.wins ? 1 : -1).map((item, index) => {
        return {
            ...item,    
            position: index+1,
        }
    });

    return preparedArray
}


const preparedTableData = ref(prepareTableData());

const sortType = ref('rank_desc')

function handleTabClicked(type) {
    // porownanie czy typ sortowania (np po rankingu czy alfabetycznie) jest taki sam. Czyli, bierzemy pierwsyz czlon (split stringa po '_') 
    // typu sortowania z obecnie wybranego (sortType.value) i przychodacego jako argument metody (type). JEsli jest taki sam, to zmien drugi czlon (z asc na desc i odwrotnie), 
    // a jesli sa rozne, to podmien sortType na type z argumentu metody
    if (type.split('_')[0] === sortType.value.split('_')[0]) {
        let postfix = '';
        if (sortType.value.split('_')[1] === 'desc') {
            postfix = 'asc'
        } else {
            postfix = 'desc'
        }
        sortType.value = sortType.value.split('_')[0] + '_' + postfix
    } else {
        sortType.value = type;
    }
}

const preparedTableDataCp = computed(() => {
    if (sortType.value === 'alphabet_asc') {
        return preparedTableData.value.sort((a,b) => a.names > b.names ? 1 : -1);
    } 
    
    else if (sortType.value === 'alphabet_desc') {
        return preparedTableData.value.sort((a,b) => a.names < b.names ? 1 : -1);
    }
    
    else if (sortType.value === 'goalbalance_asc') {
        return preparedTableData.value.sort((a,b) => a.goalsBalance > b.goalsBalance ? 1 : -1);
    }
    
    else if (sortType.value === 'goalbalance_desc') {
        return preparedTableData.value.sort((a,b) => a.goalsBalance < b.goalsBalance ? 1 : -1);
    }
    
    else if (sortType.value === 'elochange_asc') {
        return preparedTableData.value.sort((a,b) => a.elo > b.elo ? 1 : -1);
    }

    else if (sortType.value === 'elochange_desc') {
        return preparedTableData.value.sort((a,b) => a.elo < b.elo ? 1 : -1);
    }

    else if (sortType.value === 'rank_asc') {
        return preparedTableData.value.sort((a,b) => a.goalsBalance < b.goalsBalance ? 1 : -1).sort((a,b) => a.wins > b.wins ? 1 : -1);
    }

    else if (sortType.value === 'rank_desc') {
        return preparedTableData.value.sort((a,b) => a.goalsBalance > b.goalsBalance ? 1 : -1).sort((a,b) => a.wins < b.wins ? 1 : -1);
    }

    else if (sortType.value === 'wins_asc') {
        return preparedTableData.value.sort((a,b) => a.wins > b.wins ? 1 : -1);
    }

    else if (sortType.value === 'wins_desc') {
        return preparedTableData.value.sort((a,b) => a.wins < b.wins ? 1 : -1);
    }

    else if (sortType.value === 'defeats_asc') {
        return preparedTableData.value.sort((a,b) => a.defeats > b.defeats ? 1 : -1);
    }

    else if (sortType.value === 'defeats_desc') {
        return preparedTableData.value.sort((a,b) => a.defeats < b.defeats ? 1 : -1);
    }

    return preparedTableData.value.sort((a,b) => a.names > b.names ? 1 : -1);
})



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
            font-weight: 900;
        }
    }

    
}
.scoreboard {
    align-items: flex-start;
    background-color: aliceblue;
    border: 1px solid rgb(39, 39, 39);
    border-radius: 8px;
    justify-content: center;
    margin-bottom: 50px;
    margin-top: 8px;
    padding: 20px;
    width: 680px;

    .single_team {
        display: flex;
        

        .team_position {
            padding-left: 6px;
            padding-top: 8px;
        }

        .team_names {
            padding-left: 8px;
            padding-top: 8px;
        }

        .goal_balance {
            padding-left: 10px;
            padding-top: 8px;
        }

        .team_wins {
            padding-left: 28px;
            padding-top: 8px;
        }

        .team_defeats {
            padding-left: 42px;
            padding-top: 8px;
        }

        .team_elo {
            padding-left: 44px;
            padding-top: 8px;
        }

        div {
            flex-shrink: 0;
            text-align: left;
        }
    }

    .team_stats {
        display: flex;
        justify-content: space-between;
        gap: 60px;
        margin-left: 20px;

        div {
            flex-shrink: 0;
        }
    }

    .scoreboard_desc {
        display: flex;
        gap: 8px;

        p {
            cursor: pointer;
            font-size: 12px;
            justify-content: space-between;
            font-weight: 900;
            
        }
    }
    
    
}
.sorting {
    background-color: aliceblue;
    border: 1px solid rgb(39, 39, 39);
    border-radius: 8px;
    display: flex;
    justify-content: space-between;
    margin-top: 50px;
    padding: 20px;
    width: 680px;

    span {
        font-weight: 900;
    }
 
    .sorting_types {
        display: flex;
        gap: 12px;
    }
}

.go_back {
    background-color: #E0F9FF;
    border: 2px solid #A0B9BF;
    border-radius: 8px;
    padding: 4px;
}

</style>