$dFrom = date("d.m.Y H:i:s", mktime(0, 0, 0, date("m"), date("d")-5));
   // От какого числа считаем
   
    // $fromDay = date("d.m.Y H:i:s", mktime(0, 0, 0, date("m"), date("d") - 5));
    $fromDay = (int)$dFrom;

    // До какого числа считаем
    $untilDay = date("d");

    //Колличество месяцев
    $monthCount = 1;

    // Вычисляем число дней в прошлом месяце
    $dayofbefmonth = date("t", time() - date("j") * 86400 + 1);


    // 1. Первая неделя
    $num = 0;
    $day = 0;

    // 2. Последующие недели месяца
    while (true) {

        $num++;

        $month[$num][date('w', strtotime($fromDay . '.' . date('m', mktime(0, 0, 0, date("m"), date("d") -5)) . '.' . date('Y', mktime(0, 0, 0, date("m"), date("d") -5))))] = $fromDay . '.' . date('m', mktime(0, 0, 0, date("m"), date("d") -5));

        $fromDay++;

        if($fromDay > $dayofbefmonth) break; 
        // if ($fromDay > $untilDay) break;
    }

    // 3. Последующие недели текущего месяца
    while (true) {

        $num++;

        $day++;
        if($day > $untilDay) break;
        // if ($day < $fromDay) break;
        $month[$num][date('w', strtotime($day . '.' . date('m') . '.' . date('Y')))] = $day . '.' . date('m');
    }

    foreach ($month as $week => $day) {
        foreach ($day as $dayKey => $dayValue) {
            if (!empty($dayValue)) $arMonth[] = $dayValue . '.' . $dayKey;
        }
    }

    $arMonth = array_reverse($arMonth);

    foreach ($arMonth as $key => $value) {
        $k = explode(".", $value);
        $arResMonth[$value] = $k[0] . '.' . $k[1];
    }


    $arResult['MONTH'] = $arResMonth;
