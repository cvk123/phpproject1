<form method="POST" class="harry-potter-form">
    <div class="form-group">
        <input type="text" name="first_name" placeholder="Křestní jméno" required value="<?php echo $first_name; ?>">
    </div>
    <div class="form-group">
        <input type="text" name="second_name" placeholder="Příjmení" required value="<?php echo $second_name; ?>">
    </div>
    <div class="form-group">
        <input type="number" name="age" placeholder="Věk min 10 let" min="10" required value="<?php echo $age; ?>">
    </div>
    <div class="form-group">
        <textarea name="life" placeholder="Podrobnosti o žákovi" required><?php echo $life; ?></textarea>
    </div>
    <div class="form-group">
        <label for="college">Kolej:</label>
        <select name="college" id="college" required>
            <option value="">Vyberte kolej</option>
            <option value="Nebelvír" <?php if ($college === 'Nebelvír') echo 'selected'; ?>>Nebelvír</option>
            <option value="Havraspár" <?php if ($college === 'Havraspár') echo 'selected'; ?>>Havraspár</option>
            <option value="Zmijozel" <?php if ($college === 'Zmijozel') echo 'selected'; ?>>Zmijozel</option>
            <option value="Mrzimor" <?php if ($college === 'Mrzimor') echo 'selected'; ?>>Mrzimor</option>
        </select>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" value="Uložit">
    </div>
</form>