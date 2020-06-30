<?php
    function logFile($textLog) {
        $file = 'log/logFile.txt';
        $text = date('Y-m-d H:i:s') . ' '; 
        $text .= $textLog;
        $text .= "\n";
        $fOpen = fopen($file, 'a+');
        if ( $fOpen ){          
            fwrite($fOpen, $text);
            fclose($fOpen);
        } else {
            echo 'Wrong open log-file.';
        }
    }
?>