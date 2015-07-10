<!DOCTYPE html>
<html class="index">
<head lang="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>微联众-互动营销系统后台管理</title>

    <link rel="shortcut icon" href="../favicon.ico" />
    <link rel="stylesheet" href="css/index.css"/>
</head>
<body>
    <div class="warp">
        <header>
            <span class="logo">LOGO</span>

        </header>
        <article class="leftpanel">
            <header>分类导航</header>
            <nav class="leftmenu">
                <ul class="nav nav-tabs nav-stacked">
                    <li class="dropdown active">
                    	<a ><span class="glyphicon glyphicon-th-list"></span>一砍到底<span class="glyphicon glyphicon-menu-up"></span></a>
                        <ul>
                            <!--actives.php?type=freemeal-->
                            <li class="active"><a href="javascript:void(0)" data-type="actEdit.php?actid=10003">
                                <span class="glyphicon glyphicon-th-large"></span>活动管理</a>
                            </li>
                            <li><a href="javascript:void(0)">
                                <span class="glyphicon glyphicon-th-large"></span>广告管理</a>
                            </li>
                            <li><a href="javascript:void(0)">
                                <span class="glyphicon glyphicon-th-large"></span>商品管理</a>
                            </li>
                            <li><a href="javascript:void(0)">
                                <span class="glyphicon glyphicon-th-large"></span>商家管理</a>
                            </li>
                            <li><a href="javascript:void(0)">
                                <span class="glyphicon glyphicon-th-large"></span>规则管理</a>
                            </li>
                            <li><a href="javascript:void(0)">
                                <span class="glyphicon glyphicon-th-large"></span>分享管理</a>
                            </li>

                        </ul>
                    </li>
                    <li class="dropdown">
                        <a ><span class="glyphicon glyphicon-th-list"></span>霸王餐<span class="glyphicon glyphicon-menu-up"></span></a>
                        <ul>
                            <li class="dropdown">
                                <a href="javascript:void(0)">
                                    <span class="glyphicon glyphicon-th-large"></span> 子菜单1
                                </a>
                                <ul>
                                    <li><a href="javascript:void(0)"><span class="glyphicon glyphicon-minus"></span>三级菜单1</a></li>
                                    <li><a href="javascript:void(0)"><span class="glyphicon glyphicon-minus"></span>三级菜单2</a></li>
                                    <li><a href="javascript:void(0)"><span class="glyphicon glyphicon-minus"></span>三级菜单3</a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)">
                                <span class="glyphicon glyphicon-th-large"></span>子菜单2</a></li>
                            <li><a href="javascript:void(0)">
                                <span class="glyphicon glyphicon-th-large"></span>子菜单3</a></li>
                            <li><a href="javascript:void(0)">
                                <span class="glyphicon glyphicon-th-large"></span>子菜单4</a></li>
                        </ul>
                    </li>
                    <li><a ><span class="glyphicon glyphicon-lock"></span>系统3</a></li>
                    <li><a ><span class="glyphicon glyphicon-tag"></span>系统4</a></li>
                </ul>
            </nav>
        </article>
        <article class="rightpanel">
            <iframe class="main-frame" src=""></iframe>
        </article>
    </div>

    <?php require_once 'alert.php';?>

    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/index.js"></script>
</body>
</html>