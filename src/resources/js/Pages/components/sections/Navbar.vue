<template>
    <div class="navbar_wrapper">
        <div class="dashboard">
            <Btn btnName="Dashboard"
            @click="$redirect('dashboard')"
            />
        </div>
        <div class="players_list">
            <Btn btnName="Players list"
            @click="$redirect('players.store')"
            />
        </div>
        <div class="new_tournament">
            <Btn btnName="New tournament"
            @click="$redirect('tournaments.new')"
            />
        </div>
        <div class="tournaments_store">
            <Btn btnName="All tournaments"
            @click="$redirect('tournaments.store')"
            />
        </div>
    </div>

</template>

<script setup>
import Btn from '../universal/Btn.vue';
</script>

<style lang="scss" scoped>
.navbar_wrapper {
    align-items: center;
    display: flex;
    gap: 8px;
    justify-content: center;
    margin: 20px 20px;
    max-height: fit-content;
    max-width: max-content;
    
    :deep(button) {
        font-size: 16px;
        margin-bottom: 0;
        width: 150px;

    }
}
</style>