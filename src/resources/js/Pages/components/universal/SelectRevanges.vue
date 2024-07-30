<template>
    <select v-model="selectVal" name="revange" class="revanges">How many revanges:
        <option value="null">0</option>
        <option value="one">1</option>
        <option value="two">2</option>
    </select>
</template>

<script setup>


const selectVal = defineModel();
</script>

<style lang="scss" scoped>
.revanges {
    border: 1px solid black;
    border-radius: 8px;
    height: 40px;
    text-align: center;
    width: 40px;
}

</style>