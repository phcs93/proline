<?php

// timezone
date_default_timezone_set('America/Sao_Paulo');

// data e hora atual
function datetime() {
    return date('d/m/Y H:i:s', time());
}

// data atual
function data() {
    return date('d/m/Y', time());
}

// hora atual
function hora() {
    return date('H:i:s', time());
}

// en-US date sem time
function enusDate($val) {
    return date('Y-m-d', strtotime($val));
}

// converte float em R$
function toBRL($val) {
    return 'R$ ' . number_format($val, 2, ',', '.');
}

// converte float em quilos
function toKG($val) {
    return number_format($val, 3, ',', '.') . ' Kg';
}

// converte float em metros
function toMT($val) {
    return number_format($val, 3, ',', '.') . ' m';
}

// converte float em metros
function toPC($val) {
    return number_format($val, 0, ',', '.') . ' Pç';
}

// converte int em polegadas
function toPOL($val) {
    return ($val != "") ? "$val" . '"' : "";
}

// converte data americana em brasileira (sem horas)
function toDMY($val) {
    return date('d/m/Y', strtotime($val));
}

// remove um indice de um array e retorna seu valor
function array_remove(&$array, $index) {
    $val = $array[$index];
    unset($array[$index]);
    return $val;
}

// converte camelCase e CapitalCase para under_score // talvez nunca seja usado
function toUnderscore($string) {
    return strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $string));
}

// orderna o array de objetos com base no __toString da classe
function orderObjs($objs) {
    usort($objs, function($a, $b) {
        return strcmp($a, $b);
    });
    return $objs;
}

// decodificar arrays contidos em valores json
function parseRequest(&$request){
    foreach($request as $key => $val) {
        if (is_array(json_decode($val))){
            $request[$key] = json_decode($val, true);
        }
    }
}

// pega os ids dos produtos em falta no estoque
function notifyEstoque(){
    $notifications = array();
    $produtos = Produto::findAll();
    foreach($produtos as $produto){
        if ($produto->getStEstoque() == 'FT'){
            $notifications[] = $produto->getIdProduto();
        }
    }
    return $notifications;
}