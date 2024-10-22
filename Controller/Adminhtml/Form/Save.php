<?php

declare(strict_types=1);

namespace Ps\Faq\Controller\Adminhtml\Form;

use Ps\Faq\Model\FaqFactory;
use Ps\Faq\Api\Data\FaqInterface;
use Ps\Faq\Api\FaqRepositoryInterface;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Request\DataPersistorInterface;

class Save extends \Magento\Backend\App\Action
{
    /** @var DataPersistorInterface */
    protected $dataPersistor;

    /** @var FaqRepositoryInterface */
    private $faqRepository;

    /** @var DataObjectHelper */
    private $dataObjectHelper;

    /** @var FaqFactory */
    private $faqFactory;

    /**
     * Constructor
     *
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param FaqFactory $faqFactory
     * @param FaqRepositoryInterface $faqRepository
     * @param DataObjectHelper $dataObjectHelper
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        FaqFactory $faqFactory,
        FaqRepositoryInterface $faqRepository,
        DataObjectHelper $dataObjectHelper
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->faqFactory = $faqFactory;
        $this->faqRepository = $faqRepository;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            $id = $this->getRequest()->getParam('faq_id');

            if ($id) {
                $faq = $this->faqRepository->get($id);
                if (!$faq->getFaqId()) {
                    $this->messageManager->addErrorMessage(__('This Faq no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            } else {
                $faq = $this->faqFactory->create();
            }

            $this->dataObjectHelper->populateWithArray(
                $faq,
                $data,
                FaqInterface::class
            );

            try {
                $this->faqRepository->save($faq);
                $this->messageManager->addSuccessMessage(__('You saved the Faq.'));
                $this->dataPersistor->clear('faq');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['faq_id' => $faq->getFaqId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Faq.'));
            }

            $this->dataPersistor->set('faq', $data);
            return $resultRedirect->setPath('*/*/edit', ['faq_id' => $this->getRequest()->getParam('faq_id')]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}
