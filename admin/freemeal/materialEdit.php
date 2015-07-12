<!DOCTYPE html>
<html>
<head lang="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>微联众-互动营销系统后台管理</title>

    <link rel="shortcut icon" href="../favicon.ico" />
    <link rel="stylesheet" href="css/index.css"/>
</head>
<body>
<div class="act-edit info-table">
    <div class="act-edit-main info-table-main">
        <header class="info-header">材料编辑</header>
        <?php 
            include '../php/class/admin/Dao.php';
            use php\admin;

            $actid = isset($_REQUEST['actid']) ? $_REQUEST['actid'] : NULL;
            $dao = new admin\Dao();
            $foodid = isset($_REQUEST['foodid']) ? $_REQUEST['foodid'] : NULL;
            
            echo 'foodEditRequest:';
            print_r($_REQUEST);
            echo '<br>';
            //有数据
            if( isset($_POST['name']) ){
                //有ID则为更新选项，否则就创建
                echo $dao->insertMaterial( $_POST );
                
                
                 if( isset($foodid) )
                     header( "location:foodEdit.php?actid=".$actid.'&foodid='.$foodid ); 
            }
            
        ?>
        
        <form action="materialEdit.php" method="post"  class="form-horizontal">
            <input type="hidden" name="actid" value="<?php echo $actid?>"/>
            <input type="hidden" name="foodid" value="<?php echo $foodid?>"/>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">材料名称：</label>
                <div class="col-sm-3">
                    <input id="name" name="name" class="form-control" type="text" placeholder="材料名称"/>
                </div>
            </div>
            
            <div class="form-group">
                <label for="img-url" class="col-sm-2 control-label">材料图片地址：</label>
                <div class="col-sm-7">
                    <div class="input-group">
                        <span class="input-group-addon">http://</span>
                        <input id="img-url" name="img-url" class="form-control" type="text" placeholder="材料图片地址"/>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <div class="submit-btn-con col-sm-12">
                    <!-- <button class="btn btn-primary">返回食物编辑</button>
                    <button class="btn btn-primary">继续添加</button> -->
                    <button class="btn btn-primary" type="submit">提交</button>
                    <button class="btn btn-primary" type="reset">取消</button>
                </div>
            </div>
            
        </form>
        
   </div>
</div>
    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>