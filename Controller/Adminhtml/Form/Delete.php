<?php

declare(strict_types=1);

namespace Ps\Faq\Controller\Adminhtml\Form;

use Magento\Backend\App\Action\Context;
use Ps\Faq\Api\FaqRepositoryInterface;

class Delete extends \Magento\Backend\App\Action
{

    /**@var FaqRepositoryInterface */
    private $faqRepository;

    /**
     * Constructor
     *
     * @param Context $context
     * @param FaqRepositoryInterface $faqRepository
     */
    public function __construct(
        Context $context,
        FaqRepositoryInterface $faqRepository
    ) {
        parent::__construct($context);
        $this->faqRepository = $faqRepository;
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        $id = $this->getRequest()->getParam('faq_id');

        if ($id) {
            try {
                $this->faqRepository->deleteById($id);
                $this->messageManager->addSuccessMessage(__('You deleted the Faq.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['faq_id' => $id]);
            }
        }

        $this->messageManager->addErrorMessage(__('We can\'t find a Faq to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}
