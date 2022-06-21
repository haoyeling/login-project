<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>register</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ 'Bootstrap/css/bootstrap.min.css' }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <link rel="stylesheet" href="{{ 'Bootstrap/css/style.default.css' }}" id="theme-stylesheet">
    <link rel="stylesheet" href="{{ 'layui/css/layui.css' }}">
  </head>
  <body>
    <div class="page login-page">
      <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
          <div class="row">
            <!-- Logo & Information Panel-->
            <div class="col-lg-6">
              <div class="info d-flex align-items-center">
                <div class="content">
                  <div class="logo">
                    <h1>欢迎注册</h1>
                  </div>
                </div>
              </div>
            </div>
            <!-- Form Panel    -->
            <div class="col-lg-6 bg-white">
              <div class="form d-flex align-items-center">
                <div class="content">
                    <div class="form-group">
                      <input id="register-username" class="input-material" type="email" name="registerUsername" placeholder="请输入邮箱" >
								      <div class="invalid-feedback">
								        	请输入正确的邮箱格式
								      </div>
                    </div>
                    <div class="form-group">
                      <input id="register-password" class="input-material" type="password" name="registerPassword" placeholder="请输入密码"   >
                    	<div class="invalid-feedback">
								        	密码必须在6~10位之间
								      </div>
                    </div>
                    <div class="form-group">
                      <input id="register-passwords" class="input-material" type="password" name="registerPasswords" placeholder="确认密码"   >
                    	<div class="invalid-feedback">
								        	两次密码必须相同 且在6~10位之间
								      </div>
                    </div>
                    <div class="form-group">
                      <button id="regbtn" type="button" name="registerSubmit" class="btn btn-primary">注册</button>
                    </div>
                  <small>已有账号?</small><a href="login.html" class="signup">&nbsp;登录</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="{{ 'Bootstrap/js/jquery.min.js' }}"></script>
    <script src="{{ 'Bootstrap/js/bootstrap.min.js' }}"></script>
    <script src="{{ 'layui/layui.js' }}"></script>
    <script>
    	$(function(){
    		/*错误class  form-control is-invalid
    		正确class  form-control is-valid*/
    		var flagName=false;
    		var flagPas=false;
    		var flagPass=false;
    		/*验证邮箱*/
    		var name,passWord,passWords;
    		$("#register-username").change(function(){
    			name=$("#register-username").val();
			    var re=/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/
    			if(!re.test(name)){
    				$("#register-username").removeClass("form-control is-valid")
    				$("#register-username").addClass("form-control is-invalid");
    				flagName=false;
    			}else{
    				$("#register-username").removeClass("form-control is-invalid")
    				$("#register-username").addClass("form-control is-valid");
    				flagName=true;
    			}
    		})
    		/*验证密码*/
    		$("#register-password").change(function(){
    			passWord=$("#register-password").val();
    			if(passWord.length<6||passWord.length>18){
    				$("#register-password").removeClass("form-control is-valid")
    				$("#register-password").addClass("form-control is-invalid");
    				flagPas=false;
    			}else{
    				$("#register-password").removeClass("form-control is-invalid")
    				$("#register-password").addClass("form-control is-valid");
    				flagPas=true;
    			}
    		})
    		/*验证确认密码*/
    		$("#register-passwords").change(function(){
    			passWords=$("#register-passwords").val();
    			if((passWord!=passWords)||(passWords.length<6||passWords.length>18)){
    				$("#register-passwords").removeClass("form-control is-valid")
    				$("#register-passwords").addClass("form-control is-invalid");
    				flagPass=false;
    			}else{
    				$("#register-passwords").removeClass("form-control is-invalid")
    				$("#register-passwords").addClass("form-control is-valid");
    				flagPass=true;
    			}
    		})
    		
    		$("#regbtn").click(function(){
    			if(flagName&&flagPas&&flagPass){
    				localStorage.setItem("name",name);
    				localStorage.setItem("passWord",passWord);
    				// location="login.html"
            $.post('doRegister',{'name':name,'psw':passWord,'_token':"{{ csrf_token() }}"},function(res){
              //为避免layui与bootstrap冲突
              layui.use('layer', function(){
                var layer = layui.layer;
                if(res.code>0){
                  layer.msg(res.msg,{icon:1,time:1500},function(){
                    location="login";//跳转到login页面
                  })
                  }else{
                  layer.msg(res.msg,{icon:2,time:1500});
                  }
              });
              
            })
    			}else{
    				if(!flagName){
    					$("#register-username").addClass("form-control is-invalid");
    				}
    				if(!flagPas){
    					$("#register-password").addClass("form-control is-invalid");
    				}
    				if(!flagPass){
    					$("#register-passwords").addClass("form-control is-invalid");
    				}
    			}
    		})
    	})
    </script>
  </body>
</html>