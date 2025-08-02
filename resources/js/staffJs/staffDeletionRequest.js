document.querySelectorAll('.openModalBtn').forEach(button => {
    const modalId = button.getAttribute('data-modal');
    const modal = document.getElementById(modalId);

    button.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });

    modal.querySelector('.close-modal').addEventListener('click', () => {
        modal.classList.add('hidden');
    });
});
