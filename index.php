<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cars</title>
</head>
<body>
    <h1>Makers</h1>
    <form>
        <select name ="makersDropdown" id = "makersDropdown">
            <?php
            require_once('MakerDbTools');
            $makerDbTool = new MakerDbTools();
            ?>
    </from>
</body>
</html>