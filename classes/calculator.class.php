<?php
    
    class Calculator extends DatabaseObject {
        protected static $dbTable = 'calculator';
        protected static $dbFields = array('name', 'estimateText', 'heading', 'calculatorText', 'button', 'logo', 'backgroundColor', 'color', 'currency', 'archived', 'defaultCalculators', 'contactForm', 'includeContactForm', 'userId');
        protected $id;
        public $name;
        public $estimateText;
        public $heading;
        public $calculatorText;
        public $button;
        public $logo;
        public $backgroundColor;
        public $color;
        public $currency;
        public $archived;
        public $defaultCalculators;
        public $contactForm;
        public $includeContactForm;
        public $userId;

        public function __construct($args) {
            $this->id =                 $args['id'] ?? '';
            $this->name =               $args['name'];
            $this->estimateText =       $args['estimateText'];
            $this->heading =            $args['heading'];
            $this->calculatorText =     $args['calculatorText'];
            $this->button =             $args['button'];
            $this->logo =               $args['logo'];
            $this->backgroundColor =    $args['backgroundColor'];
            $this->color =              $args['color'];
            $this->currency =           $args['currency'];
            $this->archived =           $args['archived'] ?? '0';
            $this->defaultCalculators = $args['defaultCalculators'] ?? '0';
            $this->contactForm =        $args['contactForm'];
            $this->includeContactForm = $args['includeContactForm'];
            $this->userId =             $args['userId'];
            if($this->logo) {
                $image = new Image($this->logo);
                $this->logo = $image->getImage();
            }
        }

        public function setId($id) {
            $this->id = $id;
        }

    } //end of class
?>