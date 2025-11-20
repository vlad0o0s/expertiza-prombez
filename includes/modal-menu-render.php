<?php
/**
 * Функция для рендеринга модального меню из конфигурации
 */

function render_modal_menu() {
    $menuConfig = require __DIR__ . '/../config/modal-menu.php';
    
    ?>
    <div class="mm-sections">
        <!-- Первая колонка: Экспертиза промбезопасности + Статьи -->
        <div class="mm-column-wrapper" data-column="epb-articles">
            <?php if (isset($menuConfig['epb'])): ?>
                <div class="mm-section is-open" data-section="epb">
                    <button class="mm-section-toggle" aria-expanded="true">
                        <span class="mm-title"><?php echo htmlspecialchars($menuConfig['epb']['title']); ?></span>
                        <span class="mm-arrow"></span>
                    </button>
                    <div class="mm-section-body">
                        <ul class="mm-list">
                            <?php foreach ($menuConfig['epb']['items'] as $item): ?>
                                <li><?php echo htmlspecialchars($item); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
            
            <!-- Секция "Статьи" в первой колонке -->
            <?php if (isset($menuConfig['articles'])): ?>
                <div class="mm-section" data-section="articles">
                    <button class="mm-section-toggle" aria-expanded="false">
                        <span class="mm-title"><?php echo htmlspecialchars($menuConfig['articles']['title']); ?></span>
                        <span class="mm-arrow"></span>
                    </button>
                    <div class="mm-section-body">
                        <?php if (!empty($menuConfig['articles']['items'])): ?>
                            <ul class="mm-list">
                                <?php foreach ($menuConfig['articles']['items'] as $item): ?>
                                    <li>
                                        <?php if (is_array($item) && isset($item['href'])): ?>
                                            <a href="<?php echo htmlspecialchars($item['href']); ?>">
                                                <?php echo htmlspecialchars($item['text']); ?>
                                            </a>
                                        <?php else: ?>
                                            <?php echo htmlspecialchars($item); ?>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Вторая колонка: Услуги и О компании вместе -->
        <div class="mm-column-wrapper" data-column="services-about">
            <!-- Услуги -->
            <?php if (isset($menuConfig['services'])): ?>
                <div class="mm-section" data-section="services">
                    <button class="mm-section-toggle" aria-expanded="false">
                        <span class="mm-title"><?php echo htmlspecialchars($menuConfig['services']['title']); ?></span>
                        <span class="mm-arrow"></span>
                    </button>
                    <div class="mm-section-body">
                        <ul class="mm-list">
                            <?php foreach ($menuConfig['services']['items'] as $item): ?>
                                <li>
                                    <?php if (is_array($item) && isset($item['link'])): ?>
                                        <?php echo htmlspecialchars($item['text']); ?> 
                                        <a href="<?php echo htmlspecialchars($item['link']['url']); ?>" 
                                           target="<?php echo htmlspecialchars($item['link']['target'] ?? '_blank'); ?>">
                                            <?php echo htmlspecialchars($item['link']['text']); ?>
                                        </a>
                                    <?php elseif (is_array($item) && isset($item['href'])): ?>
                                        <a href="<?php echo htmlspecialchars($item['href']); ?>">
                                            <?php echo htmlspecialchars($item['text']); ?>
                                        </a>
                                    <?php else: ?>
                                        <?php echo htmlspecialchars($item); ?>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>

            <!-- О компании -->
            <?php if (isset($menuConfig['about'])): ?>
                <div class="mm-section" data-section="about">
                    <button class="mm-section-toggle" aria-expanded="false">
                        <span class="mm-title"><?php echo htmlspecialchars($menuConfig['about']['title']); ?></span>
                        <span class="mm-arrow"></span>
                    </button>
                    <div class="mm-section-body">
                        <ul class="mm-list">
                            <?php foreach ($menuConfig['about']['items'] as $item): ?>
                                <li><?php echo htmlspecialchars($item); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Третья колонка: Контакты -->
        <?php if (isset($menuConfig['contacts'])): ?>
            <div class="mm-section is-open" data-section="contacts">
                <button class="mm-section-toggle" aria-expanded="true">
                    <span class="mm-title"><?php echo htmlspecialchars($menuConfig['contacts']['title']); ?></span>
                    <span class="mm-arrow"></span>
                </button>
                <div class="mm-section-body">
                    <!-- Телефон -->
                    <?php if (isset($menuConfig['contacts']['phone'])): ?>
                        <div class="mm-contact-label">
                            <img src="<?php echo htmlspecialchars($menuConfig['contacts']['phone']['icon']); ?>" alt="">
                            <span><?php echo htmlspecialchars($menuConfig['contacts']['phone']['label']); ?></span>
                        </div>
                        <a href="<?php echo htmlspecialchars($menuConfig['contacts']['phone']['href']); ?>" class="mm-contact mm-contact-value">
                            <?php echo htmlspecialchars($menuConfig['contacts']['phone']['value']); ?>
                        </a>
                    <?php endif; ?>

                    <!-- Email -->
                    <?php if (isset($menuConfig['contacts']['email'])): ?>
                        <div class="mm-contact-label">
                            <img src="<?php echo htmlspecialchars($menuConfig['contacts']['email']['icon']); ?>" alt="">
                            <span><?php echo htmlspecialchars($menuConfig['contacts']['email']['label']); ?></span>
                        </div>
                        <a href="<?php echo htmlspecialchars($menuConfig['contacts']['email']['href']); ?>" class="mm-contact mm-contact-value">
                            <?php echo htmlspecialchars($menuConfig['contacts']['email']['value']); ?>
                        </a>
                    <?php endif; ?>

                    <!-- Адрес -->
                    <?php if (isset($menuConfig['contacts']['address'])): ?>
                        <div class="mm-contact-label">
                            <img src="<?php echo htmlspecialchars($menuConfig['contacts']['address']['icon']); ?>" alt="">
                            <span><?php echo htmlspecialchars($menuConfig['contacts']['address']['label']); ?></span>
                        </div>
                        <div class="mm-contact-text">
                            <?php echo htmlspecialchars($menuConfig['contacts']['address']['value']); ?>
                            <?php if (isset($menuConfig['contacts']['address']['link'])): ?>
                                <a href="<?php echo htmlspecialchars($menuConfig['contacts']['address']['link']['href']); ?>" class="mm-accent">
                                    <?php echo htmlspecialchars($menuConfig['contacts']['address']['link']['text']); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Кнопка "Построить маршрут" -->
                    <?php if (isset($menuConfig['contacts']['button'])): ?>
                        <a href="<?php echo htmlspecialchars($menuConfig['contacts']['button']['href']); ?>" class="mm-button">
                            <?php echo htmlspecialchars($menuConfig['contacts']['button']['text']); ?>
                        </a>
                    <?php endif; ?>

                    <!-- Ссылка "Запросить коммерческое предложение" -->
                    <?php if (isset($menuConfig['contacts']['link'])): ?>
                        <a href="<?php echo htmlspecialchars($menuConfig['contacts']['link']['href']); ?>" class="mm-link mm-link-arrow">
                            <?php echo htmlspecialchars($menuConfig['contacts']['link']['text']); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?php
}

