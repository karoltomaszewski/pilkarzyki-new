<template>
    <form class="game_mode">
        <p class="slabo__header">Choose game mode:</p>
        <div class="radio_wrapper">
            <div class="single_radio_elem" v-for="item in radioElems" :key="item.id">
                <label :for="item.id">
                    <BallIcon v-if="selectedGameMode === item.value" />
                    <div v-else class="radio_elem_empty"></div>
                </label>
                <input type="radio" :id="item.id" name="game_mode" :value="item.value" v-model="selectedGameMode"/>
                <label :for="item.id">{{item.desc}}</label>
            </div>
        </div>
    </form>
</template>

<script setup>
import { ref } from 'vue';
import BallIcon from '../../assets/icons/BallIcon.vue';
const selectedGameMode = defineModel();

const radioElems = ref([
    {
        desc: 'Ladder',
        id: 'ladder',
        value: '1'
    },
    {
        desc: 'Table',
        id: 'table',
        value: '2'
    },
    {
        desc: 'Ladder with loser',
        id: 'ladder_with_loser',
        value: '3'
    },
    
])


</script>

<style lang="scss" scoped>
.game_mode {
    align-items: center;
    margin-bottom: 12px;

    .radio_wrapper {
        .single_radio_elem {
            display: flex;
            input {
                height: 0;
                position: relative;
                width: 0;

/*                &:checked { 
                    &::after {
                        background-color: red;
                        content: '';
                        height: 10px;
                        left: 0;
                        position: absolute;
                        top: 0;
                        width: 10px;
                    }
                } */
            }
            label {
                margin-left: 8px;
            }

            .radio_elem_empty {
                border: 1px solid black;
                border-radius: 100%;
                height: 20px;
                width: 20px;
            }
        }
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