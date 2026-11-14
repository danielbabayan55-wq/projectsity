<!-- Блок выбора характеристик одежды -->
<div class="product-options" style="margin: 15px 0; text-align: left; display: flex; flex-direction: column; gap: 8px;">
    
    <!-- Выбор размера -->
    <label style="font-size: 13px; color: #555; font-weight: bold;">
        Размер:
        <select name="size" style="width: 100%; padding: 6px; margin-top: 4px; border: 1px solid #ccc; border-radius: 4px; cursor: pointer;">
            <?php if (!empty($all_color)): ?>
                <?php foreach ($all_color as $item): ?>
                    <!-- Выводим размер динамически из базы данных -->
                    <option value="<?= htmlspecialchars($item['size']) ?>">
                        <?= htmlspecialchars($item['size']) ?> (Осталось: <?= $item['stock'] ?> шт.)
                    </option>
                <?php endforeach; ?>
            <?php else: ?>
                <option value="">Нет в наличии</option>
            <?php endif; ?>
        </select>
    </label>

    <!-- Выбор цвета -->
    <label style="font-size: 13px; color: #555; font-weight: bold;">
        Цвет:
        <select name="color" style="width: 100%; padding: 6px; margin-top: 4px; border: 1px solid #ccc; border-radius: 4px; cursor: pointer;">
            <?php if (!empty($all_color)): ?>
                <?php foreach ($all_color as $item): ?>
                    <!-- Выводим цвет динамически из базы данных -->
                    <option value="<?= htmlspecialchars($item['color']) ?>">
                        <?= htmlspecialchars($item['color']) ?>
                    </option>
                <?php endforeach; ?>
            <?php else: ?>
                <option value="">Нет в наличии</option>
            <?php endif; ?>
        </select>
    </label>

</div>
