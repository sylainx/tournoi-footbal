<?php
    session_start();

    //DETRUIRE les session s'il n'y a plus de cookies
    if ( ! isset( $_COOKIE['tirageGroupeA'], $_COOKIE['tirageGroupeB'] ) ) {
        session_destroy();
    }    

    //importation des classes        
    require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'championnatFoot' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Equipe.php';

    //variables pour définir les cookies
    $expiration = time() + 60 * 15;
    $path = '/';
    $tirageGroupeA = 'tirageGroupeA';
    $tirageGroupeB = 'tirageGroupeB';

    /* ============================================================*/
    // ====================== Gérer classement ======================
    /* ============================================================*/    
    include('./functions/functions.php');    
    gererClassement();

    
    
?>

<!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <h1>Championnat de Foot</h1> <br>
    

    <!----------- LISTE DES GROUPES ----------->
    
    <h2 style="text-align: center">Liste d'equipe</h2>
    <table >
        
        <thead>
            <tr>
                <th>Lot #1 (e tete de série)</th>
                <th>Lot #2 (e tete de série)</th>
                <th>Lot #3 (e tete de série)</th>
                <th>Lot #3 (e tete de série)</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Bresil</td>
                <td>France</td>
                <td>Espagne</td>
                <td>Portugal</td>
            </tr>
            <tr>
                <td>Argentine</td>
                <td>Italie</td>
                <td>Allemagne</td>
                <td>Haiti</td>
            </tr>
        </tbody>

    </table>

    <form action="tirage/tirage.php" method="post">
        <button type="submit" name="lancer-tirage" value="tirage">Tirage</button>
    </form>

    
        <!--------------- tirage equipe --------------->
    <?php
        
        // VARIABLES POUR AFFICHER EQUIPE DE CHAQUE GROUPE
        if (isset( $_COOKIE['tirageGroupeA'] ) ) {
            $groupeA = unserialize($_COOKIE['tirageGroupeA']);
        }

        if (isset( $_COOKIE['tirageGroupeB'] ) ) {
            $groupeB = unserialize($_COOKIE['tirageGroupeB']);
        }

    ?>


    <?php    
        function liste_option_but(){
            for ($i=0; $i <= 10; $i++){
            
    ?>
        <option value=<?php echo $i; ?> ><?php echo $i; ?> </option>

    <?php 
            } // boucle for
        }   //function
    ?>

    
