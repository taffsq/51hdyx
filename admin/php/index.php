<?php
    include 'class/admin/dao/DB.php';
    use php\admin\dao;

    $db = new dao\DB();
    $con = $db->getDb();
    
    print_r($db);
?>