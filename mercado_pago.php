<?php

require 'vendor/autoload.php';

MercadoPago\SDK::setAccessToken('APP_USR-3266153888801856-110616-779c897f38d32005ff0fe18286309a96-526639783');

$preference = new MercadoPago\Preference();

$item = new MercadoPago\Item();
$item->id ='0001';
$item->title= 'SportMaps';
$item->quantity = 1;
$item->unit_price = 150.00;
$item->currency_id = "CLP";


$preference->items= array($item);



$preference->save();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    
    <script src="https://sdk.mercadopago.com/js/v2"></script>

</head>
<body>
    <h3>Mercado Pago</h3>
    <div class="checkout-btn"></div>

    <script>
        const mp =new MercadoPago('APP_USR-9545fb7d-408f-4d69-932e-dcf43beb6e9c',{
            locale: 'es-CL'
        });

        mp.checkout({
            preference:{
                id:'<?php echo $preference->id; ?>'
            },
            render: {
                container: '.checkout-btn',
                label: 'Pagar con MP'
            }
        })
         

    </script>
</body>
</html>