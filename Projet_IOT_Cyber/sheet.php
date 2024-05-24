<?php
include ("Include/ConfigFile.php");

if($_SESSION['isConnected']=true){
    $sheet_id = isset($_GET['sheet_id']) ? intval($_GET['sheet_id']) : 0;

    $pixels = [];
    if ($sheet_id) {
        $sql=("SELECT color, pos_x, pos_y, u.username FROM pixel p JOIN user u ON p.user_id = u.id WHERE p.sheet_id = ".$sheet_id);
        $result = mysqli_query($link, $sql);

        // Vérifier que $result est un objet mysqli_result
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $pixels[] = $row;
            }
        } else {
            echo "Erreur de récupération des pixels: " . mysqli_error($link);
        }

    }
}


?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Color Grid</title>
    <link rel="stylesheet" href="css/sheet.css">
    <script>
        // making the page refresh every 5 seconds
        setInterval(function() {
            window.location.reload();
        }, 5000); // 5000 millisecondes = 5 secondes
    </script>
</head>
<body>
    <div>
    <h1>Color Grid</h1>
        <div class="align">
            <button id="button-green" class="color-button" data-color="#00FF00"></button>
            <button id="button-blue" class="color-button" data-color="#0000FF"></button>
            <button id="button-red" class="color-button" data-color="#FF0000"></button>
            <button id="button-black" class="color-button" data-color="#000000"></button>
            <button id="button-yellow" class="color-button" data-color="#FFFF00"></button>
        </div>
        <div id="grid-container" style="display: grid; grid-template-columns: repeat(30, 20px); gap: 1px;">
            <?php
            // Affichage de la grille 30x30
            for ($i = 0; $i < 30; $i++) {
                for ($j = 0; $j < 30; $j++) {
                    $pos_x = $j;
                    $pos_y = $i;
                    $color = '';
                    $username = '';

                    // Rechercher si un pixel existe à cette position
                    foreach ($pixels as $pixel) {
                        if ($pixel['pos_x'] == $pos_x && $pixel['pos_y'] == $pos_y) {
                            $color = $pixel['color'];
                            $username = $pixel['username'];
                            break;
                        }
                    }

                    echo "<div class='grid-cell' data-pos-x='$pos_x' data-pos-y='$pos_y' data-username='$username' style='width: 20px; height: 20px; border: 1px solid #ccc; background-color: $color;'></div>";
                }
            }
            ?>
        </div>
        <div class="disconnected">
            
        <form id="disconnect" action="user.php" method="post">
            <input id="disconnect" type="submit" name="disconnected" value="Disconnect"> <!-- not working as planed -->
        </form>
        </div>
    </div>


    <script>

        let selectedColor = "";
        const sheetId = <?php echo $sheet_id; ?>;

        document.querySelectorAll('.color-button').forEach(button => {
            button.addEventListener('click', function() {
                selectedColor = this.getAttribute('data-color');
            });
        });

        document.querySelectorAll('.grid-cell').forEach(cell => {
            cell.addEventListener('click', function() {
                if (selectedColor) {
                    this.style.backgroundColor = selectedColor;
                    const posX = this.getAttribute('data-pos-x');
                    const posY = this.getAttribute('data-pos-y');
                    console.log(posX);
                    console.log(posY);

                    fetch('pixel_update.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            sheet_id: sheetId,
                            color: selectedColor,
                            pos_x: posX,
                            pos_y: posY
                        })
                    }).then((result) => {
                        result.text().then((txt) => {
                            console.log(txt);
                        })
                    });
                }
            });

            cell.addEventListener('mouseover', function() {
                console.log("on rentre dans la boucle");
                const username = this.getAttribute('data-username');
                console.log(username);

                if (username) {
                    console.log("on rentre dans la 2ème boucle");
                    console.log(username);
                    this.title = `Placed by : ${username}`;
                }
            });
        });
    </script>
</body>
</html>
