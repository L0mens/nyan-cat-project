<h1>Bienvenue chez <?= $nomAnimalerie ?></h1>

<?php var_dump($listAnimals); ?>

<?php var_dump($first); ?>

<?php var_dump($other); ?>
<div class="container">
    <table class="striped centered">
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
                <td> <a href="#"><i class="material-icons">edit</i></a> <a href="#"><i class="material-icons">delete</i></td></a>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>