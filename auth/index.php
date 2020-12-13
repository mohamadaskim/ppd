<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.min.css" integrity="sha256-2YQRJMXD7pIAPHiXr0s+vlRWA7GYJEK0ARns7k2sbHY=" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">
    <title>Log Masuk PPD Kluang</title>
</head>
<body>
    <form class="wrapper" action="proc.php" method="POST">
        <div class="kad shadow">
            <div class="logo-main"><div class="wrapper-logo"><img src="img/logoppd.png" alt="Synergy In Action"></div></div>
            <div class="inputbox">
                <label for="pengguna">Nama Pengguna</label>
                <input class="u-full-width" type="text" id="pengguna" name="pengguna">
                <label for="password">Kata Laluan</label>
                <input class="u-full-width" type="password" id="password" name="password">
                <div class="check">
                    <input type="checkbox" name="ingat" value="1" class="nomargin scaleup">&ensp;Ingat Saya
                </div>
                <div class="tengah butang">
                    <button type="submit" name="login" class="button-primary myradius-button">LOG MASUK</button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>