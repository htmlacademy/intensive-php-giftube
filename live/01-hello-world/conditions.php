<?php

if (true) {
    echo "Это условие выполнилось\n";
}
/*else {
    echo "Условие оказалось ложным\r";
}*/

$digit = rand(1, 9);
print("Загаданное число: $digit\n");

if ($digit < 5) {
    print("Это число меньше пяти\n");
}
elseif ($digit > 5) {
    print("Это число БОЛЬШЕ пяти\n");
}
else {
    print("Это число равно пяти\n");
}