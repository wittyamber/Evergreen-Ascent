// resources/js/app.js

import './bootstrap';
import Alpine from 'alpinejs';

// Import Flatpickr
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css"; // Import the CSS

window.Alpine = Alpine;
Alpine.start();

// Initialize Flatpickr on any element with the 'datepicker' class
document.addEventListener('DOMContentLoaded', () => {
    flatpickr(".datepicker", {
        enableTime: false,
        dateFormat: "Y-m-d",
    });

    flatpickr(".timepicker", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true
    });
});