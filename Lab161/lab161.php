<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorio 16.1</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>
    <h1>CONTSULTA DE SERVICIO WEB DE CONVERSIÓN DE TEMPERATURA</h1>
    <form name="FormConv" method="post" action="lab161.php">
        <br/>
        CONVERTIR DESDE <select NAME="temp">
            <option value="CtoF" selected> °C a °F
            <option value="FtoC"> °F a °C
        </select> el valor 
    <input type="number" name="valor" step="Any" required>
    <input name="Convertir" value="Convertir" type="submit" />
    </form> 
    <?php
    $servicio = "https://www.w3schools.com/xml/tempconvert.asmx?wsdl";
    $parametros= array();
    if(array_key_exists('Convertir', $_POST))
    {
        $valor = $_POST['valor'];
        $temp = $_POST['temp'];

        if($temp=="CtoF")
        {
            $parametros['Celsius']= $valor;
            $cliente = New SoapClient($servicio, $parametros);
            $resultObj = $cliente->CelsiusToFahrenheit($parametros);
            $resultado = $resultObj->CelsiusToFahrenheitResult;
        }
        else
        {
            $parametros['Fahrenheit']= $valor;
            $cliente = New SoapClient($servicio, $parametros);
            $resultObj = $cliente->FahrenheitToCelsius($parametros);
            $resultObj = $cliente->FahrenheitToCelsiusResult;
        }

        print("<br> La temperatura $valor" . substr($temp,0,1) . " es igual a:  $resultado".substr($temp,3,1));
    }
    ?>
</body>
</html>