<?php

//include_once $_SERVER['DOCUMENT_ROOT'] . '/cda/TP/Mon TP/Correction Step 2/rest/Db.php';
include_once('Db.php');
switch ($_SERVER["REQUEST_METHOD"]) {
    case 'GET':
        //Je vérifie avec la fonction "validate_requests" le $_get que je récupère
        $_get = validate_request($_GET);
        //table obligatoire
        //Je crée la variable "$table" et vérifie si la "table" est récupéré
        //si oui alors on exécute le traitement et si "non" on break ici
        //et on renvoi false
        $table = isset($_get['table']) ? $_get['table'] : null;
        if($table == null){
            echo json_encode(false);        
        break;
    }
    // on crée une variable $id et on l'a vérifie.
    //Si elle est vérifier on continue le traitement si non
    //on renvoit false
    $id = isset($_get['id']) ? $_get['id'] : null;
    $where = isset($_get['where']) ? $_get['where'] : null;
    $orderby = isset($_get['orderby']) ? $_get['orderby'] : null;
    //echo json_encode($_get);
    echo Db::select($table, $id, $where, $orderby);

    case 'POST':
        $_post = validate_request($_POST);
        //table obligatoire
        $table = isset($_post['table']) ? $_post['table'] : null;
        if($table == null){
            echo json_encode(false);
        
            break;
        }
            $fields = isset($_post['fields']) ? $_post['fields'] : null;
            //echo json_encode($_post); 
            echo Db::insert($table, $fields);               
            break;    

    
    case 'PUT':
        //On decode les données chaine de caractere reçus pour 
        //les traiter en php
        $_put = json_decode(file_get_contents('php://input'), true);
        $_put = validate_request($_put);
        $table = isset($_put['table']) ? $_put['table'] : null;
        $id = isset($_put['id']) ? $_put['id'] : null;
        //obligatoires
        if($table == null || $id == null){
            echo json_encode(false);
            break;
        }
        $fields = isset($_put['fields']) ? $_put['fields'] : null;
        //echo json_encode($_put);
        echo json_encode(Db::update($table, $id, $fields));
        break;
    case 'DELETE':
        //On decode les données chaine de caractere reçus pour 
        //les traiter en php 
        $_del = json_decode(file_get_contents('php://input'), true);
        $_del = validate_request($_del);
        $table = isset($_del['table']) ? $_del['table'] : null;
        $id = isset($_del['id']) ? $_del['id'] : null;
        //obligatoires
        if($table == null || $id == null){
            echo json_encode(false);
            break;
        }
        //On ré-encode les données en chaine de caractère pour les renvoyer
        //echo json_encode($_del);
        echo Db::delete($table, $id);
        break;
}

function validate_request($request)
{
    foreach ($request as $k => $v) {
        if(is_array($v)){
            validate_request($v);
        }
        else{
            $request[$k] = htmlspecialchars(strip_tags(stripslashes(trim($v))));
        }
    }
    return $request;
}


