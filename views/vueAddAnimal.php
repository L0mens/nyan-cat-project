<div class="container">
    <?php include('message.php') ?>
    <?php if (!empty($animal)): ?>
    <h1 class="h1">Editer <?=  $animal->getNom(); ?></h1>
    <?php else: ?>
    <h1 class="h1">Ajouter un animal</h1>
    <?php endif; ?>
    <form <?php if (!empty($animal)): echo 'action="index.php?action=edit-animal"'; else: echo 'action="index.php?action=add-animal"'; endif; ?>
            method="post">
        <label for="add-animal-name">Nom</label>
        <input type="text" id="add-animal-name" name="animal-nom"
               placeholder="Nom" <?php if (!empty($animal)): echo 'value="' . $animal->getNom() . '"'; endif; ?>/>
        <label for="add-animal-espece">Espèce</label>
        <input type="text" id="add-animal-espece" name="animal-espece"
               placeholder="Espèce" <?php if (!empty($animal)): echo 'value="' . $animal->getEspece() . '"'; endif; ?>/>
        <label for="add-animal-cri">Cri</label>
        <input type="text" id="add-animal-cri" name="animal-cri"
               placeholder="Cri" <?php if (!empty($animal)): echo 'value="' . $animal->getCri() . '"'; endif; ?>/>
        <label for="add-animal-proprietaire">Propriétaire</label>
        <input type="text" id="add-animal-proprietaire" name="animal-proprietaire"
               placeholder="Propriétaire" <?php if (!empty($animal)): echo 'value="' . $animal->getProprietaire() . '"'; endif; ?>/>
        <label for="add-animal-age">Age</label>
        <input type="number" id="add-animal-age" name="animal-age"
               min="0" <?php if (!empty($animal)): echo 'value="' . $animal->getAge() . '"'; endif; ?>/>
        <?php if (!empty($animal)): ?>
            <input type="hidden" name="animal-id" value="<?= $animal->getIdAnimal(); ?>">
        <?php endif; ?>
        <button class="btn waves-effect waves-light" type="submit" name="action"><?php if (!empty($animal)): echo 'Editer l\'animal'; else: echo 'Ajouter un animal'; endif; ?>
            <i class="material-icons right">add_box</i>
        </button>
    </form>
</div>

