
<div class="container">
    <h1 class="h1">Recherche</h1>
    <form action="index.php?action=search" method="get">
        <div class="row">
        <div class="input-field col s8">
            <label for="search-field">Data</label>
            <input type="text" id="search-field" placeholder="data"/>
        </div>
        <div class="input-field col s4">
            <select class="browser-default">
                <option value="" disabled selected>Choose your option</option>
                <?php foreach ($aniField as $field): ?>
                <option value="<?= $field ?>"><?= ucfirst($field) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        </div>
        <button class="btn waves-effect waves-light" type="submit" name="action">Rechercher
            <i class="material-icons right">add_box</i>
        </button>
    </form>
</div>