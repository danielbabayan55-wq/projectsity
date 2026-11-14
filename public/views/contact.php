<main class="container">
    <section class="section">
        <h1 class="section-title">Կապ</h1>
        <p class="text-muted mb-20">Գրեք հաղորդագրություն թեմայով. Կպատասխանենք մեկ աշխատանքային օրվա ընթացքում։</p>

        <div class="row gap-20 align-start">
            <div class="col w-60 w-md-100">
                <div class="card card__body">
                    <?php if (isset($_GET['sent'])): ?>
                        <div class="alert alert--success mb-20" role="status">
                            Ձեր հաղորդագրությունը հաջողությամբ ուղարկվել է։
                        </div>
                    <?php endif; ?>

                    <form method="post" action="/contact">
                        <?= csrf_field() ?>
                        <div class="row gap-20 mb-20">
                            <div class="col w-50">
                                <div class="field">
                                    <label for="name" class="field__label">Անուն <span class="req" aria-hidden="true">*</span></label>
                                    <input type="text" id="name" name="name" class="input" required>
                                </div>
                            </div>
                            <div class="col w-50">
                                <div class="field">
                                    <label for="email" class="field__label">Էլ. հասցե <span class="req" aria-hidden="true">*</span></label>
                                    <input type="email" id="email" name="email" class="input" required>
                                </div>
                            </div>
                        </div>

                        <div class="field mb-20">
                            <label for="subject" class="field__label">Թեմա <span class="req" aria-hidden="true">*</span></label>
                            <select id="subject" name="subject" class="input" required>
                                <option value="">— ընտրեք —</option>
                                <option value="order">Պատվերի հարց</option>
                                <option value="product">Ապրանքի խորհրդատվություն</option>
                                <option value="other">Այլ հարց</option>
                            </select>
                        </div>

                        <div class="field mb-20">
                            <label for="message" class="field__label">Հաղորդագրություն <span class="req" aria-hidden="true">*</span></label>
                            <textarea id="message" name="message" class="input" rows="5" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Ուղարկել</button>
                    </form>
                </div>
            </div>

            <div class="col col w-40 w-md-100"">
                <div class="card card__body w-100">
                    <h3 class="mb-15">Խանութ</h3>
                    <p class="mb-10">Երևան, Աբովյան 1</p>
                    <p class="mb-10">Ամեն օր՝ 10:00–20:00</p>
                    <p><a href="tel:+37410000000" class="link">+374 10 00 00 00</a></p>
                </div>
            </div>
        </div>
    </section>
</main>
