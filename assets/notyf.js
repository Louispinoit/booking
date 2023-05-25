import { Notyf } from 'notyf';
import 'notyf/notyf.min.css'; // for React, Vue and Svelte

// Create an instance of Notyf
const notyf = new Notyf({
    duration: 4000,
    position: {
        x: 'right',
        y: 'top'
    },
    types: [
        {
            type: 'info',
            background: 'blue',
            icon: {
                className: 'fas fa-info-circle',
            }
        },
        {
            type: 'warning',
            background: 'orange',
            icon: {
                className: 'fas fa-exclamation-circle',
            }
        }]
});

let messages = document.querySelectorAll('#notyf-message');


