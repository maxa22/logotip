<?php

    class CalculatorUser extends DatabaseObject {

        protected static $dbTable = 'calculatoruser';
        protected static $dbFields = ['userId', 'calculatorId', 'choosenOptions'];
        protected $id;
        public $userId;
        public $calculatorId;
        public $choosenOptions;

        public function __construct($args) {
            $this->id =               $args['id'] ?? '';
            $this->userId =           $args['userId'];
            $this->calculatorId =     $args['calculatorId'];
            $this->choosenOptions =   $args['choosenOptions'];
        }
    }