<main class="container">
    <section class="section">
        <nav aria-label="Դուք այստեղ եք" class="mb-15">
            <a href="/" class="link">Գլխավոր</a> / <span>Զամբյուղ</span>
        </nav>

        <h1 class="section-title">Զամբյուղ</h1>
        <p class="text-muted mb-30"><?= (int) $totalCount ?> ապրանք</p>

        <?php if (!empty($items)): ?>
            <div class="row gap-20 align-start">
                <div class="col w-70">
                    <div class="card card__body mb-20">
                        <table class="table w-100">
                            <thead>
                                <tr>
                                    <th>Ապրանք</th>
                                    <th>Գին</th>
                                    <th>Քանակ</th>
                                    <th>Գումար</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($items as $item):
                                    $p = $item['product'];
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="row gap-15 align-center">
                                                <img src="/images/<?= htmlspecialchars($p['image'] ?? 'no-image.png') ?>"
                                                    alt="<?= htmlspecialchars($p['name'] ?? '') ?>" width="60" height="60"
                                                    class="img-cover">
                                                <div>
                                                    <strong><?= htmlspecialchars($p['name'] ?? '') ?></strong>
                                                    <?php if (!empty($p['description'])): ?>
                                                        <p class="text-muted"><?= htmlspecialchars($p['description']) ?></p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?= number_format($item['price'], 0, '.', ' ') ?> ֏</td>
                                        <td>
                                            <form method="post" action="/cart/update" class="row gap-5 align-center">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="id" value="<?= (int) $p['id'] ?>">
                                                <button type="submit" name="action" value="dec" class="btn btn-sm">−</button>
                                                <span><?= (int) $item['qty'] ?></span>
                                                <button type="submit" name="action" value="inc" class="btn btn-sm">+</button>
                                            </form>
                                        </td>
                                        <td><strong><?= number_format($item['subtotal'], 0, '.', ' ') ?> ֏</strong></td>
                                        <td>
                                            <form method="post" action="/cart/remove">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="id" value="<?= (int) $p['id'] ?>">
                                                <button type="submit" class="btn btn-sm text-danger">Հեռացնել</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="row justify-between align-center">
                        <a href="/catalog" class="btn">← Շարունակել գնումները</a>
                        <form method="post" action="/cart/clear">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn">Դատարկել զամբյուղը</button>
                        </form>
                    </div>
                </div>

                <aside class="col w-30">
                    <div class="card card__body w-100">
                        <h3 class="mb-20">Ամփոփում</h3>

                        <div class="row justify-between mb-10">
                            <span>Ապրանքներ (<?= (int) $totalCount ?>)</span>
                            <span><?= number_format($totalPrice, 0, '.', ' ') ?> ֏</span>
                        </div>

                        <div class="row justify-between mb-20">
                            <span>Առաքում</span>
                            <span>Անվճար</span>
                        </div>

                        <hr class="mb-20">

                        <div class="row justify-between mb-20">
                            <strong>Ընդամենը</strong>
                            <strong><?= number_format($totalPrice, 0, '.', ' ') ?> ֏</strong>
                        </div>

                        <a href="/checkout" class="btn btn-primary w-100">Ձևակերպել պատվերը</a>
                        <p class="text-muted mt-10">Առաքումը Երևանում անվճար է 50 000 ֏-ից</p>
                    </div>
                </aside>
            </div>
        <?php else: ?>
            <div class="card card__body">
                <p class="mb-20">Ձեր զամբյուղը դատարկ է։</p>
                <a href="/catalog" class="btn btn-primary">Անցնել կատալոգ</a>
            </div>
        <?php endif; ?>
    </section>
</main>