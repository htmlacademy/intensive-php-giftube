<?php

function cut_text($text, $num_letters) {
	$num = mb_strlen($text);

	if ($num > $num_letters) {
		$text = mb_substr($text, 0, $num_letters);
		$text .= "…";
	}

	return $text;
}