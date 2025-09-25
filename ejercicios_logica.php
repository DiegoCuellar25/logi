<?php
// ejercicios_responsive.php

// Funciones de los ejercicios
function listaInvertida($array) {
    return array_reverse($array);
}

function sumaPares($array) {
    $suma = 0;
    foreach ($array as $num) {
        if ($num % 2 == 0) {
            $suma += $num;
        }
    }
    return $suma;
}

function frecuenciaCaracteres($cadena) {
    $frecuencia = [];
    $chars = str_split($cadena);
    foreach ($chars as $char) {
        if (isset($frecuencia[$char])) {
            $frecuencia[$char]++;
        } else {
            $frecuencia[$char] = 1;
        }
    }
    return $frecuencia;
}

function piramide($filas) {
    $resultado = "";
    for ($i = 1; $i <= $filas; $i++) {
        $resultado .= str_repeat("&nbsp;", $filas - $i);
        $resultado .= str_repeat("*", 2 * $i - 1) . "<br>";
    }
    return $resultado;
}

// Procesar formularios
$resultado = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $opcion = $_POST["opcion"];

    switch ($opcion) {
        case "1":
            $numeros = explode(",", $_POST["lista"]);
            $resultado = "Lista invertida: " . implode(", ", listaInvertida($numeros));
            break;

        case "2":
            $numeros = explode(",", $_POST["lista"]);
            $resultado = "La suma de los números pares es: " . sumaPares($numeros);
            break;

        case "3":
            $cadena = $_POST["cadena"];
            $frecuencia = frecuenciaCaracteres($cadena);
            $resultado = "Frecuencia de caracteres:<br>";
            foreach ($frecuencia as $char => $count) {
                $resultado .= htmlspecialchars($char) . " → " . $count . "<br>";
            }
            break;

        case "4":
            $filas = intval($_POST["filas"]);
            $resultado = "Pirámide:<br>" . piramide($filas);
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicios de Lógica en PHP</title>
    <style>
        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f6f9;
            display: flex;
            flex-direction: row;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background: #0066cc;
            color: white;
            padding: 20px;
            box-shadow: 2px 0 10px rgba(0,0,0,0.2);
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .sidebar button {
            width: 100%;
            background: #005bb5;
            color: white;
            border: none;
            padding: 12px;
            margin: 10px 0;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }
        .sidebar button:hover {
            background: #004999;
        }
        .content {
            flex-grow: 1;
            padding: 30px;
        }
        h1 {
            color: #333;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        input[type="text"], input[type="number"] {
            padding: 8px;
            width: 80%;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        input[type="submit"] {
            background: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 6px;
            transition: background 0.3s;
        }
        input[type="submit"]:hover {
            background: #218838;
        }
        .resultado {
            background: #e6f7ff;
            padding: 15px;
            border-left: 5px solid #0066cc;
            border-radius: 6px;
            margin-top: 20px;
        }
        .hidden {
            display: none;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                height: auto;
                display: flex;
                flex-direction: row;
                justify-content: space-around;
                box-shadow: none;
                position: sticky;
                top: 0;
                z-index: 10;
            }
            .sidebar h2 {
                display: none;
            }
            .sidebar button {
                margin: 5px;
                flex-grow: 1;
                font-size: 14px;
                padding: 10px;
            }
            .content {
                margin: 0;
                padding: 15px;
            }
        }
    </style>
    <script>
        function mostrarFormulario(opcion) {
            let forms = document.querySelectorAll(".form-ejercicio");
            forms.forEach(f => f.classList.add("hidden"));
            document.getElementById("form" + opcion).classList.remove("hidden");
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    </script>
</head>
<body>
    <div class="sidebar">
        <h2>Menú</h2>
        <button onclick="mostrarFormulario(1)">Lista Invertida</button>
        <button onclick="mostrarFormulario(2)">Suma de Pares</button>
        <button onclick="mostrarFormulario(3)">Frecuencia</button>
        <button onclick="mostrarFormulario(4)">Pirámide</button>
    </div>

    <div class="content">
        <h1>Ejercicios de Lógica en PHP</h1>

        <!-- Ejercicio 1 -->
        <form method="post" id="form1" class="form-ejercicio hidden">
            <input type="hidden" name="opcion" value="1">
            <h3>Ejercicio 1: Lista Invertida</h3>
            <label>Ingrese una lista de números separados por coma:</label><br>
            <input type="text" name="lista" required><br>
            <input type="submit" value="Ejecutar">
        </form>

        <!-- Ejercicio 2 -->
        <form method="post" id="form2" class="form-ejercicio hidden">
            <input type="hidden" name="opcion" value="2">
            <h3>Ejercicio 2: Suma de Pares</h3>
            <label>Ingrese una lista de números separados por coma:</label><br>
            <input type="text" name="lista" required><br>
            <input type="submit" value="Ejecutar">
        </form>

        <!-- Ejercicio 3 -->
        <form method="post" id="form3" class="form-ejercicio hidden">
            <input type="hidden" name="opcion" value="3">
            <h3>Ejercicio 3: Frecuencia de Caracteres</h3>
            <label>Ingrese una cadena de texto:</label><br>
            <input type="text" name="cadena" required><br>
            <input type="submit" value="Ejecutar">
        </form>

        <!-- Ejercicio 4 -->
        <form method="post" id="form4" class="form-ejercicio hidden">
            <input type="hidden" name="opcion" value="4">
            <h3>Ejercicio 4: Pirámide</h3>
            <label>Ingrese el número de filas:</label><br>
            <input type="number" name="filas" min="1" required><br>
            <input type="submit" value="Generar">
        </form>

        <?php if (!empty($resultado)): ?>
            <div class="resultado">
                <h3>Resultado:</h3>
                <p><?php echo $resultado; ?></p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
