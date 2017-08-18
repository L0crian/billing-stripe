<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <script>
        var Laracasts = {
            'csrfToken': "{{csrf_token()}}",
            'stripeKey': "{{config('services.stripe.key')}}"
        }
    </script>
</head>

<body>
<div id="app">
<h1>Buy</h1>
<checkout-form :products = "{{$products}}"></checkout-form>
</div>
<script src="https://checkout.stripe.com/checkout.js"></script>
<script src="/js/app.js"></script>
</body>
</html>
