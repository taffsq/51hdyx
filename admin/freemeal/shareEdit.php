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
        <header class="info-header">分享编辑</header>
        <?php 
            include '../php/class/admin/Dao.php';
            use php\admin;
            
            $actid = isset($_REQUEST['actid']) ? $_REQUEST['actid'] : NULL;
            $shareid=isset($_REQUEST["shareid"])?$_REQUEST["shareid"]:NULL;
            $dao = new admin\Dao();
            
            echo 'shareRequest:';
            print_r($_REQUEST);
            
            //如果有id就更新，否则更新数据选项
            if( isset($_POST['title'],$actid) ){           
                //检测是否存在,存在就更新数据
                if( $dao->checkShare( $actid ) )
                   $dao->updateShare($_REQUEST);
                //否则 就插入数据
                else if( $dao->insertShare($_REQUEST) )
                    echo "插入成功";
                header("location:actEdit.php?actid=".$actid);
            }
            
            $share = NULL;
            if( isset($actid) )
                $share = $dao->getShare($actid);
        ?>
        <form action="shareEdit.php" method="post"  class="form-horizontal">
            <input type="hidden" name="actid" value="<?php echo $actid?>"/>
            <input type="hidden" name="shareid" value="<?php echo $shareid?>"/>
            <div class="form-group">
                <label for="title" class="col-sm-2 control-label">分享标题：</label>
                <div class="col-sm-3">
                    <input id="title" name="title" class="form-control" type="text" placeholder="分享标题" value="<?php 
                        echo $share['share_title']
                    ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label for="desc" class="col-sm-2 control-label">分享描述：</label>
                <div class="col-sm-3">
                    <input id="desc" name="desc" class="form-control" type="text" placeholder="分享描述" value="<?php 
                        echo $share['share_desc']
                    ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label for="img-url" class="col-sm-2 control-label">分享图片地址：</label>
                <div class="col-sm-7">
                    <div class="input-group">
                        <span class="input-group-addon">http://</span>
                        <input name="img-url" type="text" class="form-control" id="img-url" placeholder="分享图片地址" value="<?php 
                        echo $share['share_img_url']
                    ?>">
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