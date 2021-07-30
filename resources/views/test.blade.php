<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<div class="users">
    <div>

        {{$product->name}}
        {{$product->price}}
    </div>
</div>
<script src="{{ asset('js/app.js') }}" defer></script>
    
</body>
</html>
