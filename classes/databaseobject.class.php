<?php

    class DatabaseObject {

        protected function properties() {

            $properties = array();
            foreach (static::$dbFields  as $dbField) {
                if(property_exists($this, $dbField)) {
                    $properties[$dbField] = $this->$dbField;
                }   
            }
            return $properties;
        }

        public function save() {
            if(!$this->id) {
                $this->create();
            } else {
                $this->updateRow();
            }
        }

        public function create() {
            try 
            {
                $properties = $this->properties();
                $database = Database::instance();
                $connection = $database->connect();
                $placeholders = implode(',:', array_keys($properties));
                $placeholders = ':' . $placeholders;
                $sql = "INSERT INTO " . static:: $dbTable . " (" . implode(', ', array_keys($properties)) . ") VALUES (" . $placeholders . ")";
                $stmt = $connection->prepare($sql);
                $stmt->execute($properties);
                $this->id = $connection->lastInsertId();
                return;
            } 
            catch (PDOException $e)
            {
                Message::addError('error', $e->getMessage());
            }
            
        }

        
        public function updateRow() {
            try 
            {
                $properties = $this->properties();
                // remove last element from array, foreign key
                array_pop($properties);
                $database = Database::instance();
                $connection = $database->connect();
                $placeholders = str_repeat('?, ', count($properties) - 1) . '?';
                
                $properties_pairs = array();
                foreach ($properties as $key => $value) {
                    $properties_pairs[] = "{$key}=:{$key}";
                }

                $sql = "UPDATE " . static:: $dbTable . " SET " . implode(',', $properties_pairs) . " WHERE id=:id";
                $stmt = $connection->prepare($sql);
                $properties['id'] = $this->id;
                $stmt->execute($properties);
                return;
            }
            catch (PDOException $e)
            {
                Message::addError('error', $e->getMessage());
            }
        }

        public static function findById( $sql, $id) {
            try 
            {
                $database = Database::instance();
                $connection = $database->connect();

                $stmt = $connection->prepare($sql);
                $stmt->bindParam('1', $id);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            }
            catch(PDOException $e) 
            {
                Message::addError('error', $e->getMessage());
            }
        }

        public static function findAllByQuery($sql,  $id) {
            try 
            {
                $database = Database::instance();
                $connection = $database->connect();
                $stmt = $connection->prepare($sql);
                $stmt->bindParam('1', $id);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } 
            catch(PDOException $e) 
            {
                Message::addError( 'error', $e->getMessage());
            }

        }
        public function delete() {
            try 
            {
                $database = Database::instance();
                $connection = $database->connect();
                $sql = "DELETE FROM " . static::$dbTable . " WHERE id = ?";
                $stmt = $connection->prepare($sql);
                $stmt->bindParam('1', $this->id);
                $stmt->execute();
                return;
            } 
            catch(PDOException $e) 
            {
                Message::addError( 'error', $e->getMessage());
            }
        }
        public function getId() {
            return $this->id;
        }

    } //end of class