<?php
/**
 * Created by PhpStorm.
 * User: Andrea
 * Date: 15/09/17
 * Time: 11:43
 */


    require "API_REST/APIURL.php";


    function getJson($page)
    {
        $baseUrl = (new APIURL())->getBASEURL();
        return file_get_contents($baseUrl . $page);
    }

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

    //$json = getJson("listaUtenti");
    //$json = postJson("insert", "dba_id3", "Password1", "DBA", "PHP", "Script");
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

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" href="css/stili-custom.css" media="screen"> <!-- Stile personalizzato che sovrascrive quello di bootstrap -->
        <!-- Modernizr: HTML5 per IE -->
        <!--script src="../js/modernizr.custom.js"></script-->
        <!-- respond.js per IE8 -->
        <!--[if lt IE 9]>
        <script src="js/respond.min.js"></script>
        <![endif]-->

        <!-- Script da caricare, meglio qui così la grafica appare prima all'utente -->
        <!-- jQuery e plugin JavaScript  -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


    </head>

    <body>

        <h1>Ciao json!</h1>
        <p id="p_id">$json:<br><?php echo ($json);?><br><br></p>
        <p id="p_id">$obj:<br><?php echo ($obj);?><br><br></p>
        <p id="p_id">$arr:<br><?php echo ($arr);?><br><br></p>
    </body>

</html>