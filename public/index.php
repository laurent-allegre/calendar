

                <?php

                    require '../src/boot.php';


                        $pdo = get_pdo();
                        $events = new \Calendar\Events($pdo);
                        $month = new Calendar\Month($_GET['month'] ?? null , $_GET['year'] ?? null);

                        $start = $month->getStartingDay();
                        $start = $start->format('N') === '1' ? $start : $month->getStartingDay()->modify('last monday');
                        $weeks = $month->getWeeks();
                        $end =(clone $start)->modify('+' . (6 + 7 * ($weeks -1)) . 'days');

                        $events = $events->getEventsBetweenByDay($start, $end);
    //var_dump($events);
                    require '../views/header.php';
                ?>
               <div class="calendar">

                   <div class="d-flex flex-row align-items-center justify-content-between mx-sm-3" >
                       <h1><?= $month->toString(); ?></h1>
                       <?php if (isset($_GET['succes'])): ?>
                           <div class="container">
                               <div class="alert alert-success">L'évènement à bien été ajouté</div>
                           </div>
                       <?php endif ; ?>
                       <div>
                           <a href="index.php?month=<?= $month->previousMonth()->month ; ?>&year=<?= $month->previousMonth()->year; ?>" class="btn btn-primary">&lt;</a>
                           <a href="index.php?month=<?= $month->nextMonth()->month ; ?>&year=<?= $month->nextMonth()->year; ?>" class="btn btn-primary">&gt;</a>
                       </div>
                   </div>




                   <table class="calendar__table calendar__table--<?= $weeks; ?> weeks">
                       <?php for ($i = 0; $i < $weeks; $i++): ?>
                           <tr>
                               <?php foreach ($month->days as $k => $day):

                                   $date = (clone $start)->modify("+" . ($k + $i * 7) . "days");
                                   $eventsForDay = $events[$date->format('Y-m-d')] ?? [];
                                   
                                   ?>

                                   <td class="<?= $month->whithinMonth($date) ? '' : 'calendar__otherMonth' ; ?>">
                                       <?php if ($i === 0): ?>
                                           <div class="calendar__weekday"> <?= $day; ?> </div>
                                       <?php endif ; ?>
                                       <a class="calendar__day" href="add.php?date=<?= $date->format('Y-m-d'); ?> "> <?= $date->format('d'); ?> </a>
                                       <?php foreach ($eventsForDay as $event): ?>
                                           <div class="calendar__event">
                                               <?=(new DateTime($event['start']))->format('H:i')  ?> - <a href="edit.php?id=<?= $event['id']; ?>"> <?= h($event['name']); ?></a>
                                           </div>
                                       <?php endforeach; ?>
                                   </td>
                               <?php endforeach; ?>
                           </tr>
                       <?php endfor ; ?>
                   </table>

                   <a href="add.php" class="calendar__button">+</a>
               </div>




            <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

            <?php require '../views/footer.php'; ?>