<?php
namespace GifTube\services;

use GifTube\models\BaseModel;
use GifTube\models\queries\BaseQuery;

class Paginator {

    protected $totalResults;
    protected $totalPages;

    protected $itemsPerPage = 9;
    protected $currentPage = 1;

    /**
     * @var BaseModel[]
     */
    protected $items = [];

    /**
     * @var ModelFactory
     */
    protected $modelFactory;

    /**
     * @var BaseModel
     */
    protected $model;

    /**
     * @var BaseQuery
     */
    protected $query;

    /**
     * Paginator constructor.
     * @param ModelFactory $modelFactory
     * @param BaseModel $model
     */
    public function __construct(ModelFactory $modelFactory, BaseModel $model) {
        $this->modelFactory = $modelFactory;
        $this->model = $model;

        $this->query = $model->getQuery();
    }

    /**
     * @return int
     */
    public function getItemsPerPage(): int {
        return $this->itemsPerPage;
    }

    /**
     * @param int $itemsPerPage
     */
    public function setItemsPerPage(int $itemsPerPage) {
        $this->itemsPerPage = $itemsPerPage;

        return $this;
    }

    public function isLastPage() {
        return $this->currentPage == $this->totalPages;
    }

    /**
     * @return int
     */
    public function getCurrentPage() {
        return $this->currentPage;
    }

    /**
     * @param int $currentPage
     */
    public function setCurrentPage(int $currentPage) {
        $this->currentPage = $currentPage;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalResults() {
        return $this->totalResults;
    }

    /**
     * @return mixed
     */
    public function getTotalPages() {
        return $this->totalPages;
    }

    /**
     * @return \GifTube\models\BaseModel[]
     */
    public function getItems(): array {
        return $this->items;
    }

    public function init($method_name, $parameters = array()) {
        if (method_exists($this->query, $method_name)) {
            call_user_func_array([$this->query, $method_name], $parameters);

            $this->totalResults = (int) $this->model->getScalarValue($this->query->getCountSql());
            $this->totalPages   = ceil($this->totalResults / $this->itemsPerPage);
            $offset = ($this->currentPage - 1) * $this->itemsPerPage;

            $this->query->setOffset($offset);
            $this->query->setLimit($this->itemsPerPage);

            $sql = $this->query->getSql();
            $this->items = $this->modelFactory->getAllByQuery(get_class($this->model), $sql);
        }
    }

    public function getPagesNumbers($limit = 5) {
        $curPage = $this->currentPage;

        $limit = $limit > $this->totalPages ? $this->totalPages : $limit;
        $loop_limit = $limit - 2;

        if ($this->totalPages <= $limit) {
            $pages = range(1, $this->totalPages);
        }
        else {
            switch ($curPage) {
                case 1:
                    $pages = range(1, $loop_limit + 1);
                    break;
                case $this->totalPages:
                    $pages = range($this->totalPages - $loop_limit, $this->totalPages - 1);
                    array_unshift($pages, 1);
                    break;
                case $curPage == 2:
                    $pages = array_merge([1, 2], range(3, 3 + (1 * ($loop_limit - 2))));
                    break;
                case $this->totalPages - 1:
                    $pages = [1];
                    $pages = array_merge($pages, range(($this->totalPages - $loop_limit), $this->totalPages - 1));
                    break;
                default:
                    $pad = ($loop_limit - 1) / 2;
                    $pages = [1];

                    for ($i = $pad; $i >= $pad * -1; $i--) {
                        $number = $this->currentPage - $i;
                        $page = $i == 0 ? $curPage : $number;
                        $pages[] = $page;
                    }
                    break;
            }

            $pages[] = $this->totalPages;
        }

        return $pages;
    }

    public function getUrl($uri, $page) {
        if (!$uri) {
            $url = '?page=' . $page;
        }
        else {
            parse_str($uri, $parts);
            $parts['page'] = $page;
            $query = http_build_query($parts);

            $url = '?' . $query;
        }

        return $url;
    }
}