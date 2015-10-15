<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" contents="dev4living.com">
    <style>
        body {
            font-family: sans-serif;
            background-color: #555;
            color: #ddd;
            height: 40px;
            text-align: center;
        }

        a {
            color: #ddd;
            text-decoration: none;
        }
        a:hover {
            color: #fff;
        }
    </style>
</head>
<body>
    <script>
    function assign(url) {
        window.top.location.assign(url);
    }

    function back() {

    }
    </script>
    <span style="font-size:20px"><a href="#" onclick="assign('/')">{{ $siteName }}</a></span> &nbsp;

    &nbsp;
    <a href="#" onclick="window.history.go(-2)">{{ trans('app.Back') }}</a>
</body>
</html>
