import './bootstrap'; // Aqui geralmente já tem o jQuery e o Bootstrap

// Importar o AdminLTE (JS e CSS)
import 'admin-lte'; 
import 'admin-lte/dist/css/adminlte.css';

// Importar os plugins do Bootstrap explicitamente se o botão de fechar ainda falhar
import 'bootstrap/dist/js/bootstrap.bundle.js';


import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
