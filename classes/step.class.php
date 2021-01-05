<?php  
    
    class Step extends DatabaseObject {
        protected static $dbTable = 'step';
        protected static $dbFields = ['name', 'stepStatus', 'calculatorId'];
        protected $id;
        protected $stepStatus;
        public $name;
        public $calculatorId;
        
        public function __construct($args) {
            $this->id = $args['id'] ?? '';
            $this->name = $args['name'];
            $this->stepStatus = $args['stepStatus'] ?? '0';
            $this->calculatorId = $args['calculatorId'];
        }
    }
?>