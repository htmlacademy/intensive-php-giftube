<?php
$text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit";

/* BEGIN STATE 01 */
function back_to_2007($text){
    /* BEGIN STATE 02 */
    $words = str_split($text);
    /* END STATE 02 */

    /* BEGIN STATE 03 */
    array_walk($words,
        function(&$value) {
        /* BEGIN STATE 04 */
            if (rand(0, 1)) {
                $value = strtoupper($value);
            }
            /* END STATE 04 */
        }
    );
    /* END STATE 03 */

    /* BEGIN STATE 05 */
    $result = implode("", $words);

    return $result;
    /* END STATE 05 */
}
/* END STATE 01 */

/* BEGIN STATE 06 */
$text = back_to_2007($text);
/* END STATE 06 */

print($text);
