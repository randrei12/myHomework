<?php
    $dbConfig = new stdClass();
    $dbConfig->intrebari = ['id', 'title', 'description', 'user', 'materie', 'likes', 'time'];
    $dbConfig->conturi = ['email', 'name', 'password', 'image', 'tokenID', 'desc', 'time'];

    function convert_obj($array, $values) {
        $obj = new stdClass();
        for($i = 0; $i < count($values); $i++) {
            $property = $values[$i];
            $value = $array[$i];
            $obj->{$property} = $value;
        }
        return $obj;
    }
?>