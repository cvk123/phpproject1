<form method="POST" class="harry-potter-form">
    <div class="form-group">
        <input 
        type="text" 
        name="first_name" 
        placeholder="Křestní jméno" 
        required>
    </div>
    <div class="form-group">
        <input 
        type="text" 
        name="second_name" 
        placeholder="Příjmení" 
        required>
    </div>
    <div class="form-group">
        <input 
        type="number" 
        name="age" 
        placeholder="Věk min 10 let" 
        min="10" 
        required>
    </div>
    <div class="form-group">
        <textarea 
        name="life" 
        placeholder="Podrobnosti o žákovi" 
        required></textarea>
    </div>
    <div class="form-group">
        <label for="college">Kolej:</label>
        <select name="college" id="college" required>
            <option value="">Vyberte kolej</option>
            <option value="Nebelvír">Nebelvír</option>
            <option value="Havraspár">Havraspár</option>
            <option value="Zmijozel">Zmijozel</option>
            <option value="Mrzimor">Mrzimor</option>
        </select>
    </div>
    <div class="form-group">
        <input type="submit" value="Uložit">
    </div>
</form>