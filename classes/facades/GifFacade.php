<?php
namespace GifTube\facades;

use GifTube\models\GifModel;
use GifTube\models\UserModel;
use GifTube\services\FileUploader;
use GifTube\services\GifConverter;
use GifTube\services\ModelFactory;

class GifFacade {

    /**
     * @var ModelFactory
     */
    protected $modelFactory;

    /**
     * @var GifModel
     */
    protected $model;

    /**
     * @var FileUploader
     */
    protected $uploader;

    /**
     * @var UserModel
     */
    protected $user;

    /**
     * GifFacade constructor.
     * @param ModelFactory $modelFactory
     * @param GifModel $model
     * @param FileUploader $uploader
     * @param UserModel $userModel
     */
    public function __construct(ModelFactory $modelFactory, GifModel $model, FileUploader $uploader, UserModel $userModel) {
        $this->modelFactory = $modelFactory;
        $this->model = $model;
        $this->uploader = $uploader;
        $this->user = $userModel;
    }

    /**
     * @param array $form_data
     * @return GifModel
     */
    public function createAndSaveGif(array $form_data) {
        $path = $this->uploader->generateFilename('gif');
        $this->uploader->upload($path);

        $gif_data = array_merge($form_data, ['path' => $path]);
        $id = $this->model->createNewGif($this->user->id, $gif_data);

        /**
         * @var GifModel $model
         */
        $model = $this->modelFactory->load(get_class($this->model), $id);

        $gifConverter = new GifConverter($model);
        $gifConverter->createAndSaveThumbnail();

        return $model;
    }
}