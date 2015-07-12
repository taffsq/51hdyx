<?php
    include '../php/class/admin/Dao.php';
    use php\admin;
    
    $actid = isset($_REQUEST['actid']) ? $_REQUEST['actid'] : NULL;
    $foodid = isset($_REQUEST["foodid"]) ? $_REQUEST["foodid"]: NULL;
    $dao = new admin\Dao();
    
    echo 'RemoveRequest:';
    print_r($_REQUEST);
    echo '<br>';
    
    if( isset($foodid,$actid) ){
    	$dao->deleteFoodMats($foodid);
    	$dao->deleteFood($foodid);
        if( $dao->deleteActFood($actid,$foodid)>0 ){
            echo '成功';
            header( 'location:actEdit.php?actid='.$actid );
        }else echo '失败';
    }
    
?>