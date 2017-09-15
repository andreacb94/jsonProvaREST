<?php
/**
 * Created by PhpStorm.
 * User: Andrea
 * Date: 14/09/17
 * Time: 12:54
 */

class APIURL
{

    //Qui devo mettere ogni volta l'indirizzo ip della macchina dove risiede il WEB Server dei servizi REST
    private $IP_MACHINE = "10.0.0.7";
    //Cartella dell'API REST
    private $API_DIRECTORY = "/API/public/";
    private $BASE_URL = "";


    /**
     * @return string
     */
    public function getBASEURL()
    {

        $this->BASE_URL = "http://".$this->IP_MACHINE.$this->API_DIRECTORY;
        return $this->BASE_URL;
    }

}