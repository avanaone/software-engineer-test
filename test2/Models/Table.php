<?php
namespace Test2\Models;

class Table{
    public static function getOpen(){
        return "<table class='table table-bordered'>";
    }

    public static function open(){
        echo static::getOpen();
    }

    public static function getClose(){
        return "</table>";
    }

    public static function close(){
        echo static::getClose();
    }

    public static function getRow($content){
        return "<tr>". $content . "</tr>";
    }

    public static function row($content){
        echo static::getRow($content);
    }

    public static function getColumn($content){
        return "<td>". $content . "</td>";
    }

    public static function column($content){
        echo static::getColumn($content);
    }

}
