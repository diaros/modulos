<?php

class configFile {

    var $config;

    public function __construct() {

        $this->config = Array();
        
        //Conexion Unoe
        $this->config['unoE']['host'] = "";
        $this->config['unoE']['port'] = "";
        $this->config['unoE']['dbname'] = "";
        $this->config['unoE']['user'] = "";
        $this->config['unoE']['password'] = "";
        
        //Conexion Biplus
        $this->config['biplus']['host'] = "";
        $this->config['biplus']['port'] = "";
        $this->config['biplus']['dbname'] = "";
        $this->config['biplus']['user'] = "";
        $this->config['biplus']['password'] = "";
        
        //Conexion BiplusPruebas
        //$this->config['biplus']['host'] = "";
        //$this->config['biplus']['port'] = "";
        //$this->config['biplus']['dbname'] = "";
//        $this->config['biplus']['user'] = "";
//        $this->config['biplus']['password'] = "";
        
        //Conexion kactus
        $this->config['kactus']['host'] = "";
        $this->config['kactus']['port'] = "";
        $this->config['kactus']['dbname'] = "";
        $this->config['kactus']['user'] = "";
        $this->config['kactus']['password'] = "";
        
        //Conexion Aut
        $this->config['aut']['host'] = "";
        $this->config['aut']['port'] = "";
        $this->config['aut']['dbname'] = "";
        $this->config['aut']['user'] = "";
        $this->config['aut']['password'] = "";
    }

    public function getConfig(){

        return $this->config;
    }

}
?>

