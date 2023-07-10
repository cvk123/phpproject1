<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/headermain.css">
    <link rel="stylesheet" href="./query/header-querymain.css">
    <link rel="stylesheet" href="./css/indexmain.css">
    <link rel="stylesheet" href="./css/footermain.css">
    <script src="https://kit.fontawesome.com/2e503376a7.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    
    <?php require "assets/header.php"; ?>
   

    <main>
    <section class="main-heading">
        <div class="video-background">
            
            <video autoplay loop muted class="back-video">
                <source src="./img/The Beauty Of Harry Potter (1).mp4" type="video/mp4">
            </video>  
            <audio id="myAudio" src="./img/Harry Potter theme.mp3" autoplay loop></audio>

            <div class="content">
                <h1>Škola čar a kouzel v Bradavicích</h1>
                <a href="./admin/zaci.php">Seznam žáků</a>
            </div>
            

        <div class="controls-container">
            <button class="play-icon" onclick="toggleAudio()">
                <i class="fa-solid fa-volume-off"></i>
            </button>

            <input type="range" id="volumeSlider" min="0" max="1" step="0.1" value="1" onchange="changeVolume()">
            
        </div>
        </div>
        
        

        
    </section>      
</main>


    <?php require "assets/footer.php"; ?>

    <script src="./js/header.js"></script>

    <div class="cursor">
        
    </div>

   
</body>
</html>