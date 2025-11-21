// Модальное окно для полноэкранного просмотра изображения
document.addEventListener("DOMContentLoaded", function () {
  const modal = document.getElementById("image-modal");
  const modalImg = document.getElementById("image-modal-img");
  const closeBtn = document.getElementById("image-modal-close");

  if (!modal || !modalImg || !closeBtn) {
    return;
  }

  // Функция открытия модального окна
  function openModal(imgSrc) {
    modal.style.display = "flex";
    modalImg.src = imgSrc;
    document.body.style.overflow = "hidden";
  }

  // Функция закрытия модального окна
  function closeModal() {
    modal.style.display = "none";
    document.body.style.overflow = "";
  }

  // Обработчик для первого изображения (с id)
  const trigger = document.getElementById("article-image-modal-trigger");
  if (trigger) {
    trigger.addEventListener("click", function () {
      openModal(this.src);
    });
  }

  // Обработчики для всех изображений с атрибутом data-modal-image
  const modalImages = document.querySelectorAll("[data-modal-image]");
  modalImages.forEach(function (img) {
    img.addEventListener("click", function () {
      openModal(this.src);
    });
  });

  // Закрытие модального окна по клику на крестик
  closeBtn.addEventListener("click", closeModal);

  // Закрытие модального окна по клику вне изображения
  modal.addEventListener("click", function (e) {
    if (e.target === modal) {
      closeModal();
    }
  });

  // Закрытие модального окна по нажатию Escape
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape" && modal.style.display === "flex") {
      closeModal();
    }
  });
});
