<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>User names stored in DB</h1>
<ul>
    <form method="post" action="/bla">
        <input type="email" name="email" id="email">
        <input type="submit" value="enter">
        {{-- add CSRF protection https://stackoverflow.com/a/31683058 --}}
    </form>
    @foreach ($users as $user)
        <li>{{ $user->username }}</li>
    @endforeach
</ul>
</body>
</html>