<?php
require 'C:\xampp\htdocs\ACTIVITAT-DE-COHESIO\vendor\setasign\fpdf\fpdf.php';

try {
    $db = new PDO('mysql:host=localhost;dbname=projecte2', 'root', '');
    $db->exec("set names utf8"); 

    $query = $db->query("SELECT nom, foto, puntuacio FROM grup ORDER BY puntuacio DESC");

    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    if (empty($result)) {
        echo "No se encontraron grupos.";
    } else {
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

            $pdf = new FPDF('L');
            $pdf->AddPage();
            $pdf->SetFont('Courier', 'B', 24);

            $pdf->SetFillColor(200, 220, 255);
            $pdf->SetTextColor(0, 0, 0); 
            $pdf->Cell(0, 10, utf8_decode($row['nom']), 0, 1, 'C', true);

            $pdf->SetTextColor(0, 0, 0); 
            $pdf->Cell(0, 10, utf8_decode('Moltes gràcies per participar!'), 0, 1, 'C');

            $pdf->Cell(0, 10, utf8_decode('Puntuació total del grup: ' . $row['puntuacio']), 0, 1, 'C');

            $pdf->Cell(0, 10, utf8_decode('Posició global a la jornada de cohesió: ' . $posiciones[$row['nom']]), 0, 1, 'C');

            $fotoPath = '../../Recursos/IMG/' . $row['foto'];
            if (file_exists($fotoPath)) {
                $x = ($pdf->GetPageWidth() - 200) / 2;
                $y = ($pdf->GetPageHeight() - 100) / 2;
                $pdf->Image($fotoPath, $x, $y, 200, 100);
            } else {
                echo "El archivo de imagen no existe: " . $fotoPath . "\n";
            }

            $pdf->Output('F', '../../Recursos/Diplomes/' . $row['nom'] . '.pdf');
        }
    }
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>