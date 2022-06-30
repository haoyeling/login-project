<!doctype html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
  <title>{{ $carnival_title }}-注册</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="/bootstrap-3.4.1-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/app.css">
</head>
<body>
  <div class="header">
    <div class="body"></div>
  </div>
  <div class="row body">
    <div class="box">
        <div class="">
          <h2 style="margin-top:50px">{{ $carnival_title }}-签到</h2>
          @if ($errors->any())
              <div class="alert alert-danger" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif

          <form style="margin-top:50px" method="POST" action="/user-carnival/update">
            @csrf
            <div class="form-group">
              <label for="exampleInputEmail1">邀请码</label>
              <input type="text" class="form-control" name="code" value="{{ old('code') }}" placeholder="code">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">密码</label>
              <input type="password" class="form-control" name="password" value="" placeholder="password">
            </div>
            <button type="submit" class="btn btn-primary">签&nbsp;&nbsp;到</button>
          </form>

            </div>
    </div>
  </div>
  <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
  <script src="/js/jquery-3.5.1/jquery-3.5.1.min.js"></script>
  <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
  <script src="/bootstrap-3.4.1-dist/js/bootstrap.min.js"></script>
</body>
</html>