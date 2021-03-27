<?php

        namespace Calendar;



        class Events {

            private $pdo;

            public function __construct(\PDO $pdo) {
                $this->pdo = $pdo;
        }
            /**
             * RECUPERE LES EVENEMENTS COMMENCANT ENTRE 2 DATES
             * @param \DateTime $start
             * @param \Datetime $end
             * @return array
             */
            public function getEventsBetween (\DateTime $start, \Datetime $end): array {

                 $sql = "SELECT * FROM events WHERE start BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND '{$end->format('Y-m-d 23:59:59' )}' ORDER BY start ASC ";

                 $statement = $this->pdo->query($sql);
                 $results = $statement->fetchAll();
                 return $results;
            }

            /**
             * RECUPERE LES EVENEMENTS COMMENCANT ENTRE 2 DATES INDEXE PAR JOUR
             * @param \DateTime $start
             * @param \Datetime $end
             * @return array
             */
            public function getEventsBetweenByDay (\DateTime $start, \Datetime $end): array {
                $events = $this->getEventsBetween($start, $end);
                $days = [];
                foreach ($events as $event) {
                    $date = explode( ' ', $event['start'])[0];
                    if (!isset($days[$date])) {
                        $days[$date] = [$event];
                    } else {
                        $days[$date] [] = $event;
                    }

                }
                return $days;

            }

            /**
             * RECUPERE UN EVENEMENTS
             * @param int $id
             */
            public function find (int $id): Event {
                require '../src/Calendar/Event.php';
                $statement = $this->pdo->query("SELECT * FROM events WHERE id = $id LIMIT 1");
                $statement->setFetchMode(\PDO::FETCH_CLASS, Event::class);
                $result = $statement->fetch();
                if ($result === false) {
                    throw new \Exception("Aucun résultat n'a été trouvé ");
                }
                return $result;
            }

            public function hydrate (Event $event, array $data) {
                $event->setName($data['name']);
                $event->setDescription($data['description']);
                $event->setStart(\DateTime::createFromFormat('Y-m-d H:i', $data['date'] . ' ' . $data['start'])->format('Y-m-d H:i:s'));
                $event->setEnd(\DateTime::createFromFormat('Y-m-d H:i', $data['date'] . ' ' . $data['end'])->format('Y-m-d H:i:s'));
                return $event;

            }

            /**
             * CREER UN EVENEMENT AU NIVEAU DE LA BASE DE DONNEE
             * @param Event $event
             * @return bool
             *
             */
            public function create (Event $event): bool {
                $statement = $this->pdo->prepare('INSERT INTO events (name, description, start, end) VALUE (?, ?, ?, ?)');
                return $statement->execute([
                    $event->getName(),
                    $event->getDescription(),
                    $event->getStart()->format('Y-m-d H:i:s'),
                    $event->getEnd()->format('Y-m-d H:i:s'),
                ]);
            }

            /**
             * MET A JOUR UN EVENEMENT AU NIVEAU DE LA BASE DE DONNEE
             * @param Event $event
             * @return bool
             */
            public function update(Event $event): bool {
                $statement = $this->pdo->prepare('UPDATE events SET name = ?, description = ?, start = ?, end= ? WHERE id = ?');
                return $statement->execute([
                    $event->getName(),
                    $event->getDescription(),
                    $event->getStart()->format('Y-m-d H:i:s'),
                    $event->getEnd()->format('Y-m-d H:i:s'),
                    $event->getId()
                ]);

            }

            /**
             * supprime un évènement
             * @param Event $event
             * @return bool
             */
            public function delete (Event $event): bool {
                $statement = $this->pdo->prepare('DELETE FROM events  WHERE id = ?');
                return $statement->execute([
                    $event->getId()
                ]);

            }







        }

?>