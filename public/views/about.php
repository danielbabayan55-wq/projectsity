<h1><?= htmlspecialchars($title) ?></h1>

<!-- 1. Сообщения об успехе или ошибке из адресной строки ($_GET) -->
<?php if (isset($_GET['feedback'])): ?>
    <p style="color: green;">Спасибо! Ваш отзыв отправлен на модерацию.</p>
<?php elseif (isset($_GET['deleted'])): ?>
    <p style="color: orange;">Отзыв удален.</p>
<?php elseif (isset($_GET['approved'])): ?>
    <p style="color: green;">Отзыв одобрен и опубликован.</p>
<?php elseif (isset($_GET['error'])): ?>
    <p style="color: red;">Пожалуйста, заполните все поля формы.</p>
<?php endif; ?>

<!-- 2. Вывод информации "О компании" (переменная $items из getAllAbout) -->
<section>
    <?php foreach ($items as $item): ?>
        <div class="about-block">
            <h2><?= htmlspecialchars($item['name'] ?? '') ?></h2>
            <p><?= htmlspecialchars($item['description'] ?? '') ?></p>
        </div>
    <?php endforeach; ?>
</section>

<hr>

<!-- 3. Форма добавления нового отзыва -->
<section>
    <h3>Оставить отзыв</h3>
    <form action="/about/feedback" method="POST">
        <!-- Скрытое поле с CSRF-токеном (метод из твоего класса Csrf) -->
        <?= Csrf::field() ?>

        <div>
            <label>Ваше имя:</label><br>
            <input type="text" name="name" required>
        </div>
        <br>
        <div>
            <label>Сообщение:</label><br>
            <textarea name="message" rows="4" required></textarea>
        </div>
        <br>
        <button type="submit">Отправить отзыв</button>
    </form>
</section>

<hr>

<!-- 4. Вывод одобренных отзывов (переменная $feedback из getApprovedFeedback) -->
<section>
    <h3>Отзывы клиентов</h3>
    <?php if (empty($feedback)): ?>
        <p>Пока нет ни одного отзыва.</p>
    <?php else: ?>
        <?php foreach ($feedback as $fb): ?>
            <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
                <strong><?= htmlspecialchars($fb['name']) ?></strong>
                <p><?= htmlspecialchars($fb['message']) ?></p>

                <!-- Кнопки управления показываем ТОЛЬКО администратору -->
                <?php if (Auth::hasRole('admin')): ?>
                    <div style="display: flex; gap: 10px;">
                        <!-- Форма одобрения (POST + CSRF) -->
                        <form action="/about/approve" method="POST">
                            <?= Csrf::field() ?>
                            <input type="hidden" name="id" value="<?= (int)$fb['id'] ?>">
                            <button type="submit">Одобрить</button>
                        </form>

                        <!-- Форма удаления (POST + CSRF) -->
                        <form action="/about/delete" method="POST" onsubmit="return confirm('Удалить этот отзыв?');">
                            <?= Csrf::field() ?>
                            <input type="hidden" name="id" value="<?= (int)$fb['id'] ?>">
                            <button type="submit">Удалить</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</section>