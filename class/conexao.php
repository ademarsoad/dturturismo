<?php
/*try{
    $conn = new PDO('pgsql:host=localhost;port=5432;dbname=dturturismo', 'postgres','1234567');
    if($conn) {
    echo "database conectado";
    }
    }catch (PDOException $e){
    // report error message
    echo $e->getMessage();
    }
    */
            $conn = new PDO("mysql:host=localhost; dbname=dturturismo", "root", "");

            echo "Conexão bem sucessida";
       
        

?>