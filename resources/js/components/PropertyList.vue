<template>
    <div>
        <div id="property-list">
            <div v-for="property in properties" :key="property.id" class="property-item">
                <h2>{{ property.title }}</h2>
                <p>{{ property.description || 'Descripción no disponible' }}</p>
            </div>
        </div>

        <div id="pagination" v-if="pagination && Object.keys(pagination).length > 0">
            <button @click="fetchProperties(1)" v-if="pagination.current_page > 1">Primera</button>
            <button @click="fetchProperties(pagination.current_page - 1)" v-if="pagination.prev_page_url">Anterior</button>

            <span v-for="link in pagination.links" :key="link.label">
                <button v-if="link.active">{{ link.label }}</button>
                <button v-else @click="fetchProperties(link.url.split('page=')[1])">{{ link.label }}</button>
            </span>

            <button @click="fetchProperties(pagination.current_page + 1)" v-if="pagination.next_page_url">Siguiente</button>
            <button @click="fetchProperties(pagination.last_page)" v-if="pagination.current_page < pagination.last_page">Última</button>
        </div>
    </div>
</template>

<script>
import axios from 'axios'; // Asegúrate de que axios esté importado

export default {
    data() {
        return {
            properties: [],
            pagination: {
                current_page: 1,
                prev_page_url: null,
                next_page_url: null,
                last_page: 1,
                links: []
            },
            apiToken: 'tu_token_aqui', // Reemplaza esto con tu token real
        };
    },
    mounted() {
        this.fetchProperties(1); // Cargar la primera página al montar el componente
    },
    methods: {
        fetchProperties(page) {
            console.log(`Fetching properties for page: ${page}`); // Mensaje de depuración
            axios.get(`https://api.externa.com/properties?page=${page}`, { // Asegúrate de que esta URL sea correcta
                headers: {
                    'Authorization': `Bearer ${this.apiToken}` // Usa el token definido
                }
            })
            .then(response => {
                console.log('Response:', response.data); // Verifica la respuesta
                this.properties = response.data.properties;
                this.pagination = response.data.pagination;
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al cargar las propiedades. Intenta nuevamente más tarde.');
            });
        },
    },
};
</script>

<style scoped>
.property-item {
    margin-bottom: 20px;
}
</style>