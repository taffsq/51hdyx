<?php
    include '../php/class/admin/Dao.php';
    use php\admin;
    
    $actid = isset($_REQUEST['actid']) ? $_REQUEST['actid'] : NULL;
    $adverid = isset($_REQUEST["adverid"]) ? $_REQUEST["adverid"]: NULL;
    $dao = new admin\Dao();
    
    echo 'foodEditRequest:';
    print_r($_REQUEST);
    echo '<br>';
    
    if( isset($adverid) ){
        if( $dao->deleteAdver($adverid)>0 ){
            echo '成功';
            header( 'location:actEdit.php?actid='.$actid );
        }else echo '失败';
    }
    
?>