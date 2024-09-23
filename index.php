<!DOCTYPE html>
<html>
<head>
    <title>Inventario de Productos</title>
    <style>
        /* Fondo de pantalla */
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-family: Arial, sans-serif;
            background-image: url('paisajev1.png'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh; 
            margin: 0;
            padding: 20px;
        }

        /* Estilo para el formulario */
        form {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        form label {
            display: block;
            margin: 10px 0 5px;
        }

        form input {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        form button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        form button:hover {
            background-color: #0056b3;
        }

        /* Estilo para la tabla */
        table {
            border-collapse: collapse;
            width: 80%;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        a {
            color: red;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Estilo para las filas alternas */
        .row-purple {
            background-color: #D8BFD8; /* Morado claro */
        }

        .row-pink {
            background-color: #FFC0CB; /* Rosa claro */
        }

        /* Estilo para el mensaje */
        .msg-box {
            padding: 10px;
            border-radius: 5px;
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            display: none;
            width: 300px;
            text-align: center;
            font-family: Arial, sans-serif;
        }

        .msg-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .msg-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
    <script>
        // Mostrar el mensaje y redirigir
        window.onload = function() {
            const msgBox = document.getElementById('msg-box');
            if (msgBox) {
                msgBox.style.display = 'block';
                setTimeout(() => {
                    msgBox.style.display = 'none';
                    window.location.href = 'index.php'; // Redirige 
                }, 5000); //
            }
        }
    </script>
</head>
<body>

    <h1>Inventario de Productos</h1>

    <form action="insertar.php" method="POST">
        <label for="idProd">idProducto:</label>
        <input type="text" name="idProd" required>

        <label for="nombre">Nombre del Producto:</label>
        <input type="text" name="nombre" required>

        <label for="precio">Precio:</label>
        <input type="text" name="precio" required>

        <label for="existencia">Existencia:</label>
        <input type="text" name="existencia" required>

        <button type="submit">Registrar</button>
    </form>

    <h2>Lista de Productos</h2>

    <table border="1">
        <tr>
            <th>idProducto</th>
            <th>Nombre de Producto</th>
            <th>Precio</th>
            <th>Existencia</th>
            <th>Accion</th>
        </tr>

        <?php
        include 'conexion.php'; // Conexion a la BD

        $result = $conexion->query("SELECT * FROM productos");

        if ($result->num_rows > 0) {
            $row_number = 0; // Contador de filas para alternar colores
            while($row = $result->fetch_assoc()) {
                $row_class = ($row_number % 2 == 0) ? 'row-purple' : 'row-pink'; // Alternar clases
                echo "<tr class='$row_class'>";
                echo "<td>{$row['idProd']}</td>";
                echo "<td>{$row['nombre']}</td>";
                echo "<td>\${$row['precio']}</td>";
                echo "<td>{$row['existencia']}</td>";
                echo "<td><a href='eliminar.php?idProd={$row['idProd']}'>Eliminar</a></td>";
                echo "</tr>";
                $row_number++;
            }
        } else {
            echo "<tr><td colspan='5'>No hay productos registrados.</td></tr>";
        }

        $conexion->close();
        ?>
    </table>

    <?php
    // Mostrar mensaje si existe
    if (isset($_GET['msg']) && isset($_GET['status'])) {
        $msg = htmlspecialchars($_GET['msg']);
        $status = $_GET['status'] == 'success' ? 'msg-success' : 'msg-error';
        echo "<div id='msg-box' class='msg-box $status'>$msg</div>";
    }
    ?>

</body>
</html>
