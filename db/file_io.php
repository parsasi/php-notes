<?php
    class FileIo{

        function open($filePath){
            $root=$_SERVER['DOCUMENT_ROOT'];
            var_dump($filePath);
            $filePath = $root . $filePath;
            $fileHandle =  fopen($filePath , 'r+');
            $fileContent = json_decode(fread($fileHandle,filesize($filePath)) , true);
            return $fileHandle != false ? $fileContent : die('Could not access the file');
        }

        function save($filePath , $value){
            $root=$_SERVER['DOCUMENT_ROOT'];
            $filePath = $root . $filePath;
            $newContent = $this->generateJSON($value);
            $fileHandle = fopen($filePath , 'w+');
            $result =  fwrite ($fileHandle, $newContent);
            fclose($fileHandle);
            return $result;
        }


       function generateJSON($array){
            return json_encode($array);
       }
    }