<script>
    export default {
        props: {
            players: Array
        }
    }
</script>

<template>
    <div class="mb-4">
        <h1 class="text-4xl">NEW TOURNAMENT</h1>
    </div>
    <div>
        {{ players }}
    </div>
    <div>
        <a :href="route('logout')">Wyloguj się</a>
    </div>
</template>
