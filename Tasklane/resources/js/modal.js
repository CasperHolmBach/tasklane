document.addEventListener('DOMContentLoaded', () => {
    // Get buttons
    const open = document.getElementById('open');
    const modalContainer = document.getElementById('modalContainer');
    const cancel = document.getElementById('cancel');
    const body = document.body;

    // Make sure DOM has loaded buttons
    if (open && modalContainer && cancel) 
    {
        // Listener for pressing "new project" button
        open.addEventListener('click', () => {
            modalContainer.classList.remove('hidden');
            modalContainer.classList.add('flex');
            body.classList.add('overflow-hidden'); // Disable scrolling
        });

        // Allow closing modal when pressing on darkened area
        modalContainer.addEventListener('click', (e) => {
            if (e.target === modalContainer) {
                modalContainer.classList.add('hidden');
                modalContainer.classList.remove('flex');
                body.classList.remove('overflow-hidden');
            }
        });

        // Allow closing modal when pressing the cancel button
        modalContainer.addEventListener('click', (e) => {
            if (e.target === cancel) {
                modalContainer.classList.add('hidden');
                modalContainer.classList.remove('flex');
                body.classList.remove('overflow-hidden');
            }
        });

        // Allow closing modal when pressing escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !modalContainer.classList.contains('hidden')) {
                modalContainer.classList.add('hidden');
                modalContainer.classList.remove('flex');
                body.classList.remove('overflow-hidden');
            }
        });
    }
});

// Form validation
document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('#modalContainer form');
    
    if (!form) return;

    form.addEventListener('submit', (event) => {
        let errors = [];
        // Select all text inputs, textareas, and date pickers inside this form
        const inputs = form.querySelectorAll('input[type="text"], textarea, input[type="date"]');

        inputs.forEach(input => {
            if (!input.value.trim()) {
                errors.push(`${input.previousElementSibling.innerText} is required.`);
                input.classList.add('border-red-500');
            } else {
                input.classList.remove('border-red-500');
            }
        });

        if (errors.length > 0) {
            event.preventDefault();
            alert("Please fill in the following fields:\n" + errors.join('\n'));
        }
    });
});