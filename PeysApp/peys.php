<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peys App</title>
</head>

<body>

    <h1>Peys App</h1>

    <?php
        $size = $_POST['size'] ?? 60; 
        $borderColor = $_POST['borderColor'] ?? '#000000';

        $canvasWidth = (int)$size;
        $canvasHeight = (int)$size;
    ?>

    <form id="settingsForm" method="post">
        <label for="sizeSlider">Select Photo Size:</label>
        <input type="range" id="sizeSlider" name="size" min="10" max="100" value="<?= $size; ?>" step="10" oninput="this.nextElementSibling.value = this.value">
        <output><?= $size; ?></output>
        
        <br><br>

        <label for="borderColor">Select Border Color:</label>
        <input type="color" id="borderColor" name="borderColor" value="<?= $borderColor; ?>">
        
        <br><br>

        <button type="submit" name="submit">Process</button>
        <br><br>

        <div style="border:3px solid <?= $borderColor; ?>; width: <?= $canvasWidth; ?>px; height: <?= $canvasHeight; ?>px; overflow:hidden;">
            <img src="images/kakashi.jpg" alt="Image for Canvas" width="<?= $canvasWidth; ?>" height="<?= $canvasHeight; ?>">
        </div>
    </form>

</body>
</html>
