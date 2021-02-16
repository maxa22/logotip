<?php

    class CalculatorUser extends DatabaseObject {

        protected static $dbTable = 'calculatoruser';
        protected static $dbFields = ['userId', 'userName', 'form', 'email', 'text', 'choosenOptions', 'calculatorId'];
        protected $id;
        public $userId;
        public $userName;
        public $form;
        public $email;
        public $text;
        public $calculatorId;
        public $choosenOptions;

        public function __construct($args) {
            $this->id =               $args['id'] ?? '';
            $this->userId =           $args['userId'];
            $this->userName =         $args['userName'] ?? NULL;
            $this->form =             $args['form'] ?? '0';
            $this->email =            $args['email'] ?? '';
            $this->text =             $args['text'] ?? '';
            $this->calculatorId =     $args['calculatorId'];
            $this->choosenOptions =   $args['choosenOptions'];
        }
    }