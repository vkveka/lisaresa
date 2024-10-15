import { defineStore } from 'pinia';

export const useAccomodationStore = defineStore('accomodation', {
    state: () => ({
        selectedAccomodation: null,
        accomodations: [],
    }),
    actions: {
        async setSelectedAccomodation(id) {
            const response = await fetch(`/api/accomodations/${id}`);
            const accomodation = await response.json();
            this.selectedAccomodation = accomodation.accomodations;
            return accomodation;
        }
    }
});
