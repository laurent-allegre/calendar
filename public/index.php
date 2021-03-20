<!doctype html>
    <html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="css/calendar.css">

        <title>Calendar</title>
    </head>
    <body>


                <nav class="navbar navbar-dark bg-primary mb-3">
                    <a href="/index.php" class="navbar-brand">Mon calendrier</a>
                </nav>

                <?php
                    require '../src/Date/Month.php';


                        $month = new App\Date\Month($_GET['month'] ?? null , $_GET['year'] ?? null);

                        $start = $month->getStartingDay();
                        $start = $start->format('N') === '1' ? $start : $month->getStartingDay()->modify('last monday');


                ?>
                <div class="d-flex flex-row align-items-center justify-content-between mx-sm-3" >
                    <h1><?= $month->toString(); ?></h1>
                    <div>
                        <a href="index.php?month=<?= $month->previousMonth()->month ; ?>&year=<?= $month->previousMonth()->year; ?>" class="btn btn-primary">&lt;</a>
                        <a href="index.php?month=<?= $month->nextMonth()->month ; ?>&year=<?= $month->nextMonth()->year; ?>" class="btn btn-primary">&gt;</a>
                    </div>
                </div>




                <table class="calendar__table calendar__table--<?= $month->getWeeks(); ?> weeks">
                    <?php for ($i = 0; $i < $month->getWeeks(); $i++): ?>
                    <tr>
                        <?php foreach ($month->days as $k => $day):

                            $date = (clone $start)->modify("+" . ($k + $i * 7) . "days");
                        ?>

                        <td class="<?= $month->whithinMonth($date) ? '' : 'calendar__otherMonth' ; ?>">
                            <?php if ($i === 0): ?>
                            <div class="calendar__weekday"> <?= $day; ?> </div>
                            <?php endif ; ?>
                            <div class="calendar__day"> <?= $date->format('d'); ?> </div>
                        </td>
                        <?php endforeach; ?>
                    </tr>
                    <?php endfor ; ?>
                </table>



            <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>


    </body>
</html>