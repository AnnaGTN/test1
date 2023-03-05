<?php
  ini_set('default_charset', 'Windows-1251');
  
  $cardColors = array('R', 'G', 'B', 'W');
  $gamersCount = -1;

  for(;;) {
    $consoleParams = explode(' ', readline('Command: '));

    if ($consoleParams[0] == 'start') {
        $N = intval($consoleParams[1]);
        $C = intval($consoleParams[2]);

        $gamersCount = $C;
        $cards = array();
        $userCards = array();
        for($i = 1; $i <= 10; $i++) {
            foreach($cardColors as $cardColor) $cards[] = $cardColor . $i;
        }

        if ($N * $C > count($cards)) echo "Ошибка: для указанных параметров раздачи требуется больше карт чем есть в наличии\n\n";
        else {
            for($i = 1; $i <= $C; $i++) {
                for($j = 1; $j <= $N; $j++) {
                    $cardIndex = random_int(0, count($cards)-1);
                    $userCards[$i][] = $cards[$cardIndex];

                    unset($cards[$cardIndex]);
                    $cards = array_values($cards);
                }
            }
        }
    }

    if ($consoleParams[0] == 'get-cards') {
        if ($gamersCount < 0) echo "Ошибка: раздачи карт еще не было\n\n";
        else {
            $C = intval($consoleParams[1]);
            if ($C > $gamersCount) echo "Ошибка: в раздаче участвовало только $gamersCount игроков\n\n";
            else {
                echo $C . ' ' . implode(' ', $userCards[$C]) . "\n\n";
            }
        }
    }
  }
?>
