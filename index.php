<?php
/**
 * Created by PhpStorm.
 * User: Andrea
 * Date: 15/09/17
 * Time: 11:43
 */


    require "API_REST/APIURL.php";


    //Funzione per acquisire il json dal REST Slim con metodo http GET
    function getJson($page)
    {
        $baseUrl = (new APIURL())->getBASEURL();
        return file_get_contents($baseUrl . $page);
    }

    //Funzione per creare il campo POST in base alla pagina desiderata
    function chackPage($page, $idattore, $password, $tipo, $nome, $cognome){

        $arr = array();

        if($page == "accesso"){

            $arr = array(
                'idattore' => $idattore,
                'password' => $password
            );

        }
        else if($page == "insert") {

            $arr = array(
                'idattore' => $idattore,
                'tipo' => $tipo,
                'nome' => $nome,
                'cognome' => $cognome,
                'password' => $password
            );

        }
        else {

            $arr = array(
                'var1' => 'some content',
                'var2' => 'doh'
            );

        }

        return $arr;

    }

    //Funzione per acquisire il json dal REST Slim con metodo http POST
    function postJson($page, $idattore, $password, $tipo, $nome, $cognome)
    {

        $baseUrl = (new APIURL())->getBASEURL();
        $postData = http_build_query(chackPage($page, $idattore, $password, $tipo, $nome, $cognome));

        // Create a stream
        $opts = array(
                    'http'=>
                        array(
                            'method'=>"POST",
                            'header'=>"Content-type: application/x-www-form-urlencoded\r\nAccept-language: it\r\n",
                            'content'=>$postData
                        )
                );

        $context = stream_context_create($opts);

        // Open the file using the HTTP headers set above
        return file_get_contents($baseUrl . $page, false, $context);

    }


    //Funzione per acquisire il json dal REST Slim con metodo http DELETE
    function deleteJson($page, $idattore)
    {

        $baseUrl = (new APIURL())->getBASEURL();

        // Create a stream
        $opts = array(
            'http'=>
                array(
                    'method'=>"DELETE",
                    'header'=>"Content-type: application/x-www-form-urlencoded\r\nAccept-language: it\r\n",
                )
        );

        $context = stream_context_create($opts);

        // Open the file using the HTTP headers set above
        return file_get_contents($baseUrl . $page ."/".$idattore, false, $context);

    }
    //Test get REST
    $json = getJson("listaUtenti");
    //Test post REST
    $json = postJson("insert", "dba_id3", "Password1", "DBA", "PHP", "Script");
    //Test delete REST
    $json = deleteJson("delete", "dba_id2");

    $obj = json_decode($json);
    echo "var_dump('$'obj): ";
    ?><br><?php
    var_dump($obj);
    ?><br><br><?php

    //OR

    $arr = json_decode($json, true);
    echo "var_dump('$'arr['']):";
    ?><br><?php
    var_dump($arr);
    ?><br><br><?php


    //echo $obj->access_token;

?>
<!-- HTML5, ovviamente -->
<!DOCTYPE html>
<!-- Supporto ad IE 8 -->
<!--[if IE 8]><html class="no-js lt-ie9" lang="en" ><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" ><!--<![endif]-->
<html lang="it">

    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Bootstrap_Exemple</title>

        <!-- Gestione del responsive (vedi http://www.html.it/pag/33420/il-meta-tag-viewport/) -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- jQuery e plugin JavaScript  -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


    </head>

    <body>

        <h1>Ciao json!</h1>
        <p id="p_id">$json:<br><?php echo ($json);?><br><br></p>
        <p id="p_id">$obj:<br><?php echo ($obj);?><br><br></p>
        <p id="p_id">$arr:<br><?php echo ($arr);?><br><br></p>
    </body>

</html>