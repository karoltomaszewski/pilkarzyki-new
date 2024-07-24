
<template>
    <div class="main_wrapper">
        <div class="main_logo">
            <ArrisIcon class="arris"/>
        </div>
        <div class="header">
            <h2>Choose where You want to go :)</h2>
        </div>
        <div class="buttons">
            <Btn :class="{ disabled: !isLogged }" btnName="Register Player"/>
            <Btn :class="{ disabled: !isLogged }" btnName="Go to select players and game mode"/>
            <Btn btnName="Go to see tournament"/>
            <Btn btnName="Go to see table for players rankings"/>
        </div>
        <div class="logout">
            <a :href="route('logout')">Wyloguj się</a>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import ArrisIcon from '../Pages/assets/icons/ArrisIcon.vue';
import Btn from '../Pages/universal/Btn.vue'

console.log(usePage().props)


const { props } = usePage();
const isLogged = props.user;

console.log(props.user.id);
console.log(props.user.email);


</script>

<style lang="scss" scoped>
.main_wrapper {
    .arris {
        margin-left: 72px;
    }

    .buttons {
        align-items: center;
        display: flex;
        flex-direction: column;
        justify-content: center;

        .disabled {
            :deep(button) {
                background-color: #dcdcdc;
                border: 2px solid #c9c9c9;
            }
        }
    }
      
    .header {
        h2 {
            align-items: center;
            display: flex;
            font-family: "Russo One", sans-serif;
            font-size: 40px;
            font-weight: 400;
            font-style: normal;
            justify-content: center;
            line-height: 48px;
            margin-bottom: 40px;
          }
    }
    
    .logout {
        align-items: center;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
    }

    .main_logo {
        align-items: center;
        display: flex;
        justify-content: center;
        margin-top: 241px;
    
        .arris{
            margin-right: 22px;
        }
        .ball {
            justify-content: center;
        } 
    }
    
}
</style>
