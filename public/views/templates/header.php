<?php /**  @var array $categories */ ?>

<!DOCTYPE html>
<html lang="hy">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TO CHANGE</title>
    <meta name="description" content="5000+ ապրանք, անվճար առաքում Երևանում, 2 տարվա երաշխիք">

    <link rel="icon" href="/images/favicon.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Armenian:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/css/global.css">
    <link rel="stylesheet" href="/css/main.css">
</head>

<body>

    <a href="#main" class="skip-link">Անցնել բովանդակությանը</a>

    <header class="header">
        <input type="checkbox" id="nav" class="nav-toggle">

        <div class="row align-center justify-between">
            <div class="col">
                <a href="/" class="logo">TO CHANGE</a>
            </div>

            <div class="col">
                <label for="nav" class="burger">
                    <span></span><span></span><span></span>
                    <span class="visually-hidden">Մենյու</span>
                </label>

                <nav aria-label="Գլխավոր մենյու">
                    <ul class="menu flex align-center gap-10">
                        <li><a href="/">Գլխավոր</a></li>
                        <li class="has-sub">
                            <a href="/catalog"> Կատալոգ <span aria-hidden="true">▾</span></a>
                            <ul class="submenu">
                                <?php foreach ($categories as $category): ?>
                                    <li><a href="/catalog?category=<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                        <li><a href="/contact">Կապ</a></li>
                        <li><a href="/news">Նորություններ</a></li>
                        <li><a href="/color">Color</a></li>
                        <li>
                            THEME Tecnomarket

                        </li>
                        <?php if (Auth::hasRole('admin', 'manager')): ?>
                            <li> <a href="/admin">Կառավարման Վահանակ</a></li>
                        <?php elseif (Auth::hasRole('customer')): ?>
                            <li> <a href="/account">Ին Էջը</a></li>
                        <?php else: ?>
                            <a href="/login">Մուտք</a>
                            <a href="/register">Գրանցում</a>
                        <?php endif; ?>
                        <li>
                            <a href="/cart" class="btn btn--primary btn--sm">
                                Զամբյուղ <span class="count"><?= array_sum($_SESSION['cart'] ?? []) ?></span><span class="visually-hidden"> ապրանք</span>
                            </a>
                        </li>
                        <?php if (Auth::check()): ?>
                            <form action="/logout" method="post" style="display:inline">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn">Ելք</button>
                            </form>
                        <?php endif; ?>

                    </ul>
                </nav>
            </div>
        </div>
    </header>