<?php

        namespace Calendar;

        class Event {

            private $id;
            private $name;
            private $description;
            private $start;
            private $end;

            /**
             * @return mixed
             */
            public function getId(): int
            {
                return $this->id;
            }

            /**
             * @return mixed
             */
            public function getName(): string
            {
                return $this->name;
            }

            /**
             * @return mixed
             */
            public function getDescription(): string
            {
                return $this->description ?? '';
            }

            /**
             * @return mixed
             */
            public function getStart(): \DateTime
            {
                return new \DateTime($this->start) ;
            }

            /**
             * @return mixed
             */
            public function getEnd(): \DateTime
            {
                return new \DateTime($this->end) ;
            }





        }