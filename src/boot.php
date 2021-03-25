<?php

        require  '../vendor/autoload.php';


        function e404() {
            require '../public/404.php';
            exit();
        }


        function dd(...$vars) {
            foreach ($vars as $var) {
                echo '<pre>';
                    print_r($var);
                echo '</pre>';
            }
        }

        /**
         * Connection à la base de donnée
         * @return PDO
         *
         */
        function get_pdo(): PDO {
            return new PDO('mysql:host=localhost;dbname=calendar', 'root', '', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        }

        /**
         * Empeche l'injection de requete js
         * @param string $value
         * @return string
         */
        function h (?string $value): string {
            if ($value === null) {
                return '';
            }
            return htmlentities($value);
        }

        function render(string  $view, $parameters = []) {
            extract($parameters);
            include "../views/{$view}.php";
        }