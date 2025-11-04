<section class="contacts-section animate-on-scroll">
    <div class="container-fluid">
        <div class="contacts-inner">
            <!-- Левая колонка - Контактная информация -->
            <div class="contacts-info">
                <div class="contacts-header">
                    <img src="/assets/images/polygon.svg" alt="" class="contacts-icon">
                    <h2 class="contacts-subtitle">КОНТАКТНАЯ ИНФОРМАЦИЯ</h2>
                </div>
                <h3 class="contacts-title">СВЯЖИТЕСЬ С НАМИ ЛЮБЫМ<br>СПОСОБОМ</h3>
                
                <div class="contacts-details">
                    <div class="contacts-row">
                        <div class="contact-item">
                            <div class="contact-label">НОМЕР ТЕЛЕФОНА</div>
                            <a href="tel:+74951270935" class="contact-value">+ 7 495 127 09-35</a>
                        </div>
                        <div class="contact-item">
                            <div class="contact-label">ЭЛЕКТРОННАЯ ПОЧТА</div>
                            <a href="mailto:info@te-g.ru" class="contact-value">info@te-g.ru</a>
                        </div>
                    </div>
                    <div class="contacts-row">
                        <div class="contact-item">
                            <div class="contact-label">АДРЕС</div>
                            <div class="contact-value">Гамсоновский пер., 2, стр. 2, этаж 2, офис 211</div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-label">СОЦИАЛЬНЫЕ СЕТИ</div>
                            <div class="contact-social">
                                <a href="https://wa.me/74951270935" target="_blank" rel="noopener" aria-label="WhatsApp" class="social-icon">
                                    <img src="/assets/images/wa.svg" alt="WhatsApp">
                                </a>
                                <a href="https://t.me/" target="_blank" rel="noopener" aria-label="Telegram" class="social-icon">
                                    <img src="/assets/images/tg.svg" alt="Telegram">
                                </a>
                                <a href="mailto:info@te-g.ru" aria-label="Email" class="social-icon">
                                    <img src="/assets/images/mailfooter.svg" alt="Email">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <a href="#" class="contacts-link">
                    Запросить коммерческое предложение
                    <img src="/assets/images/arrowR.svg" alt="">
                </a>
            </div>
            
            <!-- Правая колонка - Форма обратного звонка -->
            <div class="callback-form-wrapper animate-on-scroll delay-1">
                <!-- Сообщения о результате отправки будут добавляться через JavaScript -->
                <form class="callback-form" method="POST" action="">
                    <h2 class="callback-title">ОБРАТНЫЙ ЗВОНОК</h2>
                    <p class="callback-description">Заполните форму обратной связи. После обращения с вами свяжется менеджер в рабочее время с 9:00 до 19:00</p>
                    
                    <div class="form-row">
                        <input type="text" name="name" placeholder="Ваше имя" class="form-input" required>
                        <input type="tel" name="phone" id="callback-phone" placeholder="+7 495 127 09-35" class="form-input" required>
                    </div>
                    
                    <textarea name="comment" placeholder="Комментарий" class="form-textarea" rows="4"></textarea>
                    
                    <div class="form-checkbox-wrapper">
                        <input type="checkbox" name="agree" id="callback-agree" class="form-checkbox" required>
                        <label for="callback-agree" class="form-checkbox-label">
                            Нажимая кнопку "Отправить", Вы даете согласие на обработку персональных данных и соглашаетесь с <a href="#" target="_blank">политикой конфиденциальности</a>
                        </label>
                        <div class="callback-buttons">
                            <button type="submit" class="btn-order-company">ОТПРАВИТЬ</button>
                            <button type="submit" class="btn-arrow-company" aria-label="Отправить">
                                <img src="/assets/images/Arrow.svg" alt="">
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

