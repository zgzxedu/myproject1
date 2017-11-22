<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--<script src="{{asset('/js/jquery-1.12.min.js')}}"></script>--}}
    {{--<script src="{{asset('/js/jquery-form.js')}}"></script>--}}
    {{--<link rel="stylesheet" href="/css/bootstrap.min.css">--}}
    {{--<script src="/js/bootstrap.min.js"></script>--}}
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <link rel="stylesheet" href="/css/ch-ui.admin.css">
    <link rel="stylesheet" href="/font/css/font-awesome.min.css">
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/ch-ui.admin.js"></script>

    <title>@yield("title","后台管理")</title>
</head>
<body>

 {{--头部--}}
 @include("admin.header")

 {{--左边导航--}}
 @include("admin.nav")
        <!--主体部分 开始-->
         <div class="main_box">
             @yield("main")
         </div>
        <!--主体部分 结束-->

 {{--尾部--}}
 @include("admin.footer")
 @section("jsbottom")
</body>
</html>
