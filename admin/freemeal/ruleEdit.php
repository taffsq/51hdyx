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
        <header class="info-header">规则编辑</header>
        <?php 
            include '../php/class/admin/Dao.php';
            use php\admin;
            
            $actid = isset($_REQUEST['actid']) ? $_REQUEST['actid'] : NULL;
            $dao = new admin\Dao();
            
            echo 'ruleRequest:';
            print_r($_REQUEST);
            
            //检查是否有数据
            if( isset($_POST['name'],$actid) ){
                $ruleid = NULL;
                //检察是否有数据，有就更新，没有就插入
                if( $dao->checkRule($actid) )
                    $dao->updateRule($_REQUEST);
                else
                    $dao->insertRule($_REQUEST);
                
               
                $ruleid = $dao->getRule($actid)["rule_id"];
                $_POST["ruleid"] = $ruleid;
                $ruleCount = $dao->countRuleDetail($ruleid);
                if( isset($_POST['ruledetail'])  ){
                    $dao->insertRuleDetail( $_POST,$dao->updateRuleDetail( $_POST,$ruleCount ) );
                    $dao->deleteRuleDetail( $_POST );
                }
                
                if( isset($_REQUEST['actid']) ){
                    header("location:actEdit.php?actid=".$actid);
                }
            }
            
            $rule = NULL;
            $ruleDetail = NULL;
            if( isset($actid) && $dao->checkRule($actid) ){
                $rule = $dao->getRule($actid);
                $ruleDetail = $dao->getRuleDetail($rule['rule_id']);
            }
        ?>
        <form action="ruleEdit.php" method="post"  class="form-horizontal">
            <input type="hidden" name="actid" value="<?php echo $actid?>"/>
            <input type="hidden" name="ruleid" value="<?php echo isset($rule)?$rule['rule_id']:''?>"/>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">规则标题：</label>
                <div class="col-sm-3">
                    <input id="name" name="name" class="form-control" type="text" placeholder="规则标题" value="<?php 
                        echo $rule['rule_title'];
                    ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label for="desc" class="col-sm-2 control-label">规则描述：</label>
                <div class="col-sm-5">
                    <textarea id="desc" name="desc" class="form-control" rows="4" type="text" placeholder="规则描述"><?php 
                        echo $rule['rule_desc'];
                    ?></textarea>
                </div>
            </div>

            <!--规则选择-->
            <div class="form-group">
                <label class="col-sm-2 control-label">规则：</label>
                <div class="col-sm-12">
                    <article class="info-table-main">
                        <section class="rule-table">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="add-rule">
                                        <a href="javascript:void(0)">
                                            <span class="glyphicon glyphicon-plus"></span>添加新的条目
                                        </a>
                                    </th>
                                    <th>序号</th>
                                    <th>内容</th>
                                </tr>
                                </thead>

                                <tbody>
                                    <?php 
                                        if( isset($ruleDetail) ){
                                            $ix = 1;
                                            foreach ( $ruleDetail as $value){
                                    ?>
                                    <tr data-removeid="1">
                                        <td class="remove-rule table-delete">
                                            <a href="javascript:void(0)">
                                                <span class="glyphicon glyphicon-remove"></span>删除
                                            </a>
                                        </td>
                                        <td class="rule-ix"><?php echo $ix?>、</td>
                                        <td >
                                            <textarea name="ruledetail[]"><?php echo $value['rule_content']?></textarea>
                                        </td>
                                    </tr>
                                    <?php 
                                            $ix++;
                                            }
                                       }?>
                                </tbody>
                            </table>
                        </section>
                    </article>
                </div>
            </div>

            <div class="form-group">
                <div class="submit-btn-con col-sm-12">
                    <button class="btn btn-primary" type="submit">提交</button>
                    <button class="btn btn-primary reload" type="button">取消</button>
                </div>
            </div>
        </form>

    </div>
</div>

<?php require_once 'alert.php';?>
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/index.js"></script>
<script src="js/ruleEdit.js"></script>
</body>
</html>