
<div class="container">
    <?php include('message.php')?>
    <h1 class="h1">Ajouter un animal</h1>
    <form action="index.php?action=add-animal" method="post">
        <label for="add-animal-name">Nom</label>
        <input type="text" id="add-animal-name" name="animal-nom" placeholder="Nom"/>
        <label for="add-animal-espece">Espèce</label>
        <input type="text" id="add-animal-espece" name="animal-espece" placeholder="Espèce"/>
        <label for="add-animal-cri">Cri</label>
        <input type="text" id="add-animal-cri" name="animal-cri" placeholder="Cri"/>
        <label for="add-animal-proprietaire">Propriétaire</label>
        <input type="text" id="add-animal-proprietaire" name="animal-proprietaire" placeholder="Propriétaire"/>
        <label for="add-animal-age">Age</label>
        <input type="number" id="add-animal-age" name="animal-age" min="0"/>
        <button class="btn waves-effect waves-light" type="submit" name="action">Ajouter un animal
            <i class="material-icons right">add_box</i>
        </button>
    </form>
</div>

