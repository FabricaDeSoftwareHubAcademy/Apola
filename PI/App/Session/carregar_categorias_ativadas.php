<?php

require_once '../Entity/Categoria.class.php';

$objProd = new Categoria();

$dados = $objProd->buscarCategoria("status_categoria = 'a'");;
if($dados){
    echo json_encode($dados);
}
else{
    $array = ['status' => 400, 'msg' => 'Ocorreu algum erro!!'];
    echo json_encode($array);
}