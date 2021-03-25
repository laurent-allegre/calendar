<?php

        require '../src/boot.php';

        require '../src/Calendar/Events.php';



        $pdo = get_pdo();
        $events = new \Calendar\Events($pdo);

        if (!isset($_GET['id'])) {
            header('location: 404.php');
        }

        try {
            $event = $events->find($_GET['id']);
        } catch (\Exception $e) {
            e404();

        }



        render('header', ['title' => $event->getName()]);
?>

    <h1><?= h($event->getName()); ?></h1>

    <ul>
        <li>
            date: <?= $event->getStart()->format('d/m/Y'); ?>
        </li>
        <li>
            Heure de démarrage : <?= $event->getStart()->format('H:i'); ?>
        </li>
        <li>
            Heure de fin: <?= $event->getEnd()->format('h:i'); ?>
        </li>
        <li>
            Description:<br> <?= h($event->getDescription()); ?>
        </li>
    </ul>













<?php require '../views/footer.php'; ?>