<main class="container">
    <section class="section">
        <h1>Անձնական էջ</h1>
        <form method="post" action="/register" novalidate>
            <?= csrf_field() ?>

            <div class="card card__body mb-20">
                <p class="mb-10"><strong>Անուն՝</strong> <?= htmlspecialchars($_SESSION['user']['name'] ?? '') ?></p>
                <p class="mb-10"><strong>Էլ. հասցե՝</strong> <?= htmlspecialchars($_SESSION['user']['email'] ?? '') ?>
                </p>
                <p class="mb-10"><strong>Դեր</strong> <?= htmlspecialchars($_SESSION['user']['role'] ?? '') ?></p>
            </div>

            <div class="row gap-10 align-center">
                <a href="/catalog" class="btn btn-primary">Կատալոգ</a>
                <a href="/cart" class="btn">Զամբյուղ</a>

                <form method="post" action="/logout">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn">Դուրս գալ</button>
                </form>
            </div>
    </section>
</main>