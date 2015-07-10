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
            $dao = new admin\Dao();
            $foodid = isset($_REQUEST['foodid']) ? $_REQUEST['foodid'] : NULL;
            
            echo 'foodEditRequest:';
            print_r($_REQUEST);
            echo '<br>';
            //有数据
            if( isset($_POST['food-name']) ){
                //有ID则为更新选项，否则就创建
                if( !empty($_REQUEST['foodid']) && $dao->checkFood($foodid) ){
                    $dao->updateFood($_REQUEST);
                    
                    $dao->updateFoodMats($_REQUEST);
                    $dao->insertFoodMats($_REQUEST);
                    $dao->fiterFoodMats($foodid);
                }else{
                    $foodid = $dao->insertFood($_REQUEST);
                    $_REQUEST["foodid"] = $foodid;
                    $dao->insertActFood( $actid,$foodid );
                    $dao->insertFoodMats($_REQUEST);
                }
                
                if( isset($_REQUEST['actid']) )
                    header("location:actEdit.php?actid=".$actid);
            }
            
            $food = NULL;
            if( isset($foodid) && $dao->checkFood($foodid) )
                $food = $dao->getFood($foodid);
        ?>
        <form action="foodEdit.php" method="post"  class="form-horizontal">
            <input type="hidden" name="foodid" value="<?php echo isset($foodid)?$foodid:""?>"/>
            <input type="hidden" name="actid" value="<?php echo $actid?>"/>
            <div class="form-group">
                <label for="food-name" class="col-sm-2 control-label">食物名称：</label>
                <div class="col-sm-3">
                    <input id="food-name" name="food-name" class="form-control" type="text" placeholder="食物名称" value="<?php 
                        echo isset($food)?$food['food_name']:"";
                    ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label for="food-desc" class="col-sm-2 control-label">食物描述：</label>
                <div class="col-sm-3">
                    <input id="food-desc" name="food-desc" class="form-control" type="text" placeholder="食物描述" value="<?php 
                        echo isset($food)?$food['food_desc']:"";
                    ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label for="food-img-url" class="col-sm-2 control-label">食物图片地址：</label>
                <div class="col-sm-7">
                    <div class="input-group">
                        <span class="input-group-addon">http://</span>
                        <input id="food-img-url" name="food-img-url" class="form-control" type="text" placeholder="食物图片地址" value="<?php 
                        echo isset($food)?$food['food_img_url']:"";
                    ?>"/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">添加材料：</label>
                <div class="col-sm-5">
                    <a href="<?php echo 'materialEdit.php'.(isset($foodid)?'?foodid='.$foodid:'')?>" class="btn btn-primary">
                           <span class="glyphicon glyphicon-plus"></span>添加新材料
                    </a>
                </div>
            </div>
            <!--规则选择-->
            <div class="form-group">
                <label class="col-sm-2 control-label">选择已有材料：</label>
                <div class="col-sm-4">
                    <article class="info-table-main">
                        <section class="food-edit">
                            <table class="table">
                                <thead>
                                <tr>
                                    <!-- <th>
                                        <div class="checkbox">
                                            <label><input type="checkbox" onclick="check_all(this,'materials[]')"/>选择材料</label>
                                        </div>
                                    </th> -->
                                    <th>材料名</th>
                                    <th class="table-number">材料完整度(<span></span>%)
                                    </th>
                                </tr>
                                </thead>

                                <tbody>
                                   <?php 
                                        $mats = $dao->getMaterials($foodid);
                                        
                                        
                                        foreach( $mats as $mat ){
                                   ?>
                                   <tr>
                                        <td class="food-material-name">
                                            <a role="button" tabindex="0" href="javascript:void(0)" data-toggle="popover-img" data-placement="top"
                                                title="<?php echo  $mat['material_name']?>"
                                                data-img-url="<?php echo $mat['material_img_url']?>">
                                                <?php echo  $mat['material_name']?>               
                                                <span class="glyphicon glyphicon-search"></span>
                                            </a>
                                        </td>
                                        <td >
                                            <input type="checkbox" class="food-select-box"/>
                                            <input class="precen" type="text" placeholder="0" name="<?php 
                                                echo 'materials['.$mat['material_id'].']'?>" value="<?php 
                                                echo $mat['material_kg'];
                                            ?>"/>
                                        </td>
                                    </tr>
                                <?php };?>
                                </tbody>
                            </table>
                        </section>
                    </article>
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
<script src="js/foodEdit.js"></script>

</body>
</html>