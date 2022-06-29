<!doctype html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
  <title>SUCCESS</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="/bootstrap-3.4.1-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <div id="applyFor" style="text-align: center; width: 500px; margin: 100px auto;">
    {{ $message }},将在<span class="loginTime" style="color: red">{{ $jump_time }}</span>秒后跳转
    </div>
  <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
  <script src="/js/jquery-3.5.1/jquery-3.5.1.min.js"></script>
  <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
  <script src="/bootstrap-3.4.1-dist/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    $(function(){
        var url = "{{$url}}";
        var loginTime = parseInt($('.loginTime').text());
        var time = setInterval(function(){
            loginTime = loginTime-1;
            $('.loginTime').text(loginTime);
            if(loginTime==0){
                clearInterval(time);
                window.location.href=url;
            }
        },1000);
    })
</script>
</body>
</html>