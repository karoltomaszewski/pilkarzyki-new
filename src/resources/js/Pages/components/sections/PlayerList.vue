<template>
    <main class="main_wrapper">
        <Layout>
            <p class="slabo__header">Give me your first and last name</p>
            <form class="input_name" @submit.prevent="addPlayer">
                <TextField class="input_field" v-model="playerName" />
                <Btn :class="{ 'submit_btn': true, 'disabled': playerName.length <= 2 }" btnName="Submit" />
            </form>
            <!-- <a class="anchor_tag" href="#">Go to select players and game mode</a> -->

            <div class="player_list">
            <Player class="player_and_id" v-for="player in players2" :key="player.id" :player="player.name" @delete="handleDelete(player.id)"
                :id="player.id" />
            </div>
        </Layout>
    </main>
</template>

<script setup>
import axios from 'axios';
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';
import Btn from '../universal/Btn.vue';
import Player from '../universal/Player.vue';
import TextField from '../universal/TextField.vue';
import Layout from '../../layouts/Layout.vue';

const playerName = ref('');


const props = defineProps({
    players: {
        type: Array,
        default() {
            return []
        }
    }
});

const players2 = ref([...props.players]);



const addPlayer = () => {
    axios.post(window.route('players.store'), {
        name: playerName.value
    }).then((res) =>{
        console.log(res)
        //router.reload()
        

        players2.value.push({
            elo: res.data.elo,
            id: res.data.id,
            name: playerName.value
        });
        // lub: players2.value.push(res.data)

    })
    .catch(err => {
        console.log(err)

    })
    .finally(() => {

    })
}

const handleDelete = (id) => {

    axios.delete(window.route('players.destroy', id))
    
    .then(res => {
        // console.log(`Deleted player with ID ${player.id}`);
        players2.value = players2.value.filter(player => player.id !== id); // usuniecie playera na froncie
    })
    .catch(error => {
        console.error(error);
    });
    

}




//console.log(props.players)

// const elo = () => {
//         axios.get(window.route('players.show', 1)).then((res) => {
//             console.log(res.data)
//             //router.reload()
//         })
//             .catch(err => {
//                 console.log(err)
//             })
//             .finally(() => {

//             })
//     }

//     elo()


</script>

<style lang="scss" scoped>
.main_wrapper {
    align-items: center;
    display: flex;
    flex-direction: column;

    .input_name {
        align-items: center;
        display: flex;
        justify-content: center;
        margin-bottom: 7px;

        .submit_btn {
            :deep(button) {
                margin: 0;
                margin-left: 8px;
                width: 87px;
            }

        }

        .disabled {
            :deep(button) {
                background-color: #dcdcdc;
                border: 2px solid #c9c9c9;
            }
        }

    }

    .player_list {
        background-color: #EEEEEE;
        border-radius: 8px;
        width: 498px;

    }
}

.slabo {
    font-family: "Slabo 13px", serif;

    &__header {
        font-size: 24px;
        font-weight: 400;
        line-height: 16px;
        margin-top: 56px;
        margin-bottom: 12px;
    }
}

.anchor_tag {
    font-size: 16px;
    font-weight: 400;
    line-height: 20px;
    margin-bottom: 126px;
}
</style>
