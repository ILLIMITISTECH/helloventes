
<?php

    /*
    ** Connnexion à la base de donnée 
    */ 
   
    
     $servname = "localhost"; $dbname = "xd48cukr_newversion"; $user = "xd48cukr_collab"; $pass = "xd48cukr_collab";
            
try{
    $dbco = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);
    $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
   
    $dataScoops = json_decode(file_get_contents('https://fallou.g@illimitis.com:12Sonatel@www.commcarehq.org/a/faso-coton/api/v0.5/odata/cases/1445088fcd04ccbe45c38a3de9a238b2/feed'),true);
    
    var_dump($dataScoops);
      
      

    echo "<br>Yes<br>";

            }
                  
            catch(PDOException $e){
                echo "Erreur : " . $e->getMessage();
            }
    
    t

?>