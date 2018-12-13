<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DosenQU - Login</title>
</head>
<body>
    <form action="/doLogin" method="post" style="text-align: center">
        {{csrf_field()}}
        <input type="email" name="email" id="" placeholder="Username" ><br>
        <input type="password" name="password" placeholder="Password" ><br>
        <button type="submit">Log ON!</button>
        @if(Session::has('alert'))
            {{Session::get('alert')}}
        @endif
    </form>
</body>
</html>

