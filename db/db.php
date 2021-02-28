<?php
    require_once("file_io.php");

    class Database {
        private $io;
        public $tables = Array();

        function __construct($schemas){
            $this->io = new FileIo();
            $this->tables = array_merge($this->tables , $schemas);
        }

        private function getPath($tableName){
            return $this->tables[$tableName]["path"];
        }

        private function save($tableName , $values){
            return $this->io->save($this->getPath($tableName) , $values);
        }

        public function getTable($tableName){
            return $this->io->open($this->getPath($tableName));
        }

        public function searchTable($tableName , $searchBy , $value){
            $allValues = $this->getTable($tableName);
            $valuesToReturn = array_filter($allValues , function ($item) use ($searchBy , $value){
                return strtolower($item[$searchBy]) == strtolower($value);
            });
            return $valuesToReturn;
        }

        public function createRow($tableName , $value){
            $allValues = $this->getTable($tableName);
            array_push($allValues , $value);
            $this->save($tableName , $allValues);
        }

        public function editRow($tableName , $searchBy , $searchFor , $value){
            $allValues = $this->getTable($tableName);
            foreach($allValues as $key => &$currentValue){
                if(strtolower($currentValue[$searchBy]) == strtolower($searchFor)){
                    $currentValue = $value;
                    break;
                }
            }
            $this->save($tableName , $allValues);
        }
    }