<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../style/style_Fin.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>inscription</title>
</head>

<body>
    <div class="div_Fin">
        <div class="container label">
            <blockquote class="quote small-container">
                <span class="bam">BRAVO</span>
                <span class="pow">PSEUDOZ</span>
            </blockquote>
            <div class="div_info_fin">
                <h1>Niveau : Débutant</h1>
                <h1>Temps : 12 min</h1>
                <h1>Score : 3254</h1>
            </div>
            <div class="div_btn_fin">
                <a href="#">
                    <div class="btn">
                        Rejouer
                    </div>
                </a>
                <img src="../../img/coupe.png" alt="">
                <a href="../../index.php">
                    <div class="btn">
                        Accueil
                    </div>
                </a>
            </div>
        </div>
    </div>
    <script>
        const body = document.querySelector("body");
        const quote = document.querySelector(".quote");

        fitForContainer();
        window.addEventListener("resize", () => {
            fitForContainer();
        });

        function fitForContainer() {
            if (body.offsetHeight > 600 && body.offsetWidth > 600) {
                quote.classList.remove('small-container');
            } else {
                quote.classList.add("small-container");
            }
        }

    </script>
</body>

</html>