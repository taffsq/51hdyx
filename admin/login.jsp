<%@page import="java.io.PrintWriter"%>
<%@page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>微联众-互动营销系统后台管理</title>

    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="stylesheet" href="css/index.css"/>
</head>
<%
	//验证的结果，和获取用户名和密码两个变量
	boolean formResult = true;
	String u = request.getParameter("u");
	String p = request.getParameter("p");
%>
<body>
    <style>
        @media all and (min-device-width: 1024px){
            .login {
                width: 400px!important;
            }
        }
        .login{
            width:300px;
            margin: 0 auto;
        }
        .login .form-group{
            margin:1em;
        }
        .login label{
            color:#0866C6;
        }
        .login .input-group-addon{
            top:0;
        }
        .login .login-sumit{
            text-align: center;
        }
        .login .button{
            /*padding: 7px 30px;*/
        }
    </style>
    <div class="warp infobox login">
	    <div>
	        <header>登录</header>
	        <form action="login.jsp" method="POST" class="form-horizontal" onsubmit="return checkLogin( this )">
	            <div id="formuser" class="form-group has-feedback <%
	            		if( u!= null ){
	            			if( u.equals("admin") ) out.print("has-success"); 
	            			else {
	            				out.print("has-error");
	            				formResult = false;
	            			}
	            		}%>">
	                <label for="user" class="col-sm-3 control-label">用户名:</label>
	                <div class="col-sm-9">
	                    <div class="input-group">
	                        <span class="input-group-addon glyphicon glyphicon-user"></span>
	                        <input id="user" name="u" class="form-control" placeholder="用户名"/>
	                    </div>
	                    <span class="form-control-feedback glyphicon glyphicon-ok"></span>
	                </div>
	            </div>
	            <div id="formpass" class="form-group has-feedback <%
	            		if( p!= null ){
	            			if( p.equals("admin") ) out.print("has-success"); 
	            			else {
	            				out.print("has-error");
	            				formResult = false;
	            			}
	            		}%>">
	                <label for="password" class="col-sm-3 control-label">密码:</label>
	                <div class="col-sm-9">
	                    <div class="input-group">
	                        <span class="input-group-addon glyphicon glyphicon-lock"></span>
	                        <input id="password" name="p" type="password" class="form-control" placeholder="密码"/>
	                    </div>
	                    <span class="form-control-feedback glyphicon glyphicon-ok"></span>
	                </div>
	            </div>
	            <div class="form-group login-sumit">
	                <button type="submit" class="button">登录</button>
	            </div>
				<%
					if( formResult && u!=null && p!=null)
						request.getRequestDispatcher("index.html").forward(request, response);
				%>
	        </form>
	    </div>
	</div>
	<script>
	    function checkLogin( tar ){
	        var aa = $(tar.u).parentsUntil(".form-group");
	        console.log( tar.u.value+"___"+ aa);
	        if( tar.u.value.length < 4 ){
	            $("#formuser").addClass( "has-error" );
	            return false;
	        }else $("#formuser").removeClass("has-error").addClass("has-success");
	
	        if( tar.p.value.length < 4 ){
	            $("#formpass").addClass( "has-error" );
	            return false;
	        }else $("#formpass").removeClass("has-error").addClass("has-success")
	
	        return true;
	    }
	</script>
    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>