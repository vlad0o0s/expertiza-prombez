<?php
// Подключаем CSS для компонента
$cssPath = __DIR__ . '/component.css';
if (file_exists($cssPath)) {
    echo '<link rel="stylesheet" href="/components/commercial-proposal-form/component.css">';
}
?>

<section class="commercial-proposal-form-section">
    <div class="container-fluid">
        <div class="form-toggle">
            <div class="page">
                <div class="custom-select1">
                    <select class="form-select-type" onchange="toggleForm(this.value)">
                        <option value="form1">Запрос информационного письма для суда</option>
                        <option value="form2">Досудебная экспертиза</option>
                        <option value="form3">Рецензия на экспертное заключение для суда</option>
                        <option value="form4">Рецензия на экспертное заключение</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="custom-form-wrapper">
            <div class="page">
                <div class="custom-form-wrapper-main">
                    <div class="custom-form-wrapper-main-blocks">
                        <div class="custom-form-wrapper-main-block dnone">
                            <div class="custom-form-wrapper-main-block-top">
                                <h2>Напишите нам</h2>
                                <p class="p-big-form">Данная форма предназначена для запроса коммерческого предложения
                                    (информационного письма)
                                    в
                                    досудебном и судебном порядке</p>
                                <div class="custom-form-wrapper-main-block-duo">
                                    <p class="p-small-form">С ее помощью Вы можете получить информацию о стоимости и
                                        сроках
                                        проведения
                                        независимой
                                        экспертизы для решения правовых споров</p>
                                    <p class="p-small-form">Заполните необходимые поля, и наши специалисты подготовят
                                        для
                                        Вас индивидуальное
                                        коммерческое предложение с учетом специфики вашего дела и направят его вам на
                                        E-mail
                                    </p>
                                </div>
                            </div>
                            <div class="custom-form-wrapper-main-block-bottom">
                                <p class="p-small-form">Коммерческое предложение будет направлено Вам на E-mail в
                                    течение 3
                                    рабочих дней</p>
                            </div>
                        </div>

                        <!-- Форма Запрос информационного письма для суда-->
                        <form class="custom-form form1 active" method="post" enctype="multipart/form-data" action="/sendmail.php">
                            <input type="hidden" name="form_name" value="Запрос информационного письма для суда">
                            <div class="custom-row-one">
                                <input class="custom-input" name="ФИО" type="text" placeholder="ФИО" required />
                            </div>
                            <div class="custom-row">
                                <input class="custom-input" name="Страна" type="text" placeholder="Страна" required />
                                <input class="custom-input" name="Город" type="text" placeholder="Город" required />
                            </div>
                            <div class="custom-row-one">
                                <input class="custom-input" name="Телефон" type="tel" placeholder="Телефон" required />
                                <input class="custom-input" name="Почта" type="email" placeholder="E-mail" required />
                            </div>
                            <div class="custom-select-wrapper-arrow">
                                <select class="custom-select" onchange="toggleFormYr('form1', this.value)">
                                    <option value="chas">Частное лицо</option>
                                    <option value="yr">Представитель юридического лица</option>
                                </select>
                            </div>
                            <input type="hidden" name="Клиент" id="client-type-form1" value="Частное лицо">
                            <div class="chas"></div>
                            <div class="yr">
                                <input class="custom-input" name="Наименование вашей организации" type="text"
                                    placeholder="Наименование вашей организации" disabled />
                                <input class="custom-input" name="Ваша должность" type="text" placeholder="Ваша должность"
                                    disabled />
                            </div>
                            <div class="custom-title">Реквизиты судебного дела:</div>
                            <div class="custom-row">
                                <input class="custom-input" name="Суд, в котором рассматривается дело" type="text"
                                    placeholder="Суд, в котором рассматривается дело" />
                                <input class="custom-input" name="Номер дела" type="text" placeholder="Номер дела" />
                            </div>
                            <div class="custom-row">
                                <input class="custom-input" name="ФИО судьи" type="text" placeholder="ФИО судьи" />
                                <div class="custom-select-wrapper-arrow">
                                    <select class="custom-select" onchange="toggleFormStorona('form1', this.value)">
                                        <option value="ints">Вы представляете сторону истца</option>
                                        <option value="otv">Вы представляете сторону ответчика</option>
                                    </select>
                                </div>
                                <input type="hidden" name="Вы представляете сторону" id="storona-form1" value="Истца">
                            </div>
                            <div class="custom-row">
                                <input class="custom-input" name="Дата судебного заседания" type="text"
                                    placeholder="Дата судебного заседания" />
                                <input class="custom-input" name="Тип экспертизы" type="text"
                                    placeholder="Тип экспертизы (например, строительная)" />
                            </div>
                            <div class="custom-row-one">
                                <textarea class="custom-textarea" name="Опишите ситуацию и Вашу позицию"
                                    placeholder="Опишите ситуацию и Вашу позицию"></textarea>
                            </div>
                            <div class="custom-row-one">
                                <textarea class="custom-textarea" name="Вопросы, которые будут поставлены на исследование"
                                    placeholder="Вопросы, которые будут поставлены на исследование"></textarea>
                            </div>
                            <div class="upload-area" style="position: relative;">
                                <textarea class="custom-textarea" name="other_materials"
                                    placeholder="Другие материалы"></textarea>

                                <input type="file" class="pdfUpload" name="pdf_files[]" accept="application/pdf" multiple
                                    style="display: none;">

                                <div class="upload-icon"
                                    style="position: absolute; bottom: 10px; right: 10px; cursor: pointer;">
                                    <img src="/assets/images/clip-icon.svg" alt="Прикрепить файл" width="20">
                                </div>
                            </div>

                            <div class="opisanie-zagruzki">
                                <p>Если у Вас есть электронные копии документов или другие материалы, которые имеют
                                    отношение к рассматриваемому делу, приложите их к сообщению. Максимальный размер
                                    одного файла не должен превышать 10Мб, а суммарный объем - 30Мб. Если вам требуется
                                    передать файл большего размера, то Вы можете воспользоваться одним из бесплатных
                                    файлообменных сервисов, например: <span>files.mail.ru</span> или
                                    <span>disk.yandex.ru</span>
                                </p>
                            </div>

                            <!-- Превью загруженных PDF файлов -->
                            <div class="uploaded-files"></div>

                            <!-- <div class="g-recaptcha" data-sitekey="6LfLuBsrAAAAAAcuum4r7uVGaB4WGV4TQKk5VLfd"></div> -->
                            <div class="form-checkbox-wrapper">
                                <input type="checkbox" name="agree" id="agree-form1" class="form-checkbox" required>
                                <label for="agree-form1" class="form-checkbox-label">
                                    Нажимая кнопку "Отправить", я принимаю <a href="#">соглашение о конфиденциальности</a> и
                                    соглашаюсь с обработкой персональных данных
                                </label>
                            </div>
                            <div class="custom-submit-wrapper">
                                <button type="submit" class="custom-submit">Отправить</button>
                                <button type="submit" class="custom-submit-arrow" aria-label="Отправить">
                                    <img src="/assets/images/Arrow.svg" alt="">
                                </button>
                            </div>
                        </form>

                        <!-- Досудебная экспертиза-->
                        <form class="custom-form form2" method="post" enctype="multipart/form-data" action="/sendmail.php">
                            <input type="hidden" name="form_name" value="Досудебная экспертиза">
                            <div class="custom-row-one">
                                <input class="custom-input" name="ФИО" type="text" placeholder="ФИО" required />
                            </div>
                            <div class="custom-row">
                                <input class="custom-input" name="Страна" type="text" placeholder="Страна" required />
                                <input class="custom-input" name="Город" type="text" placeholder="Город" required />
                            </div>
                            <div class="custom-row-one">
                                <input class="custom-input" name="Телефон" type="tel" placeholder="Телефон" required />
                                <input class="custom-input" name="Почта" type="email" placeholder="E-mail" required />
                            </div>
                            <div class="custom-select-wrapper-arrow">
                                <select class="custom-select" onchange="toggleFormYr('form2', this.value)">
                                    <option value="chas">Частное лицо</option>
                                    <option value="yr">Представитель юридического лица</option>
                                </select>
                            </div>
                            <input type="hidden" name="Клиент" id="client-type-form2" value="Частное лицо">
                            <div class="chas"></div>
                            <div class="yr">
                                <input class="custom-input" name="Наименование вашей организации" type="text"
                                    placeholder="Наименование вашей организации" disabled />
                                <input class="custom-input" name="Ваша должность" type="text" placeholder="Ваша должность"
                                    disabled />
                            </div>
                            <div class="custom-title">Вид экспертизы:</div>
                            <div class="custom-row">
                                <input class="custom-input" name="Тип экспертизы" type="text"
                                    placeholder="Тип экспертизы (например, строительная)" />
                            </div>
                            <div class="custom-row-one">
                                <textarea class="custom-textarea" name="Опишите ситуацию и Вашу позицию"
                                    placeholder="Опишите ситуацию и Вашу позицию"></textarea>
                            </div>
                            <div class="custom-row-one">
                                <textarea class="custom-textarea" name="Вопросы, которые будут поставлены на исследование"
                                    placeholder="Вопросы, которые будут поставлены на исследование"></textarea>
                            </div>
                            <div class="upload-area" style="position: relative;">
                                <textarea class="custom-textarea" name="other_materials"
                                    placeholder="Другие материалы"></textarea>

                                <input type="file" class="pdfUpload" name="pdf_files[]" accept="application/pdf" multiple
                                    style="display: none;">

                                <div class="upload-icon"
                                    style="position: absolute; bottom: 10px; right: 10px; cursor: pointer;">
                                    <img src="/assets/images/clip-icon.svg" alt="Прикрепить файл" width="20">
                                </div>
                            </div>

                            <div class="opisanie-zagruzki">
                                <p>Если у Вас есть электронные копии документов или другие материалы, которые имеют
                                    отношение к рассматриваемому делу, приложите их к сообщению. Максимальный размер
                                    одного файла не должен превышать 10Мб, а суммарный объем - 30Мб. Если вам требуется
                                    передать файл большего размера, то Вы можете воспользоваться одним из бесплатных
                                    файлообменных сервисов, например: <span>files.mail.ru</span> или
                                    <span>disk.yandex.ru</span>
                                </p>
                            </div>

                            <!-- Превью загруженных PDF файлов -->
                            <div class="uploaded-files"></div>

                            <!-- <div class="g-recaptcha" data-sitekey="6LfLuBsrAAAAAAcuum4r7uVGaB4WGV4TQKk5VLfd"></div> -->
                            <div class="form-checkbox-wrapper">
                                <input type="checkbox" name="agree" id="agree-form1" class="form-checkbox" required>
                                <label for="agree-form1" class="form-checkbox-label">
                                    Нажимая кнопку "Отправить", я принимаю <a href="#">соглашение о конфиденциальности</a> и
                                    соглашаюсь с обработкой персональных данных
                                </label>
                            </div>
                            <div class="custom-submit-wrapper">
                                <button type="submit" class="custom-submit">Отправить</button>
                                <button type="submit" class="custom-submit-arrow" aria-label="Отправить">
                                    <img src="/assets/images/Arrow.svg" alt="">
                                </button>
                            </div>
                        </form>

                        <!-- Рецензия на экспертное заключение для суда-->
                        <form class="custom-form form3" method="post" enctype="multipart/form-data" action="/sendmail.php">
                            <input type="hidden" name="form_name" value="Рецензия на экспертное заключение для суда">
                            <div class="custom-row-one">
                                <input class="custom-input" name="ФИО" type="text" placeholder="ФИО" required />
                            </div>
                            <div class="custom-row">
                                <input class="custom-input" name="Страна" type="text" placeholder="Страна" required />
                                <input class="custom-input" name="Город" type="text" placeholder="Город" required />
                            </div>
                            <div class="custom-row-one">
                                <input class="custom-input" name="Телефон" type="tel" placeholder="Телефон" required />
                                <input class="custom-input" name="Почта" type="email" placeholder="E-mail" required />
                            </div>
                            <div class="custom-select-wrapper-arrow">
                                <select class="custom-select" onchange="toggleFormYr('form3', this.value)">
                                    <option value="chas">Частное лицо</option>
                                    <option value="yr">Представитель юридического лица</option>
                                </select>
                            </div>
                            <input type="hidden" name="Клиент" id="client-type-form3" value="Частное лицо">
                            <div class="chas"></div>
                            <div class="yr">
                                <input class="custom-input" name="Наименование вашей организации" type="text"
                                    placeholder="Наименование вашей организации" disabled />
                                <input class="custom-input" name="Ваша должность" type="text" placeholder="Ваша должность"
                                    disabled />
                            </div>
                            <div class="custom-title">Описание рецензируемой экспертизы:</div>
                            <div class="custom-row">
                                <input class="custom-input" name="Экспертная организация, проводившая экспертизу"
                                    type="text" placeholder="Экспертная организация, проводившая экспертизу" />
                            </div>
                            <div class="custom-row">
                                <input class="custom-input" name="ФИО эксперта" type="text" placeholder="ФИО эксперта" />
                            </div>
                            <div class="custom-row">
                                <input class="custom-input" name="Количество страниц" type="text"
                                    placeholder="Количество страниц" />
                                <input class="custom-input" name="Дата написания" type="text"
                                    placeholder="Дата написания" />
                            </div>
                            <div class="custom-title">Реквизиты судебного дела:</div>
                            <div class="custom-row">
                                <input class="custom-input" name="Суд, в котором рассматривается дело" type="text"
                                    placeholder="Суд, в котором рассматривается дело" />
                                <input class="custom-input" name="Номер дела" type="text" placeholder="Номер дела" />
                            </div>
                            <div class="custom-row">
                                <input class="custom-input" name="ФИО судьи" type="text" placeholder="ФИО судьи" />
                                <div class="custom-select-wrapper-arrow">
                                    <select class="custom-select" onchange="toggleFormStorona('form3', this.value)">
                                        <option value="ints">Вы представляете сторону истца</option>
                                        <option value="otv">Вы представляете сторону ответчика</option>
                                    </select>
                                </div>
                                <input type="hidden" name="Вы представляете сторону" id="storona-form3" value="Истца">
                            </div>
                            <div class="custom-row">
                                <input class="custom-input" name="Дата судебного заседания" type="text"
                                    placeholder="Дата судебного заседания" />
                                <input class="custom-input" name="Тип экспертизы" type="text"
                                    placeholder="Тип экспертизы (например, строительная)" />
                            </div>
                            <div class="custom-row-one">
                                <textarea class="custom-textarea" name="Опишите ситуацию и Вашу позицию"
                                    placeholder="Опишите ситуацию и Вашу позицию"></textarea>
                            </div>
                            <div class="custom-row-one">
                                <textarea class="custom-textarea" name="Вопросы, которые будут поставлены на исследование"
                                    placeholder="Вопросы, которые будут поставлены на исследование"></textarea>
                            </div>
                            <div class="upload-area" style="position: relative;">
                                <textarea class="custom-textarea" name="other_materials"
                                    placeholder="Другие материалы"></textarea>

                                <input type="file" class="pdfUpload" name="pdf_files[]" accept="application/pdf" multiple
                                    style="display: none;">

                                <div class="upload-icon"
                                    style="position: absolute; bottom: 10px; right: 10px; cursor: pointer;">
                                    <img src="/assets/images/clip-icon.svg" alt="Прикрепить файл" width="20">
                                </div>
                            </div>

                            <div class="opisanie-zagruzki">
                                <p>Если у Вас есть электронные копии документов или другие материалы, которые имеют
                                    отношение к рассматриваемому делу, приложите их к сообщению. Максимальный размер
                                    одного файла не должен превышать 10Мб, а суммарный объем - 30Мб. Если вам требуется
                                    передать файл большего размера, то Вы можете воспользоваться одним из бесплатных
                                    файлообменных сервисов, например: <span>files.mail.ru</span> или
                                    <span>disk.yandex.ru</span>
                                </p>
                            </div>

                            <!-- Превью загруженных PDF файлов -->
                            <div class="uploaded-files"></div>

                            <!-- <div class="g-recaptcha" data-sitekey="6LfLuBsrAAAAAAcuum4r7uVGaB4WGV4TQKk5VLfd"></div> -->
                            <div class="form-checkbox-wrapper">
                                <input type="checkbox" name="agree" id="agree-form1" class="form-checkbox" required>
                                <label for="agree-form1" class="form-checkbox-label">
                                    Нажимая кнопку "Отправить", я принимаю <a href="#">соглашение о конфиденциальности</a> и
                                    соглашаюсь с обработкой персональных данных
                                </label>
                            </div>
                            <div class="custom-submit-wrapper">
                                <button type="submit" class="custom-submit">Отправить</button>
                                <button type="submit" class="custom-submit-arrow" aria-label="Отправить">
                                    <img src="/assets/images/Arrow.svg" alt="">
                                </button>
                            </div>
                        </form>

                        <!-- Рецензия на экспертное заключение -->
                        <form class="custom-form form4" method="post" enctype="multipart/form-data" action="/sendmail.php">
                            <input type="hidden" name="form_name" value="Рецензия на экспертное заключение">
                            <div class="custom-row-one">
                                <input class="custom-input" name="ФИО" type="text" placeholder="ФИО" required />
                            </div>
                            <div class="custom-row">
                                <input class="custom-input" name="Страна" type="text" placeholder="Страна" required />
                                <input class="custom-input" name="Город" type="text" placeholder="Город" required />
                            </div>
                            <div class="custom-row-one">
                                <input class="custom-input" name="Телефон" type="tel" placeholder="Телефон" required />
                                <input class="custom-input" name="Почта" type="email" placeholder="E-mail" required />
                            </div>
                            <div class="custom-select-wrapper-arrow">
                                <select class="custom-select" onchange="toggleFormYr('form4', this.value)">
                                    <option value="chas">Частное лицо</option>
                                    <option value="yr">Представитель юридического лица</option>
                                </select>
                            </div>
                            <input type="hidden" name="Клиент" id="client-type-form4" value="Частное лицо">
                            <div class="chas"></div>
                            <div class="yr">
                                <input class="custom-input" name="Наименование вашей организации" type="text"
                                    placeholder="Наименование вашей организации" disabled />
                                <input class="custom-input" name="Ваша должность" type="text" placeholder="Ваша должность"
                                    disabled />
                            </div>
                            <div class="custom-title">Описание рецензируемой экспертизы:</div>
                            <div class="custom-row">
                                <input class="custom-input" name="Экспертная организация, проводившая экспертизу"
                                    type="text" placeholder="Экспертная организация, проводившая экспертизу" />
                            </div>
                            <div class="custom-row">
                                <input class="custom-input" name="Вид экспертизы (например, строительная)" type="text"
                                    placeholder="Вид экспертизы (например, строительная)" />
                                <input class="custom-input" name="Дата написания" type="text"
                                    placeholder="Дата написания" />
                            </div>
                            <div class="custom-row">
                                <input class="custom-input" name="Количество страниц" type="text"
                                    placeholder="Количество страниц" />
                                <input class="custom-input" name="ФИО эксперта" type="text" placeholder="ФИО эксперта" />
                            </div>
                            <div class="custom-row-one">
                                <textarea class="custom-textarea" name="Опишите ситуацию и Вашу позицию"
                                    placeholder="Опишите ситуацию и Вашу позицию"></textarea>
                            </div>
                            <div class="custom-row-one">
                                <textarea class="custom-textarea" name="Вопросы, которые будут поставлены на исследование"
                                    placeholder="Вопросы, которые будут поставлены на исследование"></textarea>
                            </div>
                            <div class="upload-area" style="position: relative;">
                                <textarea class="custom-textarea" name="other_materials"
                                    placeholder="Другие материалы"></textarea>

                                <input type="file" class="pdfUpload" name="pdf_files[]" accept="application/pdf" multiple
                                    style="display: none;">

                                <div class="upload-icon"
                                    style="position: absolute; bottom: 10px; right: 10px; cursor: pointer;">
                                    <img src="/assets/images/clip-icon.svg" alt="Прикрепить файл" width="20">
                                </div>
                            </div>

                            <div class="opisanie-zagruzki">
                                <p>Если у Вас есть электронные копии документов или другие материалы, которые имеют
                                    отношение к рассматриваемому делу, приложите их к сообщению. Максимальный размер
                                    одного файла не должен превышать 10Мб, а суммарный объем - 30Мб. Если вам требуется
                                    передать файл большего размера, то Вы можете воспользоваться одним из бесплатных
                                    файлообменных сервисов, например: <span>files.mail.ru</span> или
                                    <span>disk.yandex.ru</span>
                                </p>
                            </div>

                            <!-- Превью загруженных PDF файлов -->
                            <div class="uploaded-files"></div>

                            <!-- <div class="g-recaptcha" data-sitekey="6LfLuBsrAAAAAAcuum4r7uVGaB4WGV4TQKk5VLfd"></div> -->
                            <div class="form-checkbox-wrapper">
                                <input type="checkbox" name="agree" id="agree-form1" class="form-checkbox" required>
                                <label for="agree-form1" class="form-checkbox-label">
                                    Нажимая кнопку "Отправить", я принимаю <a href="#">соглашение о конфиденциальности</a> и
                                    соглашаюсь с обработкой персональных данных
                                </label>
                            </div>
                            <div class="custom-submit-wrapper">
                                <button type="submit" class="custom-submit">Отправить</button>
                                <button type="submit" class="custom-submit-arrow" aria-label="Отправить">
                                    <img src="/assets/images/Arrow.svg" alt="">
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
