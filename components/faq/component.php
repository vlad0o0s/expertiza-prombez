<?php
// Подключаем CSS для компонента
$cssPath = __DIR__ . '/component.css';
if (file_exists($cssPath)) {
    echo '<link rel="stylesheet" href="/components/faq/component.css">';
}
?>

<section class="faq-section animate-on-scroll">
    <div class="container-fluid">
        <div class="faq-inner">
            <h2 class="faq-title">ОТВЕТЫ НА ЧАСТЫЕ ВОПРОСЫ</h2>
            <div class="faq-list">
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false">
                    <span class="faq-question-text">Зачем нужна экспертиза промышленной безопасности?</span>
                    <span class="faq-icon">
                        <img src="/assets/images/Arrow.svg" alt="">
                    </span>
                </button>
                <div class="faq-answer">
                    <p>Она помогает выявить риски аварий и продлить срок безопасной эксплуатации оборудования и объектов.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false">
                    <span class="faq-question-text">Как часто проводится экспертиза?</span>
                    <span class="faq-icon">
                        <img src="/assets/images/Arrow.svg" alt="">
                    </span>
                </button>
                <div class="faq-answer">
                    <p>Обычно раз в несколько лет, в зависимости от типа оборудования и требований нормативных документов.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false">
                    <span class="faq-question-text">Что проверяют эксперты?</span>
                    <span class="faq-icon">
                        <img src="/assets/images/Arrow.svg" alt="">
                    </span>
                </button>
                <div class="faq-answer">
                    <p>Техническое состояние устройств, документацию, условия эксплуатации и соответствие требованиям безопасности.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false">
                    <span class="faq-question-text">Сколько времени занимает экспертиза?</span>
                    <span class="faq-icon">
                        <img src="/assets/images/Arrow.svg" alt="">
                    </span>
                </button>
                <div class="faq-answer">
                    <p>Сроки зависят от объема работ и сложности объекта, в среднем от нескольких дней до нескольких недель.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false">
                    <span class="faq-question-text">Что делать, если объект не прошел экспертизу?</span>
                    <span class="faq-icon">
                        <img src="/assets/images/Arrow.svg" alt="">
                    </span>
                </button>
                <div class="faq-answer">
                    <p>Нужно устранить выявленные нарушения, провести ремонт или модернизацию, после чего пройти повторную проверку.</p>
                </div>
            </div>
        </div>
        </div>
    </div>
</section>

