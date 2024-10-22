<?php
namespace Ps\Faq\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Ps\Faq\Model\ResourceModel\Faq\CollectionFactory;

class FaqList implements OptionSourceInterface
{
    /** @var CollectionFactory */
    protected $collectionFactory;

    /**
     * Constructor
     *
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
    }
    
    /**
     * Retrieve the list of faq's
     *
     * @return array
     */
    public function toOptionArray()
    {
        $collection = $this->collectionFactory->create();
        $options = [];

        foreach ($collection as $faq) {
            $options[] = [
                'value' => $faq->getFaqId(),
                'label' => $faq->getTitle(),
            ];
        }

        return $options;
    }
}
