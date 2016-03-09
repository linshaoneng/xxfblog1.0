<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?php echo ($title); ?></title>
    <meta name="description" content="<?php echo ($description); ?>" />
    <meta name="keywords" content="<?php echo ($keywords); ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/myblog/Public/Common/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/myblog/Public/Common/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/myblog/Public/MyAdmin/css/login.css" />
</head>
<body>
<div class="login-wrapper">

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 box">
                <div class="content-wrap">
                    <h6>后台登陆</h6>
                    <form action="<?php echo U('Login/index');?>" method="post" class="form">
                        <div class="form-group col-lg-12" id="account-form" >
                            <div class="input-group input-group-lg col-lg-12">
                                <span class="input-group-addon"><span aria-hidden="true" class="fa fa-user"></span></span>
                                <input class="form-control" name="username" id="username" type="text" placeholder="账号">
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="input-group input-group-lg col-lg-12">
                                <span class="input-group-addon"><span aria-hidden="true" class="fa fa-lock"></span></span>
                                <input class="form-control" name="password" type="password" placeholder="密码">
                            </div>
                        </div>
                        <div class="form-group col-lg-12" id="verifyDiv">
                            <div class="input-group input-group-lg col-lg-6" style="float:left; margin-right:10px;">
                                <span class="input-group-addon"><span aria-hidden="true" class="fa fa-random"></span></span>
                                <input class="form-control text-input" name="verify" type="text" placeholder="验证码">
                            </div>
                            <div class="fl">
                                <img src="<?php echo U('Login/verify');?>" onclick="change_verify();" id="verify_img" width="145" height="45">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 login-btn">
                                <input type="hidden" name="errorNum" id="errorNum" value="0">
                                <p><button type="submit" class="btn btn-primary btn-lg btn-block submit-btn">立刻登录</button></p>
                            </div>
                        </div>
                        <div class="notification"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/myblog/Public/Common/js/jquery.min.js"></script>
<script type="text/javascript">
    //刷新验证码
    function change_verify(){
        var str = "<?php echo U('Login/verify');?>";
        document.getElementById('verify_img').src=str+'-'+new Date().getTime();
    }

    //表单提交
    $('form').submit(function(){
        var _this = $(this);
        $.post(_this.attr('action'), _this.serialize(), success, 'json');
        return false;
        function success(data){
            if(data.status){
                window.location.href = data.url;
            }else{
                $('.notification').html(data.info);
                change_verify();
            }
        }
    });
</script>
</body>
</html>