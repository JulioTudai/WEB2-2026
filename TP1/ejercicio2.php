<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 2 - Arreglos</title>
</head>
<body>
    
    <h1>Generacion de listas desde PHP</h1>
    <?php
    //1 arreglo indexado lista de materias
    $materias = ["Web 2", "Base de Datos", "Ingeniería de Software", "Redes"];
    ?>
    <h2>Lista de materias (Arreglo indexado)</h2>
    <ol>
        <?php
        //recorremos cada elemnto del arreglo y la variable $materia toma cada valor 
        foreach($materias as $materia){
            echo "<li>".$materia."</li>";
        }

        ?>
    </ol>

    <hr>

    <?php
    //arreglo asociativo se definen pares clave valor
    $usuario =[
            "Nombre" => "Julio",
            "Apellido" => "Tudai",
            "Edad" => 25,
            "Email" => "julio@mail.com"
        ];
    ?>

    <h2>datos del usuario del arreglo asosiativo</h2>
    <ul>
        <?php
        //En los asociativos le podemos decir a foreach que recorra por clave valor
        foreach($usuario as $clave => $valor){
            echo "<li><strong>".$clave .":</strong> " . $valor . "</li>";
        }
        ?>
    </ul>

</body>
</html>


