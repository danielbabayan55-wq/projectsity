<section class="section">
    <div class="container">
        <div class="row">
            <div class="col w-100">
                <h1 class="section-title mb-30"><?= htmlspecialchars($title ?? 'Նախընտրածներ') ?></h1>

                <?php if (empty($products)): ?>
                    <p>Ձեր նախընտրածների ցանկը դատարկ է։ <a href="/catalog" class="btn btn-primary btn-sm">Անցնել կատալոգ</a></p>
                <?php else: ?>
                    <!-- Кнопка полной очистки списка -->
                    <form method="post" action="/wishlist/clear" class="mb-30">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-sm">Մաքրել ցանկը</button>
                    </form>

                    <!-- Сетка товаров (в стиле твоего home.php) -->
                    <div class="grid-auto gap-20 mb-30">
                        <?php foreach ($products as $p): ?>
                            <article class="card">
                                <picture class="card__media ratio-3-2">
                                    <img class="img cover" src="/images/<?= htmlspecialchars($p['image'] ?? '') ?>" alt="<?= htmlspecialchars($p['name'] ?? '') ?>" loading="lazy">
                                </picture>

                                <div class="card__body">
                                    <h3><?= htmlspecialchars($p['name'] ?? '') ?></h3>
                                </div>

                                <div class="card__footer">
                                    <p class="card__price">
                                        <?= number_format((float)($p['price'] ?? 0), 0, '.', ' ') ?> ֏
                                    </p>

                                    <!-- Кнопка в корзину -->
                                    <form method="post" action="/cart/add">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="id" value="<?= (int)($p['id'] ?? 0) ?>">
                                        <input type="hidden" name="back" value="/wishlist">
                                        <button type="submit" class="btn btn-primary btn-sm"><span>Գնել</span></button>
                                    </form>

                                    <!-- Кнопка удалить из избранного -->
                                    <form method="post" action="/wishlist/toggle">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="product_id" value="<?= (int)($p['id'] ?? 0) ?>">
                                        <button type="submit" class="btn btn-sm" title="Հեռացնել">❌</button>
                                    </form>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
