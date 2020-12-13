<?php
    function formataValorDecimal($variavel){
        $variavel_format = str_replace(",", "", $variavel);
        $variavel_format = str_replace(".", "", $variavel);
        $variavel_format_db = preg_replace("/^([0-9]+)*?([0-9]{2})$/", "$1.$2", $variavel_format);
        $variavel_format_db = str_replace(",", ".", $variavel_format);

        return $variavel_format_db;
    }
?>