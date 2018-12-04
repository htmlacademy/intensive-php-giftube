<?php

/* BEGIN STATE 01 */
function generate_captcha($text, $width = 100, $height = 40, $noise_level = 250)
{
    /* BEGIN STATE 02 */
    $colors = [
        'bg' => [26, 100, 219],
        'text' => [255, 255, 255],
        'noise' => [227, 234, 242]
    ];
    /* END STATE 02 */

    /* BEGIN STATE 03 */
    $im = imagecreatetruecolor($width, $height);
    /* END STATE 03 */

    /* BEGIN STATE 04 */
    $bg_color = imagecolorallocate($im, ...$colors['bg']);
    $text_color = imagecolorallocate($im, ...$colors['text']);
    $noise_color = imagecolorallocate($im, ...$colors['noise']);
    /* END STATE 04 */

    /* BEGIN STATE 05 */
    imagefill($im, 0, 0, $bg_color);
    imagestring($im, 5, 10, 10, $text, $text_color);
    /* END STATE 05 */

    /* BEGIN STATE 06 */
    for ($i = 0; $i < $noise_level; $i++) {
        $x_pos = rand(1, $width);
        $y_pos = rand(1, $height);

        imagesetpixel($im, $x_pos, $y_pos, $noise_color);
    }
    /* END STATE 06 */

    /* BEGIN STATE 07 */
    imagepng($im);
    /* END STATE 07 */
}
/* END STATE 01 */

/* BEGIN STATE 08 */
function generate_random_string($length = 8){
    /* BEGIN STATE 09 */
    $chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $chars_arr = str_split($chars);
    /* END STATE 09 */

    /* BEGIN STATE 10 */
    $rand_keys = array_rand($chars_arr, $length);
    $rand_chars = array_intersect_key($chars_arr, array_flip($rand_keys));
    /* END STATE 10 */

    /* BEGIN STATE 11 */
    $result = implode("", $rand_chars);

    return $result;
    /* END STATE 11 */
}
/* END STATE 08 */
