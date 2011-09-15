<?php

function isVocal($letter){
    if(in_array(strtolower($letter), array("a", "i", "u", "e", "o"))){
        return true;
    } else {
        return false;
    }
}

function isAlpha($letter){
    if(preg_match("/[a-zA-Z]/", $letter)){
        return true;
    } else {
        return false;
    }
}

class Stack {
    
    var $data = "";
    
    public function push($letter){
        $this->data .= $letter;
    }
    
    public function pop(){
        if(strlen($this->data) > 0){
            $temp = $this->data;
            $this->data = substr($this->data, 0, -1);
            return $temp[strlen($temp) - 1];
        } else {
            return "";
        }
    }
    
    public function top(){
        if(strlen($this->data) > 0){
            $temp = $this->data;
            return $temp[strlen($temp) - 1];
        } else {
            return "";
        } 
    }
    
    public function show(){
        echo $this->data;
    }
    
    public function popAll(){
        $temp = $this->data;
        $this->data = "";
        return $temp;
    }
}

//ha  na ca ra ka  da ta sa  wa la
//pa dha ja ya nya ma ga ba tha nga

function convert($text){
    $dict = array(
        "h" => "p",
        "n" => "dh",
        "c" => "j",
        "r" => "y",
        "k" => "ny",
        "d" => "m",
        "t" => "g",
        "s" => "b",
        "w" => "th",
        "l" => "ng",
        "p" => "h",
        "dh" => "n",
        "j" => "c",
        "y" => "r",
        "ny" => "k",
        "m" => "d",
        "g" => "t",
        "b" => "s",
        "th" => "w",
        "ng" => "l"
    );
    if(in_array(strtolower($text), $dict)){
        return $dict[strtolower($text)];
    } else {
        return $text;
    }
}

$string = $_GET["text"];

$stack = new Stack();

$result = "";

$items = str_split($string);
foreach($items as $item){
    if(isAlpha($item)){
        if(isVocal($item)){
            $result .= convert($stack->popAll()) . $item;
        } else {
            $result .= $stack->push($item);
        }
    } else {
        $result .= convert($stack->popAll()) . $item;
    }
}

$result .= convert($stack->popAll());


echo $result;


