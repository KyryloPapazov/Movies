function openModalEdit(movieId) {
    const modal = document.getElementById('movieModal');
    const modalBody = document.getElementById('modalBody');

    // Показываем модальное окно
    modal.style.display = 'flex';  // Изменяем display на block для показа модального окна
    document.body.classList.add('modal-open');
    

    // Асинхронно загружаем данные о фильме
    fetch(`?page=movies&action=edit&id=${movieId}`)
        .then(response => response.text())
        .then(data => {
            modalBody.innerHTML = data;
        })
        .catch(error => {
            modalBody.innerHTML = 'Ошибка загрузки данных.';
            console.error('Ошибка загрузки данных фильма:', error);
        });
}