<?php

declare(strict_types=1);

namespace Ps\Faq\Model\ResourceModel\Faq;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'faq_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Ps\Faq\Model\Faq::class,
            \Ps\Faq\Model\ResourceModel\Faq::class
        );
    }
}
