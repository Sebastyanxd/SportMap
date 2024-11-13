<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PayPal</title>
    <!-- Initialize the JS-SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id=ARciEmKX5kGt4DHt3G_1jLQS8f_RQxt6QPgGt5E16nx3zTybo5Dh52T3_hAqN1t5pHRNeCmoupSk-vUB&currency=EUR"></script>
</head>
<body>
    <div id="paypal-button-container"></div>
    <script>
        paypal.Buttons({
            style :{
                    color:'blue',
                    shape: 'pill',
                    label: 'pay'
            },
            createOrder: function(data, actions){
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value:20.000
                        }
                    }]
                });  
            },

            onApprove: function(data,actions){
                actions.order.capture().then(function (detalles){
                    console.log(detalles);
                });
            },
            onCancel: function(data) {
                alert("Pago Cancelado");
                console.log(data);
            }
        }).render('#paypal-button-container');
    </script>
</body>
</html>
