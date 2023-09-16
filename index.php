<!DOCTYPE html>
<html lang="en">

<head>
    <?php require "assets/head.php"; ?>
    <title>Uvod</title>
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
                    <a href="./admin/students.php">Seznam žáků</a>
                </div>


                <div class="controls-container">
                    <button class="play-icon" onclick="toggleAudio()">
                        <i class="fa-solid fa-volume-off"></i>
                    </button>

                    <input type="range" id="volumeSlider" min="0" max="1" step="0.1" value="1"
                        onchange="changeVolume()">

                </div>
            </div>




        </section>
    </main>


    <?php require "assets/footer.php"; ?>

    <script src="./js/header.js"></script>




</body>

</html>