<!--------------- fin code PhP --------------->


    <!----------- LISTE DES GROUPES ----------->

    <h2 style="text-align: center">Classements</h2>

    <table >
        
        <thead>
            <tr>
                <th></th>
                <th>GROUPE A</th>
                <th>GROUPE B</th>
            </tr>

        </thead>

        <tbody>

            <?php
                for ($i=0; $i < 4; $i++) {                     
            ?>
            <tr>
                <td> <?php echo ($i+1) ?>e TDS</td>
                <?php
                    if (isset($groupeA[$i])) {
                        
                ?>
                    <td><?php echo $groupeA[$i]->getNom() ?> </td>
                    <td><?php echo $groupeB[$i]->getNom() ?> </td>

            </tr>

            <?php
                    }else{
            ?>

                <td><?= 'Equipe '. ($i+1); ?> </td>
                <td><?= 'Equipe '. ($i+1); ?> </td>
            <?php
                }
            }
            ?>
                        
        </tbody>

    </table>



    <!-------------------------------------------->
    <!----------- affiche groupe A --------------->
    <!-------------------------------------------->

    <h2 style="text-align: center">Groupe A</h2>
    <table >        
        <thead>
            <tr>
                <th>GROUPE A</th>
                <th>Affiche</th>
                <th>Score</th>
            </tr>

        </thead>

        <tbody>
            <!-- match 1 -->
            
            <?php
                
                for ($i=1; $i < 7; $i++) { // ouvrir boucle   ATTENTION, boucle commence a 1
                    
            ?>
            
            <tr>
                <form action='functions/stats.php' method='post'> <!-- formulaire d'envoi donnees -->
            
                <td>Match <?php echo $i; ?> </td> 
                
                <!-- colonne affiche EqX VS EqY -->

                <td id=<?php echo "match-".$i; ?> >

                    <?php
                        switch ($i) {

                            case 1:
                                if (isset($groupeA)) {
                                    echo '<span>'.$groupeA[0]->getNom(). '</span> VS <span>'. $groupeA[1]->getNom() .'</span>' 
                                ?>
                                    <input type="hidden" id='m1eq1' name='m1eq1' value=<?php echo $groupeA[0]->getNom()?>  >
                                    <input type="hidden" id='m1eq2' name='m1eq2' value=<?php echo $groupeA[1]->getNom()?>  >
                                <?php
                                    }else {
                                        echo '1TDS VS 2TDS';
                                    }
                            break;
                            
                            case 2:
                                if (isset($groupeA)) {
                                    echo '<span>'.$groupeA[2]->getNom(). '</span> VS <span>'. $groupeA[3]->getNom() .'</span>' 
                                ?>
                                    <input type="hidden" id='m2eq1' name='m2eq1' value=<?php echo $groupeA[2]->getNom()?>  >
                                    <input type="hidden" id='m2eq2' name='m2eq2' value=<?php echo $groupeA[3]->getNom()?>  >
                                <?php
                                    }else {
                                        echo '3TDS VS 4TDS';
                                    }
                            break;                
                            
                            case 3:
                                if (isset($groupeA)) {
                                    echo '<span>'.$groupeA[0]->getNom(). '</span> VS <span>'. $groupeA[2]->getNom() .'</span>' 
                                ?>
                                    <input type="hidden" id='m3eq1' name='m3eq1' value=<?php echo $groupeA[0]->getNom()?>  >
                                    <input type="hidden" id='m3eq2' name='m3eq2' value=<?php echo $groupeA[2]->getNom()?>  >
                                <?php
                                    }else {
                                        echo '1TDS VS 3TDS';
                                    }
                            break;
                            
                            case 4:
                                if (isset($groupeA)) {
                                    echo '<span>'.$groupeA[1]->getNom(). '</span> VS <span>'. $groupeA[3]->getNom() .'</span>' 
                                ?>
                                    <input type="hidden" id='m4eq1' name='m4eq1' value=<?php echo $groupeA[1]->getNom()?>  >
                                    <input type="hidden" id='m4eq2' name='m4eq2' value=<?php echo $groupeA[3]->getNom()?>  >
                                <?php
                                    }else {
                                        echo '2TDS VS 4TDS';
                                    }
                            break;
                            
                            case 5:
                                if (isset($groupeA)) {
                                    echo '<span>'.$groupeA[0]->getNom(). '</span> VS <span>'. $groupeA[3]->getNom() .'</span>' 
                                ?>
                                    <input type="hidden" id='m5eq1' name='m5eq1' value=<?php echo $groupeA[0]->getNom()?>  >
                                    <input type="hidden" id='m5eq2' name='m5eq2' value=<?php echo $groupeA[3]->getNom()?>  >
                                <?php
                                    }else {
                                        echo '1TDS VS 4TDS';
                                    }
                            break;
                            
                            case 6:
                                if (isset($groupeA)) {
                                    echo '<span>'.$groupeA[1]->getNom(). '</span> VS <span>'. $groupeA[2]->getNom() .'</span>' 
                                ?>
                                    <input type="hidden" id='m6eq1' name='m6eq1' value=<?php echo $groupeA[1]->getNom()?>  >
                                    <input type="hidden" id='m6eq2' name='m6eq2' value=<?php echo $groupeA[2]->getNom()?>  >
                                <?php
                                    }else {
                                        echo '2TDS VS 3TDS';
                                    }
                            break;
                        }
                    ?>

                </td>

                <td id="score"> 

                    <?php
                        $nomSession = 'match-'.$i.'-Grpe-A'; //recuperer le nom session dynamiquement 

                        if ( isset($_SESSION[$nomSession]['scores'][0]) && isset($_SESSION[$nomSession]['scores'][1])) {
                            
                    ?>
                        <input type="number" disabled id='score1' name='score1' style="width: 2.425rem" value=<?php echo $_SESSION[$nomSession]['scores'][0] ?>  >
                        -
                        <input type="number" disabled id='score2' name='score2' style="width: 2.425rem" value=<?php echo $_SESSION[$nomSession]['scores'][1] ?>  >
                            
                    <?php
                        }else{
                    ?>
                        <!-- CHANGER SCORE A CHAQUE REDIRECTION -->
                        
                        <select name='score1'>
                            <?php liste_option_but(); ?>
                        </select>                        
                        - 
                        <select name='score2'>
                            <?php liste_option_but(); ?>
                        </select>                        
                    
                        <?php
                        }
                    ?>

                </td>

                    <td id="jouer">
                        <input type="hidden" id='numMatch' name='numMatch' value=<?php echo  $i; ?> >
                        <button >Jouer</button>
                    </td>

                </form>

            </tr>

            <?php
                } // fermer boucle for
            ?>
        

        </tbody>
    </table>



    <!-------------------------------------------->
    <!----------- affiche groupe b --------------->
    <!-------------------------------------------->

    <h2 style="text-align: center">Groupe B</h2>
    <table >        
        <thead>
            <tr>
                <th>GROUPE B</th>
                <th>Affiche</th>
                <th>Score</th>
            </tr>

        </thead>

        <tbody>

            <!-- match  -->
            
            <?php
                
                for($i = 7; $i < 13; $i++) { // ouvrir boucle   ATTENTION, boucle commence a 1
                    
            ?>
            
            <tr>
            <form action='functions/stats.php' method='post'> <!-- formulaire d'envoi donnees -->
            
                <td>Match <?php echo $i; ?> </td> 
                
                <!-- colonne affiche EqX VS EqY -->

                <td id=<?php echo "match-".$i; ?> >

                    <?php
                        switch ($i) {

                            case 7:
                                if (isset($groupeB)) {
                                    echo '<span>'.$groupeB[0]->getNom(). '</span> VS <span>'. $groupeB[1]->getNom() .'</span>' 
                                ?>
                                    <input type="hidden" id='m7eq1' name='m7eq1' value=<?php echo $groupeB[0]->getNom()?>  >
                                    <input type="hidden" id='m7eq2' name='m7eq2' value=<?php echo $groupeB[1]->getNom()?>  >
                                <?php
                                    }else {
                                        echo '1TDS VS 2TDS';
                                    }
                            break;
                            
                            case 8:
                                if (isset($groupeB)) {
                                    echo '<span>'.$groupeB[2]->getNom(). '</span> VS <span>'. $groupeB[3]->getNom() .'</span>' 
                                ?>
                                    <input type="hidden" id='m8eq1' name='m8eq1' value=<?php echo $groupeB[2]->getNom()?>  >
                                    <input type="hidden" id='m8eq2' name='m8eq2' value=<?php echo $groupeB[3]->getNom()?>  >
                                <?php
                                    }else {
                                        echo '3TDS VS 4TDS';
                                    }
                            break;                
                            
                            case 9:
                                if (isset($groupeB)) {
                                    echo '<span>'.$groupeB[0]->getNom(). '</span> VS <span>'. $groupeB[2]->getNom() .'</span>' 
                                ?>
                                    <input type="hidden" id='m9eq1' name='m9eq1' value=<?php echo $groupeB[0]->getNom()?>  >
                                    <input type="hidden" id='m9eq2' name='m9eq2' value=<?php echo $groupeB[2]->getNom()?>  >
                                <?php
                                    }else {
                                        echo '1TDS VS 3TDS';
                                    }
                            break;
                            
                            case 10:
                                if (isset($groupeB)) {
                                    echo '<span>'.$groupeB[1]->getNom(). '</span> VS <span>'. $groupeB[3]->getNom() .'</span>' 
                                ?>
                                    <input type="hidden" id='m10eq1' name='m10eq1' value=<?php echo $groupeB[1]->getNom()?>  >
                                    <input type="hidden" id='m10eq2' name='m10eq2' value=<?php echo $groupeB[3]->getNom()?>  >
                                <?php
                                    }else {
                                        echo '2TDS VS 4TDS';
                                    }
                            break;
                            
                            case 11:
                                if (isset($groupeB)) {
                                    echo '<span>'.$groupeB[0]->getNom(). '</span> VS <span>'. $groupeB[3]->getNom() .'</span>' 
                                ?>
                                    <input type="hidden" id='m11eq1' name='m11eq1' value=<?php echo $groupeB[0]->getNom()?>  >
                                    <input type="hidden" id='m11eq2' name='m11eq2' value=<?php echo $groupeB[3]->getNom()?>  >
                                <?php
                                    }else {
                                        echo '1TDS VS 4TDS';
                                    }
                            break;
                            
                            case 12:
                                if (isset($groupeB)) {
                                    echo '<span>'.$groupeB[1]->getNom(). '</span> VS <span>'. $groupeB[2]->getNom() .'</span>' 
                                ?>
                                    <input type="hidden" id='m12eq1' name='m12eq1' value=<?php echo $groupeB[1]->getNom()?>  >
                                    <input type="hidden" id='m12eq2' name='m12eq2' value=<?php echo $groupeB[2]->getNom()?>  >
                                <?php
                                    }else {
                                        echo '2TDS VS 3TDS';
                                    }
                            break;
                        }
                    ?>

                </td>

                <td id="score"> 
                    

                    <?php
                        $nomSession = 'match-'.$i.'-Grpe-B'; //recuperer le nom session dynamiquement 

                        if ( isset($_SESSION[$nomSession]['scores'][0]) && isset($_SESSION[$nomSession]['scores'][1])) {
                            
                    ?>
                        <input type="number" disabled id='score1' name='score1' style="width: 2.425rem" value=<?php echo $_SESSION[$nomSession]['scores'][0] ?>  >
                        -
                        <input type="number" disabled id='score2' name='score2' style="width: 2.425rem" value=<?php echo $_SESSION[$nomSession]['scores'][1] ?>  >
                            
                    <?php
                        }else{
                    ?>
                        <!-- CHANGER SCORE A CHAQUE REDIRECTION -->
                        
                        <select name='score1'>
                            <?php liste_option_but(); ?>
                        </select>                        
                        - 
                        <select name='score2'>
                            <?php liste_option_but(); ?>
                        </select>                        
                    
                        <?php
                        }
                    ?>

                </td>

                    <td id="jouer">
                        <input type="hidden" id='numMatch' name='numMatch' value=<?php echo  $i; ?> >
                        <button >Jouer</button>
                    </td>

                </form>

            </tr>

            <?php
                } // fermer boucle for
            ?>
        

        </tbody>
    </table>


    <!-------------------------------------------->
    <!-------------------------------------------->
    <!----------- CLASSEMENT GROUPE A ----------->
    <!-------------------------------------------->
    <!-------------------------------------------->

    <h2 style="text-align: center">Classement Groupe A</h2>
    <table >
        
        <thead>
            <h3>GROUPE A</h3>
            <tr>
                <th></th>
                <th>MJ</th>
                <th>MG</th>
                <th>MN</th>
                <th>MP</th>
                <th>BP</th>
                <th>BC</th>
                <th>+/-</th>
                <th>Pt</th>
            </tr>
            
        </thead>
        
        <tbody>

            <?php
            
                $ligneCase= array('nomEquipe', 'mj', 'mg', 'mn', 'mp', 'bp', 'bc', 'diff', 'point');

                for ($i=0; $i < 4 ; $i++) {
                    echo '<tr>';

                        for ($j=0; $j < 9; $j++) {
            ?>            
                            <td> 
                                <?php
                                    if (isset($_SESSION['classement-Grpe-A'])) {
                                        
                                        echo $_SESSION['classement-Grpe-A'][$i][ $ligneCase[$j] ] ;
                                    
                                    } else if($ligneCase[$j] == 'nomEquipe') {

                                        echo ($i+1) .'TDS';

                                    }else {
                                        echo 0;
                                    }
                                ?> 
                            </td>
                
            <?php
                        }
                    echo '</tr>';
                }
            ?>
            
        </tbody>
        
    </table>



    <!-------------------------------------------->
    <!-------------------------------------------->
    <!----------- CLASSEMENT GROUPE B ----------->
    <!-------------------------------------------->
    <!-------------------------------------------->

    <h2 style="text-align: center">Classement Groupe B</h2>
    <table >
        
        <thead>
            <h3>GROUPE B</h3>
            <tr>
                <th></th>
                <th>MJ</th>
                <th>MG</th>
                <th>MN</th>
                <th>MP</th>
                <th>BP</th>
                <th>BC</th>
                <th>+/-</th>
                <th>Pt</th>
            </tr>
            
        </thead>
        
        <tbody>

            <?php
            
                $ligneCase= array('nomEquipe', 'mj', 'mg', 'mn', 'mp', 'bp', 'bc', 'diff', 'point');

                for ($i=0; $i < 4 ; $i++) {
                    echo '<tr>';

                        for ($j=0; $j < 9; $j++) {
            ?>            
                            <td> 
                                <?php
                                    if (isset($_SESSION['classement-Grpe-B'])) {
                                        
                                        echo $_SESSION['classement-Grpe-B'][$i][ $ligneCase[$j] ] ;
                                    
                                    } else if($ligneCase[$j] == 'nomEquipe') {

                                        echo ($i+1) .'TDS';

                                    }else {
                                        echo 0;
                                    }
                                ?> 
                            </td>
                
            <?php
                        }
                    echo '</tr>';
                }
            ?>
            
        </tbody>
        
    </table>



    
        <!-------------------------------------------->
        <!-------------------------------------------->
        <!----------- demi final  ----------->
        <!-------------------------------------------->
        <!-------------------------------------------->
    
        <h2 style="text-align: center">Demi final</h2>
    <table >
        
        <thead>
            <tr>
                <th>Demi-final</th>
                <th>Affiche</th>
                <th>Score</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Math 13</td>
                <td>1eA VS 2eB</td> 
                <td>0- 0</td>               

            </tr>
            
            <tr>
                <td>Math 13</td>
                <td>1eB VS 2eA</td>  
                <td>0 - 0</td>              
            </tr>
            
        </tbody>

    </table>

    
        <!-------------------------------------------->
        <!-------------------------------------------->
        <!----------- 3eme place ----------->
        <!-------------------------------------------->
        <!-------------------------------------------->
    
        <h2 style="text-align: center">3eme Place</h2>
    <table >
        
        <thead>
            <tr>
                <th>Troisieme-place</th>
                <th>Affiche</th>
                <th>Score</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Math 14</td>
                <td>P13 VS P14</td>               
                <td>0 - 0</td>
            </tr>
            
        </tbody>

    </table>

    
        <!-------------------------------------------->
        <!-------------------------------------------->
        <!----------- Grande finale ----------->
        <!-------------------------------------------->
        <!-------------------------------------------->
    
        <h2 style="text-align: center">Grande finale</h2>
    <table >
        
        <thead>
            <tr>
                <th>Grande finale</th>
                <th>Affiche</th>
                <th>Score</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Math 16</td>
                <td>V13 VS V14</td>
                <td>0 - 0</td>           
            </tr>
            
        </tbody>

    </table>
   

    <!-- <script src="js/score.js"></script> -->


</body>
</html>

