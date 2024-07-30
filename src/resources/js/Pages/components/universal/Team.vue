<template>
    <div class="team">
        <p>{{ players }}</p>
    </div>
</template>
<script setup>
import axios from 'axios';

const props = defineProps({
    players: {
        type: Array,
        default() {
            return []
        }
    }
});
</script>

<style lang="scss" scoped>

</style>