<?php

    namespace  Calendar;

 class Month {
     public  $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche' ];
     private $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Dècembre'];
     public $month;
     public $year;

     /**
      * Month constructor.
      * @param int $month Le mois compris entre 1 et 12
      * @param int $year l'année
      * @throws Exception
      */
     public function  __construct(?int $month = null, ?int $year = null) {

        if ($month === null || $month < 1 || $month > 12) {$month = intval(date('m')); }
        if ($year === null) {$year = intval(date('Y')); }
       // if ($month < 1 || $month > 12) {throw new \Exception("le mois $month n'est pas valide"); }
       // if ($year < 1970) {throw new \Exception("L'année est inférieure à 1970"); }

        $this->month = $month;
        $this->year = $year;
     }

     /**
      * Renvoie le 1er jour du mois
      * @return \DateTime
      */
     public function getStartingDay (): \DateTime {
         return new \DateTime("{$this->year}-{$this->month}-01");
     }


     /**
      * Retourne le mois en toute lettre (ex mars 2021)
      * @return string
      *
      */
     public function toString() : string {
        return $this->months[$this->month - 1] . ' ' . $this->year;
     }

     /**
      * Renvois le nombre de semaine dans le mois
      * @return int
      */
     public function  getWeeks() : int {
         $start = $this->getStartingDay();
         $end = (clone $start)->modify('+1 month -1 day');
         $weeks = intval($end->format('W')) - intval($start->format('W')) + 1;
         if($weeks < 0) {
             $weeks = intval($end->format('W'));
         }
         return $weeks;
     }

     /**
      * est ce que le jour est dans le mois en cours
      * @param \DateTime $date
      * @return bool
      */
     public function whithinMonth (\DateTime $date): bool {
        return $this->getStartingDay()->format('Y-m') === $date->format('Y-m');

     }

     /**
      * Renvoie au mois suivant
      * @return Month
      *
      */
     public function  nextMonth() : Month {
         $month = $this->month + 1 ;
         $year = $this->year;
         if ($month > 12) {
             $month = 1;
             $year += 1 ;
         }
         return new Month($month, $year);
     }

     /**
      * Renvoie au mois d'avant
      * @return Month
      *
      */
     public function  previousMonth() : Month {
         $month = $this->month - 1 ;
         $year = $this->year;
         if ($month < 1) {
             $month = 12 ;
             $year -= 1 ;
         }
         return new Month($month, $year);
     }
 }
