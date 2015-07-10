<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>

    <link rel="stylesheet" href="css/index.css"/>
    
    <!-- temp -->
    <link rel="stylesheet" href="css/actives.css"/>
    <!-- temp-end -->
</head>
<body>
    <div class="actives info-table">
        <article class="actives-main info-table-main">
            <header class="info-header">活动列表</header>
            <div class="add-btn-con">
                <a href="<?php echo 'actEdit.html'?>" class="btn btn-primary">
                    <span class="glyphicon glyphicon-plus">
                    </span>
                    添加活动
                </a>

            </div>
            <section class="actives-list">
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>活动名称</th>
                            <th>活动商家</th>
                            <th>活动开始时间</th>
                            <th>活动结束时间</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                            include '../php/class/admin/Dao.php';
                            use php\admin;
                            
                            $dao = new admin\Dao();
                            $actList = $dao->getActs();
                            
                            //取出值
                            foreach ($actList as $value) {
                        ?>
                        <tr>
                            <td class="link">
                                <a href="<?php echo 'actEdit.html?aId='.(String)$value['act_id']?>">
                                <span class="glyphicon glyphicon-pencil"></span>
                                                                                                     编辑
                                </a>
                            </td>
                            <td><?php echo $value['act_name']?></td>
                            <td><?php echo $value['vendor_name']?></td>
                            <td><?php echo $value['st_date']?></td>
                            <td><?php echo $value['end_date']?></td>
                        </tr>
                        <?php 
                            }?>
                    </tbody>
                </table>
            </section>
        </article>

    </div>

</body>
</html>