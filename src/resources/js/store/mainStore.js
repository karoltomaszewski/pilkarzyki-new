import { defineStore } from "pinia"
import { ref } from "vue"


export const useMainStore = defineStore('mainStore', () => {
   const isLoader = ref(false);


   const snackbar = ref({
    isVisible: false,
    type: '',
    desc: ''
});

    const showSnackbar = (type='success', desc='New tournament created!') => {
        snackbar.value = {
            isVisible: true,
            type: type,
            desc: desc
        };
    };

    const closeSnackbar = () => {
        snackbar.value = {
            isVisible: false,
            type: '',
            desc: ''
        };
    };

   return { 
       closeSnackbar,
        isLoader,
        snackbar,
        showSnackbar,
    }
})

