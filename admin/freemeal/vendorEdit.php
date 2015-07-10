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
    <!-- act-edit-main -->
    <div class="info-table-main">
        <header class="info-header">商家编辑</header>
        <?php 
            include '../php/class/admin/Dao.php';
            use php\admin;
            
            //如果有数据就提交
            if( isset($_POST['vendor-name']) ){

                $dao = new admin\Dao();

                if( $dao->checkVendor( $_POST['vendor-name'] ) )
                    echo '已经存在';
                else if( $dao->insertVendor($_POST) ){
                   if( isset($_GET['actid']) ){                     
                       header("location:actEdit.php?actid=".$_GET["actid"]);
                   }else{
                       header("location:actives.php");
                   } 
                }
            }
        ?>
        <form action="vendorEdit.php<?php echo isset($_GET['actid'])? "?actid=".$_GET['actid']:""?>" method="post"  class="form-horizontal">

            <div class="form-group">
                <label for="vendor-name" class="col-sm-3 control-label">商家名称：</label>
                <div class="col-sm-3">
                    <input id="vendor-name" name="vendor-name" class="form-control" type="text" placeholder="商家名称"/>
                </div>
            </div>

            <div class="form-group">
                <label for="vendor-address" class="col-sm-3 control-label">商家地址：</label>
                <div class="col-sm-3">
                    <input id="vendor-address" name="vendor-address" class="form-control" type="text" placeholder="商家地址"/>
                </div>
            </div>

            <div class="form-group">
                <label for="contact-name" class="col-sm-3 control-label">联系人名称：</label>
                <div class="col-sm-3">
                    <input id="contact-name" name="contact-name" class="form-control" type="text" placeholder="联系人名称"/>
                </div>
            </div>

            <div class="form-group">
                <label for="contact-tel" class="col-sm-3 control-label">联系人电话：</label>
                <div class="col-sm-3">
                    <input id="contact-tel" name="contact-tel" class="form-control" type="tel" placeholder="联系人电话"/>
                </div>
            </div>

            <div class="form-group">
                <label for="img-url" class="col-sm-3 control-label">商家介绍图片链接：</label>
                <div class="col-sm-7">
                    <div class="input-group">
                        <span class="input-group-addon">http://</span>
                        <input id="img-url" name="img-url" class="form-control" type="text" placeholder="商家介绍图片链接"/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="gz-url" class="col-sm-3 control-label">关注链接：</label>
                <div class="col-sm-7">
                    <div class="input-group">
                        <span class="input-group-addon">http://</span>
                        <input name="gz-url" type="text" class="form-control" id="gz-url" placeholder="关注链接">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <div class="submit-btn-con col-sm-12">
                    <button class="btn btn-primary" type="submit">提交</button>
                    <button class="btn btn-primary" type="reset">取消</button>
                </div>
            </div>
        </form>

    </div>
</div>

<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/index.js"></script>
</body>
</html>