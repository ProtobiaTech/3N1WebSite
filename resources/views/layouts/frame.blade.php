<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" contents="dev4living.com">
    <title>{{ $content->title }} - {{ $siteName }}</title>
</head>
<frameset rows="40px, 95%">
    <frame src="/frame-header" scrolling="no" frameborder="0"></frame>
    <frame src="{{ $content->href }}" frameborder="0"></frame>
</frameset>
</html>
