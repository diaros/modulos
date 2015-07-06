<?php

include_once __DIR__.'/../config/configFile.php';

class conexion {
    
    var $conexionBiplus;
    var $conexionUnoe;
    var $conexionKactus;
    var $conexionAUT;
    
    function __construct() {
        
        $configFile = new configFile();
        $config = $configFile->getConfig();       
                      
        $this->conexionBiplus = odbc_connect("DRIVER={SQL Server};SERVER=".$config['biplus']['host'].";UID=".$config['biplus']['user'].";PWD=".$config['biplus']['password'].";DATABASE=".$config['biplus']['dbname'].";", $config['biplus']['user'], $config['biplus']['password']);
                
        $this->conexionUnoe = odbc_connect("DRIVER={SQL Server};SERVER=".$config['unoE']['host'].";UID=".$config['unoE']['user'].";PWD=".$config['unoE']['password'].";DATABASE=".$config['unoE']['dbname'].";",$config['unoE']['user'] , $config['unoE']['password']);
        
        $this->conexionKactus = odbc_connect("DRIVER={SQL Server};SERVER=".$config['kactus']['host'].";UID=".$config['kactus']['user'].";PWD=".$config['kactus']['password'].";DATABASE=".$config['kactus']['dbname'].";", $config['kactus']['user'] , $config['kactus']['password']);
        
        $this->conexionAUT = odbc_connect("DRIVER={SQL Server};SERVER=".$config['aut']['host'].";UID=".$config['aut']['user'].";PWD=".$config['aut']['password'].";DATABASE=".$config['aut']['dbname'].";",$config['aut']['user'],$config['aut']['password']);
               
    }

    public function consultarAUT($sql) {

        $this->conexionAut;
        $resulQuery = odbc_exec($this->conexionAUT, $sql);
        $i = 0;
        //$arrayQuery = odbc_result_all($resulQuery);

        while ($row = odbc_fetch_array($resulQuery)) {

            $arregloResultado[$i] = $row;
            $i++;
        }
        
        
        return $arregloResultado;
    }

    public function consultarKactus($sql) {

        $this->conexionKactus;
        $resulQuery = odbc_exec($this->conexionKactus, $sql);
        $i = 0;
        //$arrayQuery = odbc_result_all($resulQuery);

        while ($row = odbc_fetch_array($resulQuery)) {

            $arregloResultado[$i] = $row;
            $i++;
        }
        
        $this->cerrarConexionKactus();        
        return $arregloResultado;
    }

    public function consultar($sql){

        $this->conexionBiplus;      
        
        $resulQuery = odbc_exec($this->conexionBiplus, $sql);
        $i = 0;

        while ($row = odbc_fetch_array($resulQuery)){

            $arregloResultado[$i] = $row;
            $i++;
        }

        if ($resulQuery === null) {

            return null;
            
        } else if ($resulQuery === false) {
            
            $this->cerrarConexionBiplus();
            return false;
            
        } else {

            $this->cerrarConexionBiplus();
            return $arregloResultado;
        }
    }
    
    public function consultarUnoE($sql){
        
        $this->conexionUnoe;        
        $resulQuery = odbc_exec($this->conexionUnoe, $sql);
        
        $i = 0;
        //$arrayQuery = odbc_result_all($resulQuery);

        while ($row = odbc_fetch_array($resulQuery)) {

            $arregloResultado[$i] = $row;
            $i++;
        }
        
        $this->cerrarConexionUnoE();
        return $arregloResultado;        
        
    }

    public function insertar($sql) {

        $this->conexionBiplus;
        $resulInsert = odbc_exec($this->conexionBiplus, $sql);
//        $this->cerrarConexionBiplus();
        return $resulInsert;
    }
   
    public function cerrarConexionBiplus() {
       
        odbc_close($this->conexionBiplus);
        
    }
    
    public function cerrarConexionKactus() {
       
        odbc_close($this->conexionKactus);
        
    }
    
    public function cerrarConexionUnoE() {
       
        odbc_close($this->conexionUnoe);
        
    }

}
