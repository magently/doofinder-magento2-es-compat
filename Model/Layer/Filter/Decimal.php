<?php

namespace Doofinder\FeedCompatibility\Model\Layer\Filter;

use Magento\CatalogSearch\Model\Layer\Filter\Decimal as BaseDecimal;

/**
 * Class Decimal
 */
class Decimal extends BaseDecimal
{
    /**
     * {@inheritDoc}
     *
     * @param float|string $fromPrice
     * @param float|string $toPrice
     *
     * @return \Magento\Framework\Phrase
     */
    protected function renderRangeLabel($fromPrice, $toPrice)
    {
        /**
         * Since Magento 2.3.2 $toPrice from the last range is expected to be null instead of an empty string.
         */
        if ($toPrice === '') {
            $toPrice = null;
        }

        return parent::renderRangeLabel($fromPrice, $toPrice);
    }
}
