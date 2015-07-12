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
<?php 
    include '../php/class/admin/Dao.php';
    use php\admin;
    
    $dao = new admin\Dao();
    $actid = isset( $_REQUEST["actid"] ) ? $_REQUEST["actid"] : NULL;
    $foods = isset( $_POST['foods'] ) ? $_POST['foods'] : NULL;
    
    if( isset($_POST["act-name"]) )
        $dao->updateAct($_POST);
    
    if( !isset($actid) || !$dao->checkAct($actid) )
        $actid = $dao->insertAct();
    
    $add_vendor_url = changeLink( 'vendorEdit.php', $actid );
    $add_adver_url = changeLink( 'adverEdit.php', $actid );
    $add_share_url = changeLink( 'shareEdit.php', $actid );
    $edit_rule_url = changeLink( 'ruleEdit.php', $actid );
    $edit_food_url = changeLink( 'foodEdit.php', $actid );
    
    $actItem = $dao->getAct( $actid );
    
    echo "params:   ";
    print_r( $actItem );
    echo "<br>";
    
    if( isset($foods) ){
    	echo 'foods:';
    	foreach ( $foods as $fid=>$food){
    		$food['kg'] *= 100;
    		echo $dao->updateActFood($actid, $fid, $food);
    	}
    }
    
    function changeLink( $url,$actid ){
        return $url.(isset( $actid )?"?actid=".$actid:'');
    }
