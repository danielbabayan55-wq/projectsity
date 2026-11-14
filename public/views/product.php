<main class="container">
    <section class="section">
        <nav>
            <ul>
                <li><a href="/catalog">← Կատալոգ</a></li>
            </ul>
        </nav>
        <div class="row gap-20 align-start">
            <div class="col w-50">
                <div class="card">
                    <picture class="card__media ratio-3-2">
                        <img class="img-cover"
                            src="/images/<?= htmlspecialchars($product['image'] ?? 'no-image.png') ?>"
                            alt="<?= htmlspecialchars($product['name'] ?? '') ?>" width="600" height="400"
                            loading="lazy">
                    </picture>
                </div>
            </div>
        </div>
        <div class="col w-50">
            <div class="card card__body">
                <h1><?= htmlspecialchars($product['name'] ?? '') ?></h1>
            </div>
        </div>
        <!-- 1. Характеристики и описание (обычным текстом) -->
        <?php if (!empty($product['specs'])): ?>
            <p class="text-muted mb-15"><?= htmlspecialchars($product['specs']) ?></p>
        <?php endif; ?>

        <?php if (!empty($product['description'])): ?>
            <p class="mb-20"><?= htmlspecialchars($product['description']) ?></p>
        <?php endif; ?>
        <!-- 2. Цена (с учётом скидки) -->
        <div class="mb-15">
            <?php if (!empty($product['discount']) && $product['discount'] > 0): ?>

                <?php $finalPrice = $product['price'] - ($product['price'] * $product['discount'] / 100); ?>
                <strong class="card__price"><?= number_format($finalPrice, 0, '.', ' ') ?> ֏</strong>
                <del class="text-muted"><?= number_format($product['price'], 0, '.', ' ') ?> ֏</del>
            <?php else: ?>
                <strong class="card__price"><?= number_format($product['price'] ?? 0, 0, '.', ' ') ?> ֏</strong>
            <?php endif; ?>
        </div>
        <!-- 3. Остаток на складе -->
        <p class="mb-20">Առկա է՝ <strong><?= (int) ($product['stock'] ?? 0) ?></strong>հատ</p>
        <form method="post" action="/cart/add">
            <?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= (int)($product['id'])?>">
            <input type="hidden" name="back" value="/product/ <?= (int)($product['id'])?>">
            <button type="submit" class="btn btn-primary btn-sm"><span>Ավելացնել զամբյուղ</span></button>
        </form>
    </section>
</main>