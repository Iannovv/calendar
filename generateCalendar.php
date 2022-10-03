<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Calendar</title>
    <link href="style.css" type="text/css" rel="stylesheet"/>
</head>
<body>

<!-- Formularz odpowiedzialny za pobranie roku i miesiąca --> 
<div>
<form name="Filter" method="POST">
    <label for="year">Rok:</label>
    <input  type="text" pattern="[0-9]+" name="year" id="year" size="5" value="">
    
    <label for="month">Miesiąc:</label>
    <input id ="month" type="hidden" name="month" value=""/>    
   <select name="month" value=''></option>
    <option value='1'>Styczeń</option>
    <option value='2'>Luty</option>
    <option value='3'>Marzec</option>
    <option value='4'>Kwiecień</option>
    <option value='5'>Maj</option>
    <option value='6'>Czerwiec</option>
    <option value='7'>Lipiec</option>
    <option value='8'>Sierpień</option>
    <option value='9'>Wrzesień</option>
    <option value='10'>Październik</option>
    <option value='11'>Listopad</option>
    <option value='12'>Grudzień</option>
   </select>
    <input type="submit" name="submit" value="Generuj"/>
</form>
</div>


<?php

// Wywołanie funkcji generującej kalendarz:

if (isset($_POST['submit']) && $_POST['year']!="") {
    
    $year = htmlentities($_POST['year']);
    $month = htmlentities($_POST['month']);

$result = generateCalendar($year, $month);
echo $result;

}

// Funkcja odpowiedzialna za generowanie kalendarza:

function generateCalendar($var1, $var2 ) { 

    // Lista miesięcy, sprawdzenie pierwszego dnia podanego miesiąca oraz roku, sprawdzenie liczby dni w danym miesiącu i roku. 

    $months_list = array(1 => 'Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień');
    $year = $var1;
    $month = $var2;
    $first_day = date("$year-$month-01");
    $number_of_first_day = date('N', strtotime($first_day));
    $number_of_last_day = cal_days_in_month(CAL_GREGORIAN, $month , $year);
    $string = '';

    // Początek tabeli zawierającej kalendarz: 

    $string .=  ("<div>");
    $string .=  ("<table>");

    // Rysowanie nagłówka z podanym miesiącem i rokiem oraz dni tygodnia:

    $string .= ("<tr>");
        $string .=  ("<th colspan='7'>{$months_list[$month]} $year</th>");
    $string .=  ("</tr>"); 
    $string .=  ("<tr>");
        $string .= ("<td class='days'>Pn</td>");  
        $string .= ("<td class='days'>Wt</td>"); 
        $string .= ("<td class='days'>Śr</td>"); 
        $string .= ("<td class='days'>Cz</td>"); 
        $string .= ("<td class='days'>Pt</td>"); 
        $string .= ("<td class='days'>So</td>"); 
        $string .= ("<td class='ndays'>N</td>"); 
        $string .= ("</tr>"); 

    // Rysowanie poszczególnych komórek dni i umieszczenie w nich odpowiednich liczb:

    for ($i = 1; $i < ($number_of_last_day + $number_of_first_day); $i++) {
        if (($i % 7) == 1) 
            $string .= "<tr>";
        if ($i < $number_of_first_day)
            $string .= ("<td></td>");

        elseif (($i % 7) == 0 ) 
            $string .= ("<td class='ndays'>".($i - $number_of_first_day + 1)."</td>");              
        else             
             $string .= ("<td>".($i - $number_of_first_day + 1)."</td>");     
        if (($i % 7)==7)
            $string .= ("</tr>");
    }
    // Zakończenie tabeli: 
    $string .= ("<table>");
    $string .= ("</div>");

    return $string;

}

?>
 
</body>
</html>