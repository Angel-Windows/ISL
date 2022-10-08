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
<form method="POST" action="{{ route('login') }}">
@csrf

<!-- Email Address -->

    <input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
           autofocus/>
    <input id="password" class="block mt-1 w-full"
           type="password"
           name="password"
           required autocomplete="current-password"/>


    <!-- Remember Me -->

    <button class="ml-3">Log in</button>

</form>
</body>
</html>
