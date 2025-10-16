<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <div class="container">
        <h1>Dies de la Setmana</h1>
        <div class="dias">
            <?php
            $setmana = ['dilluns', 'dimarts', 'dimecres', 'dijous', 'divendres', 'dissabte', 'diumenge'];
            echo $setmana[1] . '<br />';
            if (isset($setmana[10])) {
                echo $setmana[10] . '<br />';
            } else {
                echo '<span class="error">No existeix el dia 10</span><br />';
            }
            $setmana[10] = 'ANewDay';
            foreach ($setmana as $dia) {
                echo $dia . '<br />';
            }
            $macedonia = ['cadena de text', 1, array(123, 'prova'), true];
            $cotxe = array('marca' => 'audi', 'model' => 'A3', 'matricula' => '1111BBB', 'any' => 2004);
            echo '<hr><b>Cotxe:</b> ' . $cotxe['marca'] . ' ' . $cotxe['model'];
            $cotxe = array(
                array('audi', 2004),
                array('opel', 2010),
                array('ford', 2017)
            );

            echo $cotxe[0][1];


            count($cotxe);
            echo count($cotxe) - 1;

            $variable = 9;
            echo '<hr><b>Variable:</b> ' . $variable;
            echo '<br>++v = ' . ++$variable;
            echo '<br>v++ = ' . $variable++;

            echo '<hr>';
            $edat = 18;
            $edat = (isset($edat)) ? $edat : 'El usuari no ha establert la seva edat';
            echo 'Edat: ' . $edat;

            echo '<hr>';
            // if (isset($_GET['nom'])) {
            //     $nom = $_GET['nom'];
            // } else {
            //     $nom = 'Anònim';
            // }
            // echo $nom;
            
            $nom = isset($_GET['nom']) ? $_GET['nom'] : 'Anònim';

            $nom = 'Arnau';
            echo $nom = $nom ?? 'Anònim';

            echo '<hr>';
            for ($i = 0; $i <= 100; $i = $i + 5) {
                echo $i . " - ";
                if ($i == 100) {
                    echo $i;
                }
            }
            echo '<hr>';
            $mesos = array(
                'Gener',
                'Febrer',
                'Març',
                'Abril',
                'Maig',
                'Juny',
                'Juliol',
                'Agost',
                'Setembre',
                'Octubre',
                'Novembre',
                'Desembre'
            );
            for ($i = 0; $i < count($mesos); $i++) {
                echo $mesos[$i] . ' - ';
                if ($i == 100) {
                    echo $i;
                }
            }

            echo '<hr>';
            $num = 10;
            $num2 = '8';
            $vector = array('Audi', 'Chevrolet', 'Seat');
            $vector_associatiu = array('Marca' => 'Seat', 'Model' => 'Ateca');
            $boolea = true;
            var_dump($num);
            var_dump($num2);
            var_dump($vector);
            var_dump($vector_associatiu);
            echo "<pre>";
            var_dump($vector);
            echo "</pre>";
            var_dump($bolea);

            print_r($boolea);
            print_r($vector);

            echo "<hr>";
            function iniciCurs()
            {
                echo "Iniciem el curs!";
            }
            iniciCurs();

            echo "<hr>";
            function mostrar_temp($temperatura)
            {
                echo "hi ha " . $temperatura . " graus<br/>";
            }
            mostrar_temp('25');

            echo "<hr>";
            function sumar($numero1, $numero2)
            {
                $resultat = $numero1 + $numero2;
                echo $resultat;
            }

            sumar(10, 15);

            echo '<hr>';
            //una altra....
            function calcular_area_triangle($base, $altura)
            {
                $resultat = ($base * $altura) / 2;
                return $resultat;
            }
            $area_triangle = calcular_area_triangle(10, 10);
            echo 'El triangle te una area de ' . $area_triangle . ' metres quadrats';

            echo '<hr>';
            $text = '<br>Hola Eric & ""';
            echo htmlspecialchars($text);
            echo '<br>Hola Eric & ""';
            echo trim($text);
            echo strlen($text);
            echo substr($text, 0, 4);
            echo 'Lletra o en la posicio: ' . strpos($text, 'o');
            echo strtoupper($text);
            echo strtolower($text);

            echo '<hr>';

            // echo '../carpeta/nom imatge.jpg';
            
            // echo '"../carpeta/nom"';
            
            echo str_replace(' ', '%20', '../carpeta/nom imatge.jpg');

            echo '<hr>';
            $cotxe = array('marca' => 'audi', 'model' => 'A3', 'matricula' => '1111BBB', 'any' => 2004);
            extract($cotxe);
            echo $marca . ' ' . $model;

            echo '<hr>';
            $mesos = array(
                'Gener',
                'Febrer',
                'Març',
                'Abril',
                'Maig',
                'Juny',
                'Juliol',
                'Agost',
                'Setembre',
                'Octubre',
                'Novembre',
                'Desembre'
            );
            array_pop($mesos);
            foreach ($mesos as $mes) {
                echo $mes . '-';
            }

            echo join('-', $mesos);

            echo '<hr>';
            echo join('-', $mesos);

            count($mesos);
            sort($mesos);
            rsort($mesos);

            echo '<hr>';
            $mesos_invertits = array_reverse($mesos);
            foreach ($mesos_invertits as $mes) {
                echo $mes . '-';
            }

            echo '<hr>';

            $numero = 5;
            //que passaria?
            function mostrarNumero()
            {
                $numero = 10;
            }
            mostrarNumero();
            echo $numero;

            echo '<br>';
            //forma OK
            function mostrarNumero2()
            {
                $numero = 10;
                return $numero;
            }
            echo mostrarNumero2();
            ?>
        </div>
    </div>
</body>

</html>