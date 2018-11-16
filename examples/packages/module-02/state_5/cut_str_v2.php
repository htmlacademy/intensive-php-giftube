<?php
$text = "Поэт инстинктивно чувствовал преимущества реального устного исполнения тех стихов";

/* BEGIN STATE 10 */
function cut_text(
    /* BEGIN STATE 11 */
    &$text, $num_letters = 30
    /* END STATE 11 */
) {
    /* BEGIN STATE 12 */
    $num = mb_strlen($text);

    if ($num > $num_letters) {
        $text = mb_substr($text, 0, $num_letters);
        $text .= "…";
    }
    /* END STATE 12 */
}
/* END STATE 10 */

/* BEGIN STATE 13 */
cut_text($text, 40);
/* END STATE 13 */

/* BEGIN STATE 14 */
cut_text($text);
/* END STATE 14 */

print($text);
