<?php

declare(strict_types=1);

namespace Ps\Faq\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Ps\Faq\Model\ResourceModel\Faq\CollectionFactory;

class Faq extends Template implements BlockInterface
{
    /** @var string */
    protected $_template = 'Ps_Faq::widget/faqs.phtml';

    /** @var CollectionFactory */
    private $collectionFactory;

    /**
     * Constructor
     *
     * @param Template\Context $context
     * @param CollectionFactory $collectionFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * Get faqs
     *
     * @return \Magento\Framework\Data\Collection
     */
    public function getFaqs()
    {
        $faqIds = explode(',', $this->getData('faq_ids'));

        $faqCollection = $this->collectionFactory->create()
            ->addFieldToFilter('faq_id', ['in' => $faqIds])
            ->addFieldToFilter('status', 1);

        return $faqCollection;
    }
}
