<?php

use GifCreator\GifCreator;
use GifFrameExtractor\GifFrameExtractor;

class GifConverter {
	protected $gif_name;

	protected $gfe;
	protected $gc;

	public function __construct($gif_name) {
		$this->gif_name = $gif_name;

		$this->gfe = new GifFrameExtractor();
		$this->gc  = new GifCreator();
	}

	public function createAndSaveThumbnail() {
		$path = UPLOAD_PATH . DIRECTORY_SEPARATOR . $this->gif_name;

		if (GifFrameExtractor::isAnimatedGif($path)) {
			$frames = $this->gfe->extract($path);

			if ($frames) {
				$first_frame = $frames[0];
				$this->gc->create([$first_frame['image']], [40], 0);

				$filename = UPLOAD_PATH . '/preview_' . $this->gif_name;
				file_put_contents($filename, $this->gc->getGif());
			}
		}
	}
}