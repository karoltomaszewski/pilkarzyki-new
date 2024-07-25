
<template>
    <main class="main_wrapper">
        <p>Give me your first and last name</p>
        <div class="input_name">
            <TextField class="input_field"/>
            <Btn class="submit_btn" btnName="Submit"/>
        </div>
        <a href="#">Go to select players and game mode</a>
    </main>
</template>

<script setup>
import Btn from '../universal/Btn.vue';
import TextField from '../universal/TextField.vue';

</script>

<style lang="scss" scoped>
.main_wrapper {
    align-items: center;
    display: flex;
    flex-direction: column;
    
    p {
        font-family: "Slabo 13px", sans-serif;
    }

    .input_name {
        align-items: center;
        display: flex;
        flex-direction: row;
        justify-content: center;
        
        .submit_btn {
            :deep(button){
                margin: 0;
                margin-left: 8px;
                width: 87px;
            }
        }
    }

}

</style>
