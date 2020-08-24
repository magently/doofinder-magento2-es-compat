<?php

namespace Doofinder\FeedCompatibility\Model\ResourceModel\Fulltext\Collection;

use Magento\CatalogSearch\Model\ResourceModel\Fulltext\Collection\DefaultFilterStrategyApplyCheckerInterface;

/**
 * Class DefaultFilterStrategyApplyChecker
 * This class add in backward compatibility purposes to check if need to apply old strategy for filter prepare process.
 */
class DefaultFilterStrategyApplyChecker implements DefaultFilterStrategyApplyCheckerInterface
{
    /**
     * Check if this strategy applicable for current engine.
     * @return boolean
     */
    public function isApplicable(): bool
    {
        return false;
    }
}
