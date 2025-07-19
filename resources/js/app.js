import './bootstrap';
import 'preline/preline';

// Import Flatpickr
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";

document.addEventListener('DOMContentLoaded', function() {
    // Initialize Preline components
    if (window.HSStaticMethods) {
        window.HSStaticMethods.autoInit();
    }

    // Initialize Flatpickr
    initializeFlatpickr();
});

// Function untuk initialize Flatpickr
function initializeFlatpickr() {
    // Destroy existing flatpickr instances jika ada
    document.querySelectorAll('.datepicker').forEach(el => {
        if (el._flatpickr) {
            el._flatpickr.destroy();
        }
    });
    
    // Initialize Flatpickr
    flatpickr(".datepicker", {
        dateFormat: "d/m/Y",
        locale: {
            firstDayOfWeek: 1,
            weekdays: {
                shorthand: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
                longhand: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"]
            },
            months: {
                shorthand: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
                longhand: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"]
            }
        },
        static: true,
        appendTo: document.body,
        onChange: function(selectedDates, dateStr, instance) {
            const displayInput = instance.input;
            const hiddenInput = document.getElementById(displayInput.id.replace('_display', ''));
            
            if (hiddenInput) {
                if (dateStr && selectedDates[0]) {
                    const date = selectedDates[0];
                    const year = date.getFullYear();
                    const month = String(date.getMonth() + 1).padStart(2, '0');
                    const day = String(date.getDate()).padStart(2, '0');
                    hiddenInput.value = `${year}-${month}-${day}`;
                } else {
                    hiddenInput.value = '';
                }
                
                hiddenInput.dispatchEvent(new Event('change'));
            }
        }
    });
}