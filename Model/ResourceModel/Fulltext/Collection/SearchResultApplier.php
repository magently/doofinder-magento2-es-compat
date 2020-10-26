<?php

namespace Doofinder\FeedCompatibility\Model\ResourceModel\Fulltext\Collection;

use Magento\CatalogSearch\Model\ResourceModel\Fulltext\Collection\SearchResultApplierInterface;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\Data\Collection;
use Magento\CatalogSearch\Model\ResourceModel\Fulltext\Collection as FulltextCollection;
use Magento\Framework\DB\Select;
use Zend_Db_Expr;

/**
 * Class SearchResultApplier
 * Applier for search results
 */
class SearchResultApplier implements SearchResultApplierInterface
{
    /**
     * @var Collection|FulltextCollection
     */
    private $collection;

    /**
     * @var SearchResultInterface
     */
    private $searchResult;

    /**
     * @var integer
     */
    private $size;

    /**
     * @var integer
     */
    private $currentPage;

    /**
     * @param Collection $collection
     * @param SearchResultInterface $searchResult
     * @param integer|null $size
     * @param integer|null $currentPage
     */
    public function __construct(
        Collection $collection,
        SearchResultInterface $searchResult,
        int $size = null,
        int $currentPage = null
    ) {
        $this->collection = $collection;
        $this->searchResult = $searchResult;
        $this->size = $size;
        $this->currentPage = $currentPage;
    }

    /**
     * @return void
     */
    public function apply()
    {
        if (empty($this->searchResult->getItems())) {
            $this->collection->getSelect()->where('NULL');
            return;
        }

        if (!$this->size) {
            $this->size = (int) $this->collection->getPageSize();
        }
        if (!$this->currentPage) {
            $this->currentPage = (int) $this->collection->getCurPage();
        }

        $items = $this->searchResult->getItems();
        $ids = [];
        foreach ($items as $item) {
            $ids[] = (int) $item->getId();
        }

        $this->collection->getSelect()->where('e.entity_id IN (?)', $ids);
        $orderList = join(',', $ids);
        $this->collection->getSelect()->reset(Select::ORDER);
        $this->collection->getSelect()->order(new Zend_Db_Expr("FIELD(e.entity_id,$orderList)"));
    }
}
