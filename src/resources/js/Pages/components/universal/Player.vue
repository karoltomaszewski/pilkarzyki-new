<template>
    <div class="player_component">
        <Link :href="route('players.show', id)">
            <div class="id_player">
                <p class="id">{{ id }}</p>
                <p class="player"> {{ player }}</p>
            </div>
        </Link>
        <button @click="emits('delete')">Delete</button>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'


const props = defineProps({
    player: {
        type: String,
        default: ""
    },
    id: {
        type: Number,
        default: 0
    }
});

const emits = defineEmits(['delete']);


</script>
<style lang="scss" scoped>
.player_component {
    display: flex;

    :deep(button) {
        border: 2px solid black;
        border-radius: 6px;
        color: red;
        display: flex;
        height: 40px;
        margin: 8px;
    }

    .id_player {
        display: flex;
        font-size: 14px;
        font-weight: 400;
        gap: 8px;
        line-height: 16px;
        margin-top: 8px;
        margin-bottom: 8px;
    
        .id {
            background-color: #E0F9FF;
            border: 1px solid #1F2F32;
            border-radius: 8px;
            height: 40px;
            margin-left: 8px;
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            width: 40px;
        
        }
        
        .player {
            background-color: #E0F9FF;
            border: 1px solid #1F2F32;
            border-radius: 8px;
            padding-left: 16px;
            padding-top: 12px;
            padding-bottom: 12px;
            height: 40px;
            width: 376px;

        }
    }
}



</style>