
<template>
    <main class="main_wrapper">
        <Layout>
        <div class="main_logo">
            <ArrisIcon class="arris"/>
        </div>
        <div class="header">
            <h1>Choose where You want to go :)</h1>
        </div>
        <div class="buttons">
            <Btn btnName="Register Player" 
                @click="$redirect('players.list')"
                :class="{ disabled: !isLogged }" />
            
            <Btn btnName="Go to select players and game mode"
                :class="{ disabled: !isLogged }" />
            
            <Btn btnName="Go to see tournament"/>
            
            <Btn btnName="Go to see table for players rankings"/>
            
        </div>
        <a v-if="isLogged" class="logout" :href="route('logout')">Logout</a>
        <a v-else class="logout" :href="route('login')">Log in</a>
        <a href="players">Go register</a>
        </Layout>
    </main>
</template>

<script setup>
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import ArrisIcon from '../../assets/icons/ArrisIcon.vue';
import Btn from '../../components/universal/Btn.vue';
import Layout from '../../layouts/Layout.vue';
import PlayerList from './PlayerList.vue';

console.log(usePage().props)


const { props } = usePage();
const isLogged = ref(props.user);

console.log(props.user?.id);
console.log(props.user?.email);





</script>

<style lang="scss" scoped>
.main_wrapper {
    align-items: center;
    display: flex;
    justify-content: center;

    .arris {
        margin-left: 72px;

    }

    .buttons {
        align-items: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        
        :deep(button) {
            width: 311px;
        }

        .disabled {
            :deep(button) {
                background-color: #dcdcdc;
                border: 2px solid #c9c9c9;
            }
        }
    }
      
    .header {
        align-items: center;
        display: flex;
        font-family: "Russo One", sans-serif;
        font-size: 40px;
        font-weight: 400;
        font-style: normal;
        justify-content: center;
        line-height: 48px;
        margin-bottom: 40px;
        margin-left: auto;
        margin-right: auto;
        text-justify: auto;
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
        margin-top: 150px;
    
        .arris{
            margin-right: 22px;
        }
        .ball {
            justify-content: center;
        } 
    }
}
</style>
