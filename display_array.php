<!DOCTYPE html>
<html>
<?php error_reporting(E_ALL); ini_set('display_errors', '1'); ?>
<head>
    <title>Tableau avec Commandes Bash</title>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
