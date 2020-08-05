<?php

namespace Doofinder\FeedCompatibility\Plugin;

use Magento\CatalogSearch\Model\ResourceModel\Fulltext\Collection;
use Doofinder\Feed\Helper\StoreConfig;

/**
 * Class Fulltext
 * The class responsible for reset the page size before CatalogSearch collection load.
 */
class Fulltext
{
    /**
     * @var StoreConfig
     */
    private $storeConfig;

    /**
     * Fulltext constructor.
     * @param StoreConfig $storeConfig
     */
    public function __construct(StoreConfig  $storeConfig)
    {
        $this->storeConfig = $storeConfig;
    }

    /**
     * @param Collection $subject
     * @param callable $proceed
     * @param boolean $printQuery
     * @param boolean $logQuery
     * @return void
     */
    public function around_loadEntities(
        Collection $subject,
        callable $proceed,
        $printQuery = false,
        $logQuery = false
    ) {
        if (!$this->storeConfig->isInternalSearchEnabled()) {
            $proceed($printQuery, $logQuery);
            return;
        }

        $pageSize = $subject->getPageSize();
        $subject->setPageSize(false);
        $proceed($printQuery, $logQuery);
        $subject->setPageSize($pageSize);
    }
}
