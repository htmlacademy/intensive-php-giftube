<?php
namespace GifTube\services;

use GifCreator\GifCreator;
use GifFrameExtractor\GifFrameExtractor;
use GifTube\models\GifModel;

class GifConverter {

    protected $gif;
    protected $gif_path;

    /**
     * @var GifFrameExtractor
     */
    protected $gfe;

    /**
     * @var GifCreator
     */
    protected $gc;

    /**
     * GifConverter constructor.
     * @param GifModel $gifModel
     */
    public function __construct(GifModel $gifModel) {
        $this->gif = $gifModel;
        $this->gif_path = $gifModel->getFullPath();
        $this->gfe = new GifFrameExtractor();
        $this->gc  = new GifCreator();
    }

    public function createAndSaveThumbnail() {
        if (GifFrameExtractor::isAnimatedGif($this->gif_path)) {
            $frames = $this->gfe->extract($this->gif_path);

            if ($frames) {
                $first_frame = $frames[0];
                $this->gc->create([$first_frame['image']], [40], 0);

                $filename = UPLOAD_PATH . '/preview_' . $this->gif->path;
                file_put_contents($filename, $this->gc->getGif());
            }
        }
    }
}