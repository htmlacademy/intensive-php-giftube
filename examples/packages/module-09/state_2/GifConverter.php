<?php

use GifCreator\GifCreator;
use GifFrameExtractor\GifFrameExtractor;

class GifConverter {
/* BEGIN STATE 01 */
	protected $gif_name;

	protected $gfe;
	protected $gc;
/* END STATE 01 */

/* BEGIN STATE 02 */
	public function __construct($gif_name) {
		$this->gif_name = $gif_name;

		$this->gfe = new GifFrameExtractor();
		$this->gc  = new GifCreator();
	}
/* END STATE 02 */

/* BEGIN STATE 03 */
	public function createAndSaveThumbnail() {
		$path = UPLOAD_PATH . DIRECTORY_SEPARATOR . $this->gif_name;

		/* BEGIN STATE 04 */
		if (GifFrameExtractor::isAnimatedGif($path)) {
			$frames = $this->gfe->extract($path);

			if ($frames) {
				/* BEGIN STATE 05 */
				$first_frame = $frames[0];
				$this->gc->create([$first_frame['image']], [40], 0);

				$filename = UPLOAD_PATH . '/preview_' . $this->gif_name;
				file_put_contents($filename, $this->gc->getGif());
				/* END STATE 05 */
			}
		}
		/* END STATE 04 */
	}
/* END STATE 03 */
}