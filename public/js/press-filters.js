document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('.filters-wrapper');
    if (!form) return;

    const categoryInputs = form.querySelectorAll('input[name="category"]');

    let debounceTimer = null;


    
    categoryInputs.forEach(input => {
        input.addEventListener('change', () => {
            form.submit();
        });
    });
});
