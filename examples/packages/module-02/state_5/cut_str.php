<?php
$long_text = "Поэт инстинктивно чувствовал преимущества реального устного исполнения тех стихов";

/* BEGIN STATE 01 */
function cut_text(
    /* BEGIN STATE 02 */
    $text, $num_letters
    /* END STATE 02 */
) {
    /* BEGIN STATE 03 */
	$num = mb_strlen($text);
	/* END STATE 03 */

    /* BEGIN STATE 04 */
	if ($num > $num_letters) {
	    /* BEGIN STATE 05 */
		$text = mb_substr($text, 0, $num_letters);
		$text .= "…";
		/* END STATE 05 */
	}
	/* END STATE 04 */

    /* BEGIN STATE 06 */
	return $text;
	/* END STATE 06 */
}
/* END STATE 01 */

/* BEGIN STATE 07 */
$short_text = cut_text($long_text, 25);

print($short_text);
/* END STATE 07 */
