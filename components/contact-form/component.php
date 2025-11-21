<?php
// Подключаем CSS для компонента
$cssPath = __DIR__ . '/component.css';
if (file_exists($cssPath)) {
    echo '<link rel="stylesheet" href="/components/contact-form/component.css">';
}

// Получаем данные из параметров компонента (если переданы)
$form_id = $data['form_id'] ?? 'contact-form';
$name_id = $data['name_id'] ?? 'name';
$phone_id = $data['phone_id'] ?? 'phone';
$consent_id = $data['consent_id'] ?? 'consent';
?>

<!-- Форма контактов -->
<section class="contact-form-section" id="<?php echo htmlspecialchars($form_id); ?>">
    <div class="container">
        <div class="contact-form-section-inner">
            <h2 class="contact-form-title">ОСТАВЛЯЙТЕ ЗАЯВКУ — НАЧНЕМ РАБОТУ</h2>
            <p class="contact-form-description">
                Заполните форму обратной связи. После обращения с вами свяжется менеджер в рабочее время с 9:00 до
                19:00
            </p>
            <form class="contact-form" action="/sendmail.php" method="post">
                <div class="contact-form-row">
                    <div class="contact-form-field">
                        <label for="<?php echo htmlspecialchars($name_id); ?>" class="contact-form-label">Ваше имя</label>
                        <input type="text" id="<?php echo htmlspecialchars($name_id); ?>" name="name" class="contact-form-input" placeholder="Имя"
                            required />
                    </div>
                    <div class="contact-form-field">
                        <label for="<?php echo htmlspecialchars($phone_id); ?>" class="contact-form-label">Ваш номер телефона</label>
                        <input type="tel" id="<?php echo htmlspecialchars($phone_id); ?>" name="phone" class="contact-form-input"
                            placeholder="+ 7 495 127 09-35" required />
                    </div>
                    <button type="submit" class="contact-form-submit">
                        <span class="contact-form-submit-text">ОТПРАВИТЬ</span>
                        <span class="contact-form-submit-icon">
                            <img src="/assets/images/Arrow.svg" alt="" />
                        </span>
                    </button>
                </div>
                <div class="contact-form-consent">
                    <input type="checkbox" id="<?php echo htmlspecialchars($consent_id); ?>" name="consent" class="contact-form-checkbox" required />
                    <label for="<?php echo htmlspecialchars($consent_id); ?>" class="contact-form-consent-text">
                        Нажимая кнопку "Отправить", Вы даете согласие на
                        <a href="#" class="contact-form-consent-link">обработку персональных данных и соглашаетесь с
                            политикой конфиденциальности</a>
                    </label>
                </div>
            </form>
        </div>
    </div>
</section>