?>
    <div class="act-edit info-table">
        <div class="act-edit-main info-table-main">
            <header class="info-header">活动编辑</header>

            <form action="actEdit.php" method="post"  class="form-horizontal" onsubmit="formChange(this)">
                <input type="hidden" name="actid" value="<?php echo $actid?>"/>
                <div class="form-group">
                    <label for="act-name" class="col-sm-2 control-label">活动名称：</label>
                    <div class="col-sm-3">
                        <input id="act-name" name="act-name" class="form-control" type="text" value="<?php 
                            echo $actItem['act_name'];
                        ?>"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="act-st-time" class="col-sm-2 control-label">开始时间：</label>
                    <div class="col-sm-4">
                        <input id="act-st-time" name="act-st-time" class="form-control" type="datetime-local" value="<?php
                            echo (new DateTime( $actItem['st_date'] ))->format("Y-m-d\TH:i");
                        ?>"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="act-end-time" class="col-sm-2 control-label">结束时间：</label>
                    <div class="col-sm-4">
                        <input id="act-end-time" name="act-end-time" class="form-control" type="datetime-local" value="<?php
                            echo (new DateTime( $actItem['end_date'] ))->format("Y-m-d\TH:i");
                        ?>"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="act-vendor" class="col-sm-2 control-label">商家选择：</label>
                    <div class="col-sm-3">
                        <input type="hidden" name="vendor" value="<?php echo $actItem['vendor_id']?>"></input>
                        <div class="btn-group select-drop-down" id="act-vendor"> 
                            <button type="button" class="btn btn-default dropdown-toggle form-item" data-form-name="vendor" data-toggle="dropdown"><?php echo $actItem['vendor_name']?$actItem['vendor_name']:"选择商家"?> <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo $add_vendor_url?>" class="form-a">添加商家</a></li>
                                <li role="separator" class="divider"></li>
                                
                                <?php 
                                        $vendors = $dao->getVendors();
                                        //取出值
                                        foreach ($vendors as $value) {
                                ?>
                                <li data-info="<?php echo $value['vendor_id']?>"><a href="javascript:void(0)"><?php echo $value['vendor_name']?></a></li>
                                <?php }?>
                                <?php /* <li data-container="body" data-toggle="popover-img" data-placement="right" title="青椒肉丝" data-img-url="http://i3.meishichina.com/attachment/recipe/201109/201109131526280.jpg">
 <a href="javascript:void(0)"><span class="glyphicon glyphicon-search"></span> 青椒肉丝1</a>
                                </li> */
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <!--广告选择-->
                <div class="form-group">
                    <label class="col-sm-2 control-label">广告选择：</label>
                    <div class="col-sm-9">
                        <article class="info-table-main">
                            <section class="adver-table">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <a href="<?php echo $add_adver_url?>">
                                                    <span class="glyphicon glyphicon-plus"></span>
                                                                                                                                                     添加新广告
                                                </a>
                                            </th>
                                            <th>删除 </th>
                                            <th>广告标题</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                            $advers = $dao->getAdvers($actid);
                                            
                                            foreach ( $advers as $value ){
                                        ?>
                                        <tr>
                                            <td class="table-edit">
                                                <a href="<?php echo $add_adver_url.'&adverid='.$value['adver_id']?>">
                                                    <span class="glyphicon glyphicon-pencil"></span>编辑
                                                </a>
                                            </td>
                                            <td class="table-delete">
                                                <a href="<?php echo 'adverRemove.php?adverid='.$value['adver_id'].'&actid='.$actid?>">
                                                    <span class="glyphicon glyphicon-remove"></span>
                                                                                                                                                     删除
                                                </a>
                                            </td>
                                            <td >
                                                <a role="button" tabindex="0" href="javascript:void(0)" data-toggle="popover-img" data-placement="top"
                                                   title="<?php echo  $value['adver_tit']?>"
                                                   data-img-url="<?php echo $value['img_url']?>">
                                                   <?php echo  $value['adver_tit']?>               
                                                    <span class="glyphicon glyphicon-search"></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php                                             
                                            }?>
                                    </tbody>
                                </table>
                            </section>
                        </article>
                    </div>
                </div>

                <!--分享选择-->
                <div class="form-group">
                    <label class="col-sm-2 control-label">分享：</label>
                    <div class="col-sm-9">
                        <article class="info-table-main">
                            <section>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>编辑 </th>
                                        <th>分享标题</th>
                                        <th>分享描述</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr>
                                        <td class="table-edit">
                                            <a href="<?php echo $add_share_url?>">
                                                <span class="glyphicon glyphicon-pencil"></span>编辑
                                            </a>
                                        </td>
                                        <td >
                                        <?php 
                                            $share = isset($actid)?$dao->getShare($actid):NULL;
                                        ?>
                                            <a role="button" tabindex="0" href="javascript:void(0)" data-toggle="popover-img" data-placement="top"
                                               title="<?php echo isset($share)?$share['share_title']:"新分享标题"?>"
                                               data-img-url="<?php echo isset($share)?$share['share_img_url']:""?>">
                                                   <?php echo isset($share)?$share['share_title']:"新分享标题"?>
                                                <span class="glyphicon glyphicon-search"></span>
                                            </a>
                                        </td>
                                        <td><?php echo isset($share)?$share['share_desc']:"新分享描述"?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </section>
                        </article>
                    </div>
                </div>

                <!--规则选择-->
                <div class="form-group">
                    <label class="col-sm-2 control-label">规则：</label>
                    <div class="col-sm-9">
                        <article class="info-table-main">
                            <section>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>编辑 </th>
                                        <th>规则标题</th>
                                        <th>规则描述</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr>
                                        <td  class="table-edit">
                                            <a href="<?php echo $edit_rule_url?>">
                                                <span class="glyphicon glyphicon-pencil"></span>编辑
                                            </a>
                                        </td>
                                        <td >
                                        <?php 
                                            $rule = isset($actid)?$dao->getRule($actid) : NULL;
                                        ?>
                                            <a role="button" tabindex="0" href="javascript:void(0)" data-toggle="popover" data-placement="top"
                                               title="<?php echo isset($rule)?$rule['rule_title']:'新规则'?>"
                                               data-content="<?php echo isset($rule)?$rule['rule_desc']:'新规则描述'?>">
                                                <?php echo isset($rule)?$rule['rule_title']:'新规则'?>
                                                <span class="glyphicon glyphicon-search"></span>
                                            </a>
                                        </td>
                                        <td><?php echo isset($rule)?$rule['rule_desc']:'新规则描述'?> </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </section>
                        </article>
                    </div>
                </div>

                <!--菜品选择-->
                <div class="form-group">
                    <label class="col-sm-2 control-label">菜品选择：</label>
                    <?php /*<div class="col-sm-3">
                        <a href="<?php echo $edit_food_url?>" class="btn btn-primary">
                            <span class="glyphicon glyphicon-plus"></span>添加菜品   
                        </a>
                    </div> */?>
                    <div class="food-selects col-sm-9">
                        <table class="table">
                            <thead>
                            <tr>
                                <th> 
                                    <a href="<?php echo $edit_food_url?>">
                                      <span class="glyphicon glyphicon-plus"></span>添加菜品
                                    </a>
                                </th>
                                <th>删除</th>
                                <th>名称</th>
                                <th>随机聚集量（最大）</th>
                                <th>随机聚集量（最小）</th>
                                <th>重量</th>
                            </tr>
                            </thead>

                            <tbody>
                                <?php 
                                    $actFoods = $dao->getActFoods($actid);
                                    $cutFood = NULL;
                                    foreach ( $actFoods as $value ){
                                    	$cutFood = 'foods['.$value['food_id'].']';
                                ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo $edit_food_url."&foodid=".$value['food_id']?>">
                                            <span class="glyphicon glyphicon-pencil"></span>编辑
                                        </a>
                                    </td>
                                    <td class="table-delete">
                                        <a href="<?php echo 'actFoodRemove.php?foodid='.$value['food_id'].'&actid='.$actid?>">
                                           <span class="glyphicon glyphicon-remove"></span>删除
                                        </a>
                                    </td>
                                    <td>
                                        <a role="button" tabindex="0" href="javascript:void(0)" data-toggle="popover-img" data-placement="top"
                                               title="<?php echo $value["food_name"] ?>"
                                               data-img-url="<?php echo $value['food_img_url']?>">
                                                   <?php echo $value["food_name"]?>
                                                <span class="glyphicon glyphicon-search"></span>
                                            </a>
                                    </td>
                                    <td>
                                        <input type="text" placeholder="0" name="<?php echo $cutFood.'[maxkg]'?>" value="<?php 
                                            echo $value["max_kg"];
                                        ?>"/>克
                                    </td>
                                    <td>
                                        <input type="text" placeholder="0" name="<?php echo $cutFood.'[minkg]'?>" value="<?php 
                                            echo $value["min_kg"];
                                        ?>"/>克
                                    </td>
                                    <td>
                                        <input type="text" placeholder="0" name="<?php echo $cutFood.'[kg]'?>" value="<?php 
                                            echo $value["kg"]/100;
                                        ?>"/>百克
                                    </td>
                                </tr>
                                <?php                                         
                                    }?>
                            </tbody>
                        </table>
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