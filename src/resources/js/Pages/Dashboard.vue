
<template>
    <div class="main_logo">
        <ArrisIcon class="arris"/>
    </div>
    <div class="header">
        <h2>Choose where You want to go :)</h2>
    </div>
    <div class="buttons">
        <Btn btnName="Register Player"/>
        <Btn btnName="Go to select players and game mode"/>
        <Btn btnName="Go to see tournament"/>
        <Btn btnName="Go to see table for players rankings"/>
    </div>
    <div class="logout">
        <a :href="route('logout')">Wyloguj się kfkkfkk</a>
    </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
import ArrisIcon from '../Pages/assets/icons/ArrisIcon.vue';
import Btn from '../Pages/universal/Btn.vue'

console.log(usePage().props)
</script>

<style lang="scss" scoped>

.buttons {
    align-items: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
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
</style>
