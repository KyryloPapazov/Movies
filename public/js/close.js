function closeModal() {
    const modal = document.getElementById('movieModal');
    modal.style.display = 'none';

    // Восстанавливаем прокрутку страницы
    document.body.classList.remove('modal-open');
}

// Закрытие модального окна при клике вне контента
window.onclick = function(event) {
    const modal = document.getElementById('movieModal');
    if (event.target === modal) {
        closeModal();
    }
}