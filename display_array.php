<!DOCTYPE html>
<html>
<?php error_reporting(E_ALL); ini_set('display_errors', '1'); ?>
<head>
    <title>Tableau avec Commandes Bash</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function runBashScript(buttonId) {
            $.ajax({
                url: 'run_script.php', // Chemin vers votre script PHP intermédiaire
                type: 'POST',
                data: { buttonId: buttonId },
                success: function(response) {
				$('#' + buttonId).closest('tr').find('.bashResult').html(response);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    </script>
</head>
<body>
    <table border="1">
        <tr>
            <th>Champ 1</th>
            <th>Champ 3</th>
            <th>Action</th>
        </tr>
        <?php
        $file = fopen('agents.txt', 'r');
        while (($line = fgets($file)) !== false) {
            $fields = explode(' ', $line);
            echo '<tr>';
            echo '<td>' . $fields[0] . '</td>';
            echo '<td>' . $fields[2] . '</td>';
            $rowButtonId = 'button_' . uniqid(); // Génère un ID unique pour chaque bouton
            echo '<td><button id="' . $rowButtonId . '" onclick="runBashScript(\'' . $rowButtonId . '\')">Exécuter</button>';
            echo '<div class="bashResult" id="result' . $rowButtonId . '"></div></td>';
            echo '</tr>';
        }
        fclose($file);
        ?>
    </table>
</body>
</html>
