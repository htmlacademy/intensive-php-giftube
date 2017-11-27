<?php
/* BEGIN STATE 01 */
function calculate_amount($first, $second) {
	$amount = $first + $second;

	return $amount;
}

$result = calculate_amount(2, 3);

print($result);
/* END STATE 01 */
/* BEGIN STATE 02 */
$long_text = "Поэт инстинктивно чувствовал преимущества реального устного исполнения тех стихов";

function cut_text($text, $num_letters) {
	$num = mb_strlen($text);

	if ($num > $num_letters) {
		$text = mb_substr($text, 0, $num_letters);
		$text .= "…";
	}

	return $text;
}

$short_text = cut_text($long_text, 25);

print($short_text);
/* END STATE 02 */