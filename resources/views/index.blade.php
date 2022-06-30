<!doctype html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
  <title>{{ $carnival_title }}-首页</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="/bootstrap-3.4.1-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/app.css">
</head>
<body>
  <div class="header">
    <div class="body">
      <div class="col-md-6 user-name">欢迎您&nbsp;&nbsp;&nbsp;{{$user['name']}}</div>
      <div class="col-md-6 logout"><a href="user/logout">注销</a></div>
    </div>
  </div>
  <div class="row body">
    <div class="body">
        <div class="">
          <div class="row" style="line-height: 100px;">
            <div class="col-md-6" style="line-height: 100px;font-size: 30px;font-weight: 550">{{ $carnival_title }}-预约列表</div>
            <div class="col-md-6" style="text-align:right;">
              <a type="submit" class="btn btn-primary" href="/user-carnival/add">新建预约</a>
            </div>
          </div>
          <div>
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>预约日期</th>
                  <th>要求码</th>
                  <th>状态</th>
                  <th>签到时间</th>
                  <th>创建时间</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($list as $li)
                  <tr>
                    <td>{{$li['id']}}</td>
                    <td>{{$li['date']}}</td>
                    <td>{{$li['code']}}</td>
                    <td>
                      <span class="label @if ($li['status'] == 1) label-success @else label-primary @endif">
                      @if ($li['status'] == 1) 已签到 @else 待签到 @endif</span>
                    </td>
                    <td>{{$li['updated_at']}}</td>
                    <td>{{$li['created_at']}}</td>
                    <td>@if ($li['status'] == 0) <a href="/user-carnival/delete?id={{$li['id']}}">取消</a> @endif</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
    </div>
  </div>
  <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
  <script src="/js/jquery-3.5.1/jquery-3.5.1.min.js"></script>
  <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
  <script src="/bootstrap-3.4.1-dist/js/bootstrap.min.js"></script>
</body>
</html>