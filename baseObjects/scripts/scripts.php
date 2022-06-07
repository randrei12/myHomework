<?php
    //calculeaza "acum cat timp"

    date_default_timezone_set('Europe/Bucharest');

    function timeToACT($target) {
        $initialDate = ['hour' => date("G",strtotime($target)), 'minutes' => date("i",strtotime($target)), 'seconds' => date("s",strtotime($target)), 'day' => date("j",strtotime($target)), 'month' => date("n",strtotime($target)), 'year' => date("Y",strtotime($target))];
        $currentDate = ['hour' => date("G"), 'minutes' => date("i"), 'seconds' => date("s"), 'day' => date('j'), 'month' => date("n"), 'year' => date('Y')];

            $uploadTime = 'o secunda';
            if ($currentDate['year'] >  $initialDate['year'] + 1) {
                $uploadTime = ($currentDate['year'] - $initialDate['year']).' ani';
            } else if ($currentDate['year'] ==  $initialDate['year'] + 1) {
                $uploadTime = 'un an';
            } else if ($currentDate['month'] > $initialDate['month'] + 1) {
                $uploadTime = ($currentDate['month'] - $initialDate['month']).' luni';
            } else if ($currentDate['month'] == $initialDate['month'] + 1) {
                $uploadTime = 'o luna';
            } else if (($currentDate['day'] - $initialDate['day']) > 7) {
                $uploadTime = intval(($currentDate['day'] - $initialDate['day'])/7 + 1) .' saptamani';
            } else if (($currentDate['day'] - $initialDate['day']) == 7) {
                $uploadTime = 'o saptamana';
            } else if (($currentDate['day'] - $initialDate['day']) > 1) {
                $uploadTime = ($currentDate['day'] - $initialDate['day']).' zile';
            } else if (($currentDate['day'] - $initialDate['day']) == 1) {
                $uploadTime = 'o zi';
            } else if (($currentDate['hour'] - $initialDate['hour']) > 1) {
                $uploadTime = ($currentDate['hour'] - $initialDate['hour']).' ore';
            } else if (($currentDate['hour'] - $initialDate['hour']) == 1) {
                $uploadTime = 'o ora';
            } else if (($currentDate['minutes'] - $initialDate['minutes']) >= 0) {
                if (($currentDate['minutes'] - $initialDate['minutes']) >= 50) {
                    $uploadTime = 'o ora.';
                } else if (($currentDate['minutes'] - $initialDate['minutes']) >= 40) {
                    $uploadTime = '45 de minute';
                } else if (($currentDate['minutes'] - $initialDate['minutes']) >= 30) {
                    $uploadTime = '30 de minute';
                } else if (($currentDate['minutes'] - $initialDate['minutes']) >= 20) {
                    $uploadTime = '25 de minute';
                } else if (($currentDate['minutes'] - $initialDate['minutes']) >= 10) {
                    $uploadTime = '15 minute';
                } else if (($currentDate['minutes'] - $initialDate['minutes']) >= 5) {
                    $uploadTime = '10 minute';
                } else if (($currentDate['minutes'] - $initialDate['minutes']) >= 4) {
                    $uploadTime = '5 minute';
                } else if (($currentDate['minutes'] - $initialDate['minutes']) >= 3) {
                    $uploadTime = '4 minute';
                } else if (($currentDate['minutes'] - $initialDate['minutes']) >= 2) {
                    $uploadTime = '3 minute';
                } else if (($currentDate['minutes'] - $initialDate['minutes']) >= 1) {
                    $uploadTime = '2 minute';
                } else if (($currentDate['minutes'] - $initialDate['minutes']) > 0) {
                    $uploadTime = '1 minute';
                }
            } else if (($currentDate['seconds'] - $initialDate['seconds']) > 1) {
                $uploadTime = ($currentDate['seconds'] - $initialDate['seconds']).' secunde';
            } else {
                $uploadTime = 'o secunda';
            }
            return $uploadTime;
    }

    //tranforma din id materie in numele materii

    function matIdToName($artMaterie) {
        switch($artMaterie) {
            case 'bio':
                $artMaterie = 'Biologie' ;
                break;
            case 'chi':
                $artMaterie = 'Chimie' ;
                break;
            case 'ses':
                $artMaterie = 'Desen/Educatie Plastica' ;
                break;
            case 'eng':
                $artMaterie = 'Engleza' ;
                break;
            case 'spo':
                $artMaterie = 'Educatie Fizica/Sport' ;
                break;
            case 'fiz':
                $artMaterie = 'Fizica' ;
                break;
            case 'fra':
                $artMaterie = 'Franceza' ;
                break;
            case 'geo':
                $artMaterie = 'Geografie' ;
                break;
            case 'ger':
                $artMaterie = 'Germana' ;
                break;           
            case 'inf':
                $artMaterie = 'Informatica' ;
                break;    
            case 'ist':
                $artMaterie = 'Istorie' ;
                break;    
            case 'ita':
                $artMaterie = 'Italiana' ;
                break;    
            case 'log':
                $artMaterie = 'Logica' ;
                break;     
            case 'mat':
                $artMaterie = 'Matematica' ;
                break;    
            case 'muz':
                $artMaterie = 'Muzica/Educatie Muzicala' ;
                break;    
            case 'rel':
                $artMaterie = 'Religie' ;
                break;    
            case 'rom':
                $artMaterie = 'Romana' ;
                break;    
            case 'spa':
                $artMaterie = 'Spaniola' ;
                break;    
            case 'tic':
                $artMaterie = 'TIC' ;
                break;    
            case 'oth':
                $artMaterie = 'Altele' ;
                break;   
        }

        return $artMaterie;
    }

    //schimba numele lunii in romana

    function monthToRo($month) {
        switch($month) {
            case 'January':
                $month = 'Ianuarie';
                break;
            case 'February':
                $month = 'Februarie';
                break;
            case 'March':
                $month = 'Martie';
                break;
            case 'April':
                $month = 'Aprilie';
                break;
            case 'May':
                $month = 'Mai';
                break;
            case 'June':
                $month = 'Iunie';
                break;
            case 'July':
                $month = 'Iulie';
                break;
            case 'August':
                $month = 'August';
                break;
            case 'September':
                $month = 'Septembrie';
                break;
            case 'October':
                $month = 'Octombrie';
                break;
            case 'November':
                $month = 'Noiembrie';
                break;
            case 'December':
                $month = 'Decembrie';
                break;
       }
       return $month;
    }

    //calculeaza diferenta dintre like-uri si dislike-uri

    function allToLikeCount($likesVar, $dislikesVar) {

        // //calculam diferenta
        // if ($likesArray[0] == '' && count($likesArray) == 1) {
        //     $likeVal = 0;
        // } else {
        //     $likeVal = count($likesArray);
        // }
        // if ($dislikesArray[0] == '' && count($dislikesArray) == 1) {
        //     $dislikeVal = 0;
        // } else {
        //     $dislikeVal = count($dislikesArray);
        // }

        return (count($likesVar) - count($dislikesVar));
        
    }

    //genereaza random string (avand lungimea 8, default)
    function randomString($length = 8) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    //systemul default de upload imagni
    function uploadMultipleImages($folder) {
            $JSerror = ['<script>alert("', '");</script>'];
            $img = '';
            $nrFiles = count($_FILES['imgInput']['name']);
            for ($i = 0; $i < $nrFiles; $i++) {
                if ($_FILES['imgInput']['type'][$i] == 'image/png' || $_FILES['imgInput']['type'][$i] == 'image/gif' || $_FILES['imgInput']['type'][$i] == 'image/jpeg') {
                    if ($_FILES['imgInput']['size'][$i] > 5000000) {
                        echo $JSerror[0]. 'Marimea imaginii este prea mare('.(floor($_FILES['imgInput']['size'][$i]/1024 *100)/100).'KB)'. $JSerror[1];
                    } else {
                        $convImg = '';
                        if ($_FILES['imgInput']['type'][$i] == 'image/gif') {
                            $convImg = imagecreatefromgif($_FILES['imgInput']['tmp_name'][$i]);
                        }else if ($_FILES['imgInput']['type'][$i] == 'image/jpeg') {
                            $convImg = imagecreatefromjpeg($_FILES['imgInput']['tmp_name'][$i]);
                        }else if ($_FILES['imgInput']['type'][$i] == 'image/png') {
                            $convImg = imagecreatefrompng($_FILES['imgInput']['tmp_name'][$i]);
                        }

                        //cautam primul numar care nu este deja atribuit unei imagini
                        $j = $i;
                        while (is_file("$folder/$j.png")) {
                            $j++;
                        }

                        $filePath = $folder.'/'.$j.'.png';
                        if (!is_dir($folder)) {                          
                            mkdir($folder, 0777, true);
                        }
                        imagepng($convImg, $filePath);
                        if ($img == '') {
                            $img = $filePath;
                        } else {
                            $img = $img.','.$filePath;
                        }
                    }
                    
                }else {
                    echo $JSerror[0].'Formatul nu este acceptat (formate acceptate: .gif, .jpg, .jpeg, .jfif, .pjpeg, .pjp, .png)'.$JSerror[1];
                }
            }       
    }
    function loadImagesFromLocal($directory) {
        $imagesFromDir = glob($directory.'/*');
        $base64Images = [];
        foreach($imagesFromDir as $imageFromDir) {
            array_push($base64Images, base64_encode(file_get_contents($imageFromDir)));
        }
        return $base64Images;
    }

    //se recomanda adaugarea fisierului cat mai in fata
?>