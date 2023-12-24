<?php function generateCalendar($month = null, $year = null) {

    if (!$month) {
        $month = date('m');
    }
    if (!$year) {
        $year = date('Y');
    }
    

    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    

    $firstDay = date('w', strtotime("$year-$month-01"));
    

    $calendar = '<table>';
    $calendar .= '<caption>'. date('F Y', strtotime("$year-$month-01")) .'</caption>';
    $calendar .= '<tr><th>Пн</th><th>Вт</th><th>Ср</th><th>Чт</th><th>Пт</th><th>Сб</th><th>Вс</th></tr>';
    
    $calendar .= '<tr>';
    

    for ($i = 1; $i < $firstDay; $i++) {
        $calendar .= '<td></td>';
    }
    

    for ($day = 1; $day <= $daysInMonth; $day++) {

        $currentDay = strtotime("$year-$month-$day");
        $isWeekend = (date('N', $currentDay) >= 6);


        $holidays = [
            '01-01', // Новый год
            '02-01', // Новый год
            '03-01', // Новый год
            '04-01', // Новый год
            '05-01', // Новый год
            '06-01', // Новый год
            '07-01', // Рождество Христово
            '08-01', // Новый год
            '23-02', // День защитника Отечества
            '08-03', // Международный женский день
            '01-05', // Праздник Весны и Труда
            '09-05', // День Победы
            '12-06', // День России
            '04-11', // День народного единства
        ];
        $isHoliday = (in_array(date('d-m', $currentDay), $holidays));
        

        if ($isWeekend || $isHoliday) {
            $calendar .= '<td style="background-color: red;">'. $day .'</td>';
        } else {
            $calendar .= '<td>'. $day .'</td>';
        }
        

        if (($day + $firstDay) % 7 == 1) {
            $calendar .= '</tr><tr>';
        }
    }
    
    if (($daysInMonth + $firstDay) % 7 != 0  || $firstDay == 0) {
        $calendar .= str_repeat('<td></td>', 7 - (($daysInMonth + $firstDay) % 7));
    }
    
    $calendar .= '</tr>';
    $calendar .= '</table>';

    echo $calendar;
}
?>
<?generateCalendar(2, 2023);?>
<?generateCalendar();?>