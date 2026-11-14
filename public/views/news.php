
<main style="padding: 40px 20px; max-width: 1200px; margin: 0 auto;">
    <h1 style="margin-bottom: 30px;">Новости проекта</h1>

    <div class="news-list" style="display: flex; flex-direction: column; gap: 20px;">
        <?php if (!empty($all_news)): ?>
            <?php foreach ($all_news as $item): ?>
                <article style="border: 1px solid #ddd; padding: 20px; border-radius: 8px; background: #fff;">
                    <h3 style="margin-top: 0; color: #333; font-size: 20px;">
                        <?= htmlspecialchars($item['title']) ?>
                    </h3>
                    <p style="color: #666; line-height: 1.6; margin-bottom: 0;">
                        <?= htmlspecialchars($item['text']) ?>
                    </p>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Новостей пока нет.</p>
        <?php endif; ?>
    </div>
</main>

