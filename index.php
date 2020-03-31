<?php
    include_once "php/connect.php";

    if (isset($_GET['month'])) {
        $month = $_GET['month'];
        $sql_select = "SELECT * FROM tasks WHERE mesic = '$month' ORDER BY id DESC;";
    }
    else {
        $sql_select = "SELECT * FROM tasks ORDER BY done DESC, id DESC;";
    }

    $result = mysqli_query($conn, $sql_select);

?>

<!DOCTYPE html>
<html lang="cz">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="css/icon-font.css">
        <link rel="stylesheet" href="css/style.css">

        <script src="script/jquery-3.4.1.js"></script>
        
        <title>Udrzba</title>
    </head>

    <body>
        <header class="header">
            <!--<a href="index.php"><ion-icon class="icon-home" name="home-outline"></ion-icon></a> -->
            <div class="row">
                <div class="col-1-of-3">
                    <p>.</p>
                </div>

                <div class="col-1-of-3">
                    <div class="logo-spin__box">
                        <div class="logo-spin__page logo-spin__page-front">
                            <img class="logo-spin__img logo-spin__img-front" src="img/logo-header.png" alt=""> 
                        </div>

                        <div class="logo-spin__page logo-spin__page-back">
                            <a class="logo-spin__img logo-spin__img-back" href="index.php"><ion-icon class="icon-home" name="home"></ion-icon></a>
                        </div>
                    </div>
                </div>

                <div class="col-1-of-3">
                    <p>.</p>
                </div>
            </div>
        </header>

        <section class="info">
            <div class="info-box">
                <div class="info-box__content">
                    <p class="header-title">Úkoly pro údržbu</p>
                    <ion-icon class="icon-arrow-down" name="arrow-down-circle-outline"></ion-icon>
                </div>
            </div>
        </section>

        <section class="main">
            <div class="row u-mb-small">
                <div id="id-btn-add" class="btn btn__plus">
                    <a class="btn__add" href="#">
                        Pridat ukol
                        <ion-icon name="add-outline" class="icon-plus"></ion-icon>
                    </a>
                </div>
                <div class="month-bar">
                    <form action="index.php" method="GET" class="form-select-month">
                        <button type="submit" name="month" value="01" class="btn btn__month">Leden</button>
                        <button type="submit" name="month" value="02" class="btn btn__month">Únor</button>
                        <button type="submit" name="month" value="03" class="btn btn__month">Březen</button>
                        <button type="submit" name="month" value="04" class="btn btn__month">Duben</button>
                        <button type="submit" name="month" value="05" class="btn btn__month">Květen</button>
                        <button type="submit" name="month" value="06" class="btn btn__month">Čeren</button>
                        <button type="submit" name="month" value="07" class="btn btn__month">Červenec</button>
                        <button type="submit" name="month" value="08" class="btn btn__month">Srpen</button>
                        <button type="submit" name="month" value="09" class="btn btn__month">Září</button>
                        <button type="submit" name="month" value="10" class="btn btn__month">Říjen</button>
                        <button type="submit" name="month" value="11" class="btn btn__month">Listopad</button>
                        <button type="submit" name="month" value="12" class="btn btn__month">Prosinec</button>
                    </form>
                </div>
            </div>

            <div class="row u-mb-xlarge">
                <div class="col-1-of-1">
                    <div class="tasks">
                        <table class="tasks__table">
                            <thead>
                                <tr class="tasks__table-tr">
                                    <th>Datum zadani</th>
                                    <th>Sluzba</th>
                                    <th>Popis problemu</th>
                                    <th>Moznosti</th>
                                </tr>
                            </thead>

                            <tbody id="id-table-body">
                                <tr class="tasks__table--inputs-tr">
                                    <form id="id-form-add">
                                        <td>
                                            <input class="tasks__table--inputs-input"  type="date" name="datum" placeholder="Datum" require></button> 
                                        </td> 
                                        <td> 
                                            <input class="tasks__table--inputs-input"  type="text" name="sluzba" placeholder="Sluzba"></input>
                                        </td> 
                                        <td> 
                                            <input class="tasks__table--inputs-input"  type="text" name="popis" placeholder="Popis problemu"></input>
                                        </td> 
                                        <td> 
                                            <button type="submit" id="id-submit" class="btn btn__submit">Pridat</button>
                                        </td> 
                                    </form>
                                </tr>

                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $row_id = $row['id'];
                                    $row_datum = $row['datum'];
                                    $row_sluzba = $row['sluzba'];
                                    $row_popis = $row['popis'];
                                    $row_mesic = $row['mesic'];
                                    $row_urgent = $row['urgent'];
                                    $row_done = $row['done'];

                                    $style_urgent = '<tr id="tr-'.$row_id.'" class="tasks__table-tr tasks__table-tr--urgent">';

                                    $style_done = '<tr id="tr-'.$row_id.'" class="tasks__table-tr tasks__table-tr--done">';

                                    $style_both = '<tr id="tr-'.$row_id.'" class="tasks__table-tr tasks__table-tr--both">';

                                    $style_normal = '<tr id="tr-'.$row_id.'" class="tasks__table-tr">';

                                        if ($row_urgent == 1 && $row_done == 2) {
                                            $urgent_check = 'checked';
                                            $done_check = '';
                                            echo $style_urgent;
                                        } 
                                        elseif ($row_done == 1 && $row_urgent == 2) {
                                            $urgent_check = '';
                                            $done_check = 'checked';
                                            echo $style_done;
                                        }
                                        elseif ($row_urgent == 1 && $row_done == 1) {
                                            $urgent_check = 'checked';
                                            $done_check = 'checked';
                                            echo $style_both;
                                        }
                                        else {
                                            $urgent_check = '';
                                            $done_check = '';
                                            echo $style_normal;
                                        }
                                        echo
                                            '<td>'. $row_datum .'</td>
                                            <td>'. $row_sluzba .'</td>
                                            <td>'. $row_popis .'</td>
                                            <td class="more">
                                                <div class="more__closed">
                                                    <a href="#" class="btn btn__options-main">Moznosti</a>
                                                </div>
                                                <div class="more__open">
                                                    <div class="more__open-option">
                                                    
                                                            <input type="checkbox" name="urgent" id="id-'.$row_id.'"     class="urgent__input" '.$urgent_check.'>
                                                            <label for="id-'.$row_id.'" class="urgent__label">
                                                                <p class="btn-options btn-options-urgent">Urgentni</p>
                                                            </label>

                                                            <input type="checkbox" name="done" id="id_'.$row_id.'"     class="done__input" '.$done_check.'>
                                                            <label for="id_'.$row_id.'" class="done__label">
                                                                <p class="btn-options btn-options-done">Hotovo</p>
                                                            </label>

                                                                <p id="id-'.$row_id.'" class="btn-options btn-options-del">Smazat</p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>'; }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
    <script type="text/javascript" src="script/main.js"></script>
    </body>