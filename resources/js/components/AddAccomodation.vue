<template>
    <div>
        <div class="card">
            <form @submit.prevent="AddAccomodation">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <label for="name" class="form-label">Nom</label>
                            <input type="text" id="name" class="form-control" placeholder="Nom..." v-model="nameValue"
                                required>
                        </div>
                        <div class="col-6">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" id="description" class="form-control" placeholder="Description..."
                                v-model="descriptionValue" required>
                        </div>
                        <div class="col-6">
                            <label for="type" class="form-label">Type</label>
                            <select name="type" id="type" class="form-select" v-model="typeValue" required>
                                <option value="maison">Maison</option>
                                <option value="appartement">Appartement</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="price" class="form-label">Prix</label>
                            <input type="number" id="price" class="form-control" placeholder="Prix..."
                                v-model="priceValue" required>
                        </div>
                        <div class="col-6">
                            <label for="dispo" class="form-label">Dispo</label>
                            <select name="dispo" id="dispo" class="form-select" v-model="dispoValue" required>
                                <option value="1">Oui</option>
                                <option value="2">Non</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="address" class="form-label">Adresse</label>
                            <input type="text" id="address" class="form-control" placeholder="Adresse..."
                                v-model="addressValue" required>
                        </div>
                        <div class="col-6">
                            <label for="superficy" class="form-label">Superficie</label>
                            <input type="number" id="superficy" class="form-control" placeholder="Superficie..."
                                v-model="superficyValue" required>
                        </div>
                        <div class="col-6">
                            <label for="rooms" class="form-label">Nb de chambres</label>
                            <input type="number" id="rooms" class="form-control" placeholder="Chambres..."
                                v-model="roomsValue" required>
                        </div>
                        <div class="col-6">
                            <label for="beds" class="form-label">Nb de lits</label>
                            <input type="number" id="beds" class="form-control" placeholder="Lits..."
                                v-model="bedsValue" required>
                        </div>
                        <div class="col-6">
                            <label for="persons" class="form-label">Max voyageurs</label>
                            <input type="number" id="persons" class="form-control" placeholder="Max. voyageurs..."
                                v-model="personsValue" required>
                        </div>
                        <div class="col-6">
                            <label for="note" class="form-label">Note</label>
                            <input type="number" id="note" class="form-control" placeholder="Note..."
                                v-model="noteValue">
                        </div>
                        <div class="col-6">
                            <label for="location_id" class="form-label">Ville</label>
                            <input type="text" id="location_id" class="form-control" placeholder="Ville..."
                                v-model="location_idValue" required>
                        </div>
                        <div class="col-12">
                            <div class="clearfix">
                                <a-upload v-model:file-list="fileList" list-type="picture-card" :multiple="true"
                                    @preview="handlePreview">
                                    <div v-if="fileList.length < 8">
                                        <div style="margin-top: 8px">Upload</div>
                                    </div>
                                </a-upload>
                                <a-modal :open="previewVisible" :title="previewTitle" :footer="null"
                                    @cancel="handleCancel">
                                    <img alt="example" style="width: 100%" :src="previewImage" />
                                </a-modal>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark mt-3">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue';
import { useUserStore } from '../stores/userStore';
import axios from 'axios';
import Swal from 'sweetalert2';

const userStore = useUserStore();

function getBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
    });
}
const previewVisible = ref(false);
const previewImage = ref('');
const previewTitle = ref('');
const fileList = ref([]);

const handleCancel = () => {
    previewVisible.value = false;
    previewTitle.value = '';
};
const handlePreview = async file => {
    if (!file.url && !file.preview) {
        file.preview = await getBase64(file.originFileObj);
    }
    previewImage.value = file.url || file.preview;
    previewVisible.value = true;
    previewTitle.value = file.name || file.url.substring(file.url.lastIndexOf('/') + 1);
};

const nameValue = ref('');
const descriptionValue = ref('');
const typeValue = ref('');
const priceValue = ref('');
const dispoValue = ref('');
const addressValue = ref('');
const superficyValue = ref('');
const roomsValue = ref('');
const bedsValue = ref('');
const personsValue = ref('');
const noteValue = ref('');
const location_idValue = ref('');

const AddAccomodation = async () => {
    const name = nameValue.value;
    const description = descriptionValue.value;
    const type = typeValue.value;
    const price = priceValue.value;
    const dispo = dispoValue.value;
    const address = addressValue.value;
    const superficy = superficyValue.value;
    const rooms = roomsValue.value;
    const beds = bedsValue.value;
    const persons = personsValue.value;
    const note = noteValue.value;
    const location_id = parseInt(location_idValue.value);

    try {
        const accomodationRes = await axios.post('/api/accomodations', {
            name: name,
            description: description,
            type: type,
            price: price,
            dispo: dispo,
            address: address,
            superficy: superficy,
            rooms: rooms,
            beds: beds,
            persons: persons,
            note: note,
            location_id: location_id,
        }, {
            headers: {
                Authorization: `Bearer ${userStore.user.access_token}`
            }
        });

        const accomodationId = accomodationRes.data.accomodation.id;
        console.log(accomodationId);

        if (fileList.value.length > 0) {
            const formData = new FormData();

            fileList.value.forEach((file) => {
                formData.append('name[]', file.originFileObj || file);
            });

            formData.append('accomodation_id', accomodationId);

            try {
                await axios.post('/api/images', formData, {
                    headers: {
                        Authorization: `Bearer ${userStore.user.access_token}`,
                        'Content-Type': 'multipart/form-data',
                    },
                });
                nameValue.value = '';
                descriptionValue.value = '';
                typeValue.value = '';
                priceValue.value = '';
                dispoValue.value = '';
                addressValue.value = '';
                superficyValue.value = '';
                roomsValue.value = '';
                bedsValue.value = '';
                personsValue.value = '';
                noteValue.value = '';
                location_idValue.value = null;
                fileList.value = [];

                Swal.fire({
                    title: 'Succès!',
                    text: 'Le logement a été ajouté avec succès !',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });


                console.log('Images envoyées avec succès.');
            } catch (error) {
                Swal.fire({
                    title: 'Erreur!',
                    text: 'Une erreur est survenue. Veuillez réessayer.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                console.error('Erreur lors de l\'envoi des images:', error);
            }
        }

        console.log('Logement créé avec succès');
    } catch (error) {
        Swal.fire({
            title: 'Erreur!',
            text: 'Une erreur est survenue. Veuillez réessayer.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        console.error(error);
    }
}
</script>
<style scoped></style>