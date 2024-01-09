<?php

// Clave de API obtenida después de registrarte en Open Product Data
$apiKey = 'TU_CLAVE_DE_API';

$productName = "";
$brand = "";
// Puedes agregar más variables para otros datos del producto que quieras mostrar en los campos de entrada

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $barcode = $_POST['barcode'];

    // Realiza una solicitud a la API de Open Product Data
    $url = "https://world.openfoodfacts.org/api/v0/product/$barcode.json";

    $response = file_get_contents($url);

    if ($response !== false) {
        $data = json_decode($response, true);

        if (isset($data['product'])) {
            $product = $data['product'];

            $productName = $product['product_name'];
            $brand = $product['brands'];
            // Puedes agregar más asignaciones para otros datos del producto que quieras mostrar en los campos de entrada

        } else {
            echo "Producto no encontrado en la base de datos.";
        }
    } else {
        echo "Error al obtener información del producto.";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Lector de Códigos de Barras</title>
</head>

<body>
    <form method="POST">
        <label for="barcode">Código de Barras:</label>
        <input type="text" name="barcode" id="barcode" autofocus>
        <input type="submit" value="Buscar">
    </form>

    <br>

    <label for="product_name">Nombre del Producto:</label>
    <input type="text" id="product_name" name="product_name" value="<?php echo $productName; ?>" disabled>

    <br>

    <label for="brand">Marca:</label>
    <input type="text" id="brand" name="brand" value="<?php echo $brand; ?>" disabled>

    <!-- Agrega más campos de entrada aquí para otros datos del producto que quieras mostrar -->

</body>

</html>