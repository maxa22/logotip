<?php

    class Sanitize {

        public static function sanitizeString($value) {
            $value = trim($value);
            $value = htmlspecialchars($value);
            return $value;
        }

    }

?>