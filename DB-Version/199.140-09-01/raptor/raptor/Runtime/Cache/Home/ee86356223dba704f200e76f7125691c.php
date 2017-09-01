<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <title>匠迪云</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="匠迪云，代码安全，代码检测，匠迪技术">
    <meta name="description" content="匠迪云是一款线上安全服务平台，集产品安全服务展示，体验，交付等多种功能">
    <link rel="shortcut icon" href="images/favicon.ico"/>
    <link rel="stylesheet" href="/Public/Css/bootstrap.css">
    <link rel="stylesheet" href="/Public/Css/common.css">
    <script src="/Public/Js/jquery-3.1.1.min.js"></script>
    <script src="/Public/Js/bootstrap.min.js"></script>
	<style type="text/css">
		#navbar .navbar-nav li a:hover{
			color:#65b6fc;
		}
	</style>
</head>
<body>
<nav class="navbar navbar-default  navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo U('index');?>"><img src="/Public/Images/logo1.png" alt="" title="匠迪云安全"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse" >

            <ul class="nav navbar-nav">
                <li><a href="<?php echo U('Index/index');?>" class="index">首页</a></li>
                <li><a href="<?php echo U('Index/index?type=second#second');?>" class="second">产品介绍</a></li>
                <li><a href="<?php echo U('product/product');?>" class="product">产品服务</a></li>
                <li><a href="<?php echo U('Index/index?type=third#third');?>" class="third">联系我们</a></li>
                <li><a href="<?php echo U('Login/login');?>">免费检测</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo U('Login/login');?>" class="login_not">登陆</a></li>
                <li><a href="<?php echo U('Signin/signin');?>" class="signin">注册</a></li>
            </ul>

        </div>
    </div>
</nav>

<script>
	 $(function(){
        var file = "<?php echo ($_SERVER['PATH_INFO']); ?>";
        var type = "<?php echo ($_GET['type'] ? $_GET['type'] : ''); ?>";
        if(file == 'Index/index' && type == ''){
            $('.index').css('border-bottom','4px solid #65b6fc');
        }else if(file == 'product/product'){
            $('.product').css('border-bottom','4px solid #65b6fc');
        }else if(file == '/login_not.html'){
            $('.login_not').css('border-bottom','4px solid #65b6fc');
        }else if(file == '/signin.html'){
            $('.signin').css('border-bottom','4px solid #65b6fc');
        }else if(type == 'second' && file == 'Index/index/type/second'){
			$('.second').css('border-bottom','4px solid #65b6fc');
        }else if(type == 'third' && file == 'Index/index/type/third'){
        	$('.third').css('border-bottom','4px solid #65b6fc');
        }
    });
</script>
<link rel="stylesheet" href="/Public/Css/signin.css">
<div class="container">
    <div class="row main">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <h2 class="title">欢迎使用<br>匠迪代码安全审查系统</h2>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <form action= "" id="form" onsubmit="return false">
                <div class="xddw message">
                    <span>用户名：</span>
                    <input type="text" name="user_name" placeholder="请输入用户名/手机号/邮箱" class="message-input">
                    <p class="warning"></p>
                </div>

                <div class="xddw message">
                    <span>密码：</span>
                    <input type="password" name="password" placeholder="请输入密码" class="message-input">
                    <p class="warning warning_err"></p>
                </div>

                <div class="xddw message">
                    <span>验证码：</span>
                    <input type="text" id="inputCode" placeholder="输入验证码" class="message-input" style="width: 45%">
                    <div class="code" id="checkCode" onclick="createCode()" ></div>
                    <p class="warning login_code"></p>
                </div>

                <div class="xddw message">
                    <button class="register" type="submit" type = "button">登&nbsp;&nbsp;陆</button>
                </div>
                <div class="xddw message" style="font-size: 12px">
                    <span ><a href="<?php echo U('Signin/signin');?>">注册新用户</a></span>
                    <span style="left: 76%"><a href="<?php echo U('Backpwd/backpwd');?>">忘记密码？</a></span>
                </div>

                <p style = "width:440px;font-size:14px;text-align:center;color:#22a8de">(建议使用谷歌浏览器)</p>
            </form>
        </div>
    </div>
</div>
<script src="/Public/Js/login.js"></script>
</body>
</html>