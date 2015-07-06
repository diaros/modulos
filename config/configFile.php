<?php

class configFile {

    var $config;

    public function __construct() {

        $this->config = Array();
        
        //Conexion Unoe
        $this->config['unoE']['host'] = "192.168.0.5";
        $this->config['unoE']['port'] = "1433";
        $this->config['unoE']['dbname'] = "UNOEE_Maestros";
        $this->config['unoE']['user'] = "sa";
        $this->config['unoE']['password'] = "Grup0List0s";
        
        //Conexion Biplus
        $this->config['biplus']['host'] = "servclo09";
        $this->config['biplus']['port'] = "1433";
        $this->config['biplus']['dbname'] = "biplus";
        $this->config['biplus']['user'] = "consultas";
        $this->config['biplus']['password'] = "cali2015";
        
        //Conexion BiplusPruebas
        //$this->config['biplus']['host'] = "servclo03";
        //$this->config['biplus']['port'] = "1433";
        //$this->config['biplus']['dbname'] = "bipluspruebas";
//        $this->config['biplus']['user'] = "sime";
//        $this->config['biplus']['password'] = "Grup0L1st0s+";
        
        //Conexion kactus
        $this->config['kactus']['host'] = "servclo09";
        $this->config['kactus']['port'] = "1433";
        $this->config['kactus']['dbname'] = "KACTUS";
        $this->config['kactus']['user'] = "consultas";
        $this->config['kactus']['password'] = "cali2015";
        
        //Conexion Aut
        $this->config['aut']['host'] = "servclo03";
        $this->config['aut']['port'] = "1433";
        $this->config['aut']['dbname'] = "SeguridadAUT";
        $this->config['aut']['user'] = "sime";
        $this->config['aut']['password'] = "Grup0L1st0s+";
    }

    public function getConfig(){

        return $this->config;
    }

}
?>

