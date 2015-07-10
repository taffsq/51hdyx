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
        <header class="info-header">广告编辑</header>
        <?php 
            include '../php/class/admin/Dao.php';
            use php\admin;
            
            $actid = isset($_REQUEST['actid']) ? $_REQUEST['actid'] : NULL;
            $adverid=isset($_REQUEST["adverid"])?$_REQUEST["adverid"]:NULL;
            $dao = new admin\Dao();
            
            echo 'pa:';
            print_r($_REQUEST);
            
            //如果有id就更新，否则更新数据选项
            if( isset($_POST['name'],$actid) ){           
                //检测是否存在
                if( $dao->checkAdver( $_POST['name'] ) ){
                   //存在就更新数据
                   if( $dao->updateAdver($_REQUEST) )
                        header("location:actEdit.php?actid=".$actid);
                   else echo '没有更改！';
                //否则 就插入数据
                }else if( $dao->insertAdver($_POST) ){
                    echo "成功";
                   if( isset( $actid ) ){
                       header("location:actEdit.php?actid=".$actid);
                   }else{
                       header("location:actives.php");
                   } 
                }
            }
            
            $adver = NULL;
            if( isset($adverid) )
                $adver = $dao->getAdver($adverid);
            
            print_r($adver);
        ?>
        <form action="adverEdit.php" method="post"  class="form-horizontal">
            <input type="hidden" name="adverid" value="<?php echo isset($adverid)?$adverid:""?>"/>
            <input type="hidden" name="actid" value="<?php echo $actid?>"/>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">广告标题：</label>
                <div class="col-sm-3">
                    <input id="name" name="name" class="form-control" type="text" placeholder="广告标题" value="<?php 
                        echo isset($adver) ? $adver['adver_tit'] : '';
                    ?>"/>
                </div>
            </div>
            
            <div class="form-group">
                <label for="st-date" class="col-sm-2 control-label">有效时间（起）：</label>
                <div class="col-sm-3">
                    <input id="st-date" name="st-date" class="form-control" type="datetime-local" placeholder="" value="<?php 
                        echo isset($adver) ? (new DateTime( $adver['st_date'] ))->format("Y-m-d\TH:i"): '';
                    ?>"/>
                </div>
            </div>
            
            <div class="form-group">
                <label for="end-date" class="col-sm-2 control-label">有效时间（止）：</label>
                <div class="col-sm-3">
                    <input id="end-date" name="end-date" class="form-control" type="datetime-local" placeholder="" value="<?php 
                        echo isset($adver) ? (new DateTime( $adver['end_date'] ))->format("Y-m-d\TH:i"): '';
                    ?>"/>
                </div>
            </div>
            
            <div class="form-group">
                <label for="link-url" class="col-sm-2 control-label">广告链接：</label>
                <div class="col-sm-7">
                    <div class="input-group">
                        <span class="input-group-addon">http://</span>
                        <input name="link-url" type="text" class="form-control" id="link-url" placeholder="广告链接" value="<?php 
                        echo isset($adver) ? $adver['url'] : '';
                    ?>">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="img-url" class="col-sm-2 control-label">广告图片地址：</label>
                <div class="col-sm-7">
                    <div class="input-group">
                        <span class="input-group-addon">http://</span>
                        <input id="img-url" name="img-url" class="form-control" type="text" placeholder="广告图片地址" value="<?php 
                        echo isset($adver) ? $adver['img_url'] : '';
                    ?>"/>
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