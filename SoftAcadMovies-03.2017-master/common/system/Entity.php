<?php

abstract class Entity {

    public function init($row) {

        foreach ($row as $column => $value) {
            $methodName = str_replace('_', ' ', $column);
            $methodName = ucwords($methodName);
            $methodName = str_replace(' ', '', $methodName);
            $methodName = 'set'.$methodName;

            $this->$methodName($value);
        }
        return $this;
    }





}