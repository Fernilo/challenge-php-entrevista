import { createApp } from 'vue';
import PropertyList from './components/PropertyList.vue';

const app = createApp(PropertyList); // Monta el componente directamente
app.mount('#app'); // Asegúrate de que el ID coincida con el contenedor en tu vista