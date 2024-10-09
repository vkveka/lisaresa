import { defineStore } from 'pinia';

export const useAccomodationStore = defineStore('accomodation', {
    state: () => ({
        selectedAccomodation: null
    }),
    actions: {
        setSelectedAccomodation(accomodation) {
            this.selectedAccomodation = accomodation;
        }
    }
});
