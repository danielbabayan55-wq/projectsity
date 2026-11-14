<main class="container">
    <h1>Կատալոգ</h1>

    <section id="products">
        <div class="row">
            <aside class="col w-25">
                <form method="get" action="/catalog" class="card card__body">
                    <h3 class="mb-15">Կատեգորիա</h3>
                    <div class="mb-20">
                        <label class="block mb-5">
                            <input type="radio" name="category" value="" <?= empty($_GET['category']) ? 'checked' : '' ?>> Բոլորը
                        </label>
                        <?php foreach ($categories as $cat): ?>
                            <label class="block mb-5">
                                <input type="radio" name="category" value="<?= $cat['id'] ?>" <?= (($_GET['category'] ?? '') == $cat['id']) ? 'checked' : '' ?>>
                                <?= htmlspecialchars($cat['name']) ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                    <h3 class="mb-15">Գին, ֏</h3>
                    <div class="row gap-10 mb-20">
                        <div class="col w-50">
                            <label class="field__label">Սկսած</label>
                            <input type="number" name="min_price" class="input" placeholder="0"
                                value="<?= htmlspecialchars($_GET['min_price'] ?? '') ?>">
                        </div>
                        <div class="col w-50">
                            <label class="field__label">Մինչև</label>
                            <input type="number" name="max_price" class="input" placeholder="600000"
                                value="<?= htmlspecialchars($_GET['max_price'] ?? '') ?>">
                        </div>
                    </div>

                    <h3 class="mb-15">Ցուցադրել</h3>
                    <div class="mb-20">
                        <label class="block mb-5">
                            <input type="radio" name="stock" value="" <?= empty($_GET['stock']) ? 'checked' : '' ?>>
                            Բոլորը
                        </label>
                        <label class="block mb-5">
                            <input type="radio" name="stock" value="in" <?= (($_GET['stock'] ?? '') === 'in') ? 'checked' : '' ?>> Միայն առկաները
                        </label>
                        <label class="block mb-5">
                            <input type="radio" name="stock" value="sale" <?= (($_GET['stock'] ?? '') === 'sale') ? 'checked' : '' ?>> Միայն զեղչվածները
                        </label>
                    </div>

                    <div class="row gap-10">
                        <button type="submit" class="btn btn-primary">Կիրառել</button>
                        <a href="/catalog" class="btn">Մաքրել</a>
                    </div>
                </form>
            </aside>

            <div class="col w-75">
                <h2 class="section-title mb-30">Կատալոգ</h2>

                <?php if (!empty($products)): ?>
                    <div class="grid-auto gap-20 mb-30">
                        <?php foreach ($products as $p): ?>
                            <article class="card">
                                <?php if (!empty($p['discount'])): ?>
                                    <span class="card__badge"><?= htmlspecialchars($p['discount']) ?>%</span>
                                <?php endif; ?>

                                <picture class="card__media ratio-3-2">
                                    <img class="img-cover" src="/images/<?= htmlspecialchars($p['image'] ?? 'no-image.png') ?>"
                                        alt="<?= htmlspecialchars($p['name'] ?? '') ?>" width="600" height="400" loading="lazy">
                                </picture>

                                <div class="card__body">
                                    <h3><?= htmlspecialchars($p['name'] ?? '') ?></h3>
                                    <p class="card__meta">
                                        <?= htmlspecialchars($p['description'] ?? '') ?>
                                        <?php if (!empty($p['stock'])): ?>
                                            <br>Մնացել է <?= (int) $p['stock'] ?> հատ
                                        <?php endif; ?>
                                    </p>

                                    <div class="card__footer">
                                        <p class="card__price">
                                            <?php if (!empty($p['discount']) && $p['discount'] > 0): ?>
                                                <?= number_format($p['final_price'] ?? $p['price'], 0, '.', ' ') ?>֏
                                                <br><del class="text-muted"><?= number_format($p['price'], 0, '.', ' ') ?> ֏</del>
                                            <?php else: ?>
                                                <?= number_format($p['price'] ?? 0, 0, '.', ' ') ?> ֏
                                            <?php endif ?>
                                        </p>
                                        <form method="post" action="/cart/add">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($p['id'] ?? '') ?>">
                                            <input type="hidden" name="back" value="/catalog">
                                            <button type="submit" class="btn btn-primary btn-sm"><span>Ավել</span></button>
                                        </form>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>Ապրանքներ չեն գտնվել։</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>