<?php
require 'C:\xampp\htdocs\ACTIVITAT-DE-COHESIO\vendor\setasign\fpdf\fpdf.php';

try {
    // Conexión a la base de datos
    $db = new PDO('mysql:host=localhost;dbname=projecte2', 'root', '');
    $db->exec("set names utf8"); // Configurar la codificación de caracteres a UTF-8

    // Recuperar todos los grupos y sus puntuaciones
    $query = $db->query("SELECT nom, foto, puntuacio FROM grup ORDER BY puntuacio DESC");

    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    if (empty($result)) {
        echo "No se encontraron grupos.";
    } else {
        // Calcular las posiciones de los grupos
        $posiciones = array();
        $posicionActual = 1;
        $puntuacionAnterior = null;
        foreach ($result as $index => $row) {
            if ($puntuacionAnterior !== null && $row['puntuacio'] < $puntuacionAnterior) {
                $posicionActual = $index + 1;
            }
            $posiciones[$row['nom']] = $posicionActual;
            $puntuacionAnterior = $row['puntuacio'];
        }

        foreach($result as $row) {
            echo "Procesando el grupo: " . $row['nom'] . "\n";

            $pdf = new FPDF('L'); // Cambiar la orientación a horizontal
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 24); // Cambiar la fuente a Arial y el tamaño a 24

            // Añadir el nombre del grupo
            $pdf->SetFillColor(200, 220, 255); // Cambiar el color de fondo a un azul claro
            $pdf->SetTextColor(0, 0, 0); // Cambiar el color del texto a negro
            $pdf->Cell(0, 10, utf8_decode($row['nom']), 0, 1, 'C', true);

            // Añadir un mensaje de agradecimiento
            $pdf->SetTextColor(0, 0, 0); // Cambiar el color del texto a negro
            $pdf->Cell(0, 10, utf8_decode('Moltes gràcies per participar!'), 0, 1, 'C');

            // Añadir la foto
            $fotoPath = '../../Recursos/IMG/' . $row['foto'];
            if (file_exists($fotoPath)) {
                list($width, $height) = getimagesize($fotoPath);
                $scale = 0.75; // Reducir la imagen en un 25%
                $width *= $scale;
                $height *= $scale;
                $x = ($pdf->GetPageWidth() - $width) / 2;
                $y = ($pdf->GetPageHeight() - $height) / 2;
                $pdf->Image($fotoPath, $x, $y, $width, $height);
            } else {
                echo "El archivo de imagen no existe: " . $fotoPath . "\n";
            }

            // Añadir la puntuación del grupo
            $pdf->Cell(0, 10, utf8_decode('Puntuació total del grup: ' . $row['puntuacio']), 0, 1, 'C');

            // Añadir la posición del grupo
            $pdf->Cell(0, 10, utf8_decode('Posició global a la jornada de cohesió: ' . $posiciones[$row['nom']]), 0, 1, 'C');

            // Guardar el PDF
            $pdf->Output('F', '../../Recursos/Diplomes/' . $row['nom'] . '.pdf');
        }
    }
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>