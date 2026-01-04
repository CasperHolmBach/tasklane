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


document.addEventListener('DOMContentLoaded', () => {
    // Look for the form
    const form = document.querySelector('#modalContainer form');

    form.addEventListener('submit', (event) => {
        let errors = [];
        
        // Grab all input types in the form
        const inputs = form.querySelectorAll('input[type="text"], textarea, input[type="date"]');

        inputs.forEach(input => 
        {
            // Check if the input is empty or just contains spaces
            if (!input.value.trim()) 
            {
                // Get the label text (the element right before the input) to show a helpful error
                errors.push(`${input.previousElementSibling.innerText} is required.`);
                
                // Highlight the specific box in red so the user sees where the mistake is
                input.classList.add('border-red-500');
            } else 
            {
                // Remove the red highlight if the user has fixed the mistake
                input.classList.remove('border-red-500');
            }
        });

        // Stop the form from sending data to the server
        if (errors.length > 0) 
        {
            event.preventDefault();
            
            // Show a simple popup listing everything that needs to be filled out
            alert("Please fill in the following fields:\n" + errors.join('\n'));
        }
    });
});