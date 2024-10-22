<?php

declare(strict_types=1);

namespace Ps\Faq\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Ps\Faq\Api\Data\FaqInterface;
use Ps\Faq\Api\Data\FaqInterfaceFactory;
use Ps\Faq\Api\FaqRepositoryInterface;
use Ps\Faq\Model\ResourceModel\Faq as ResourceFaq;
use Ps\Faq\Model\ResourceModel\Faq\CollectionFactory as FaqCollectionFactory;

class FaqRepository implements FaqRepositoryInterface
{

    /** @var ResourceFaq */
    protected $resource;

    /** @var Faq */
    protected $searchResultsFactory;

    /** @var FaqInterfaceFactory */
    protected $faqFactory;

    /** @var FaqCollectionFactory */
    protected $faqCollectionFactory;

    /**
     * Constructor
     *
     * @param ResourceFaq $resource
     * @param FaqInterfaceFactory $faqFactory
     * @param FaqCollectionFactory $faqCollectionFactory
     */
    public function __construct(
        ResourceFaq $resource,
        FaqInterfaceFactory $faqFactory,
        FaqCollectionFactory $faqCollectionFactory
    ) {
        $this->resource = $resource;
        $this->faqFactory = $faqFactory;
        $this->faqCollectionFactory = $faqCollectionFactory;
    }

    /**
     * @inheritDoc
     */
    public function save(FaqInterface $faq)
    {
        try {
            $this->resource->save($faq);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the faq: %1',
                $exception->getMessage()
            ));
        }
        return $faq;
    }

    /**
     * @inheritDoc
     */
    public function get($faqId)
    {
        $faq = $this->faqFactory->create();
        $this->resource->load($faq, $faqId);
        if (!$faq->getFaqId()) {
            throw new NoSuchEntityException(__('Faq with id "%1" does not exist.', $faqId));
        }
        return $faq;
    }

    /**
     * @inheritDoc
     */
    public function delete(FaqInterface $faq)
    {
        try {
            $faqModel = $this->faqFactory->create();
            $this->resource->load($faqModel, $faq->getFaqId());
            $this->resource->delete($faqModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Faq: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($faqId)
    {
        return $this->delete($this->get($faqId));
    }
}
