

<div class="container">
    <?php include('message.php')?>
    <h1>Bienvenue chez <?= $nomAnimalerie ?></h1>
    <table class="striped centered responsive-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Espece</th>
            <th>Propriétaire</th>
            <th>Age</th>
            <th>Cri</th>
            <th>Options</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($listAnimals as $animal): ?>
            <tr>
                <td><?= $animal->getIdAnimal() ?></td>
                <td><?= $animal->getNom() ?></td>
                <td><?= $animal->getEspece() ?></td>
                <td><?= $animal->getProprietaire() ?></td>
                <td><?= $animal->getAge() ?></td>
                <td><?= $animal->getCri() ?></td>
                <td><a href="index.php?action=edit-animal&idAnimal=<?= $animal->getIdAnimal() ?>">
                        <i class="material-icons">edit</i></a>
                    <a href="index.php?action=del-animal&idAnimal=<?= $animal->getIdAnimal() ?>">
                        <i class="material-icons">delete</i></a>
                </td>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>