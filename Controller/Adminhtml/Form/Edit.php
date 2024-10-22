<?php

declare(strict_types=1);

namespace Ps\Faq\Controller\Adminhtml\Form;

use Ps\Faq\Api\FaqRepositoryInterface;

class Edit extends \Magento\Backend\App\Action
{
    public const ADMIN_RESOURCE = 'Ps_Faq::main';

    /** @var PageFactory */
    protected $resultPageFactory;

    /**@var FaqRepositoryInterface */
    private $faqRepository;

    /**
     * Constructor
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param FaqRepositoryInterface $faqRepository
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        FaqRepositoryInterface $faqRepository
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
        $this->faqRepository = $faqRepository;
    }

    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('faq_id');
        $faq = null;

        if ($id) {
            try {
                $faq = $this->faqRepository->get($id);

                if (!$faq || !$faq->getFaqId()) {
                    $this->messageManager->addErrorMessage(__('This Faq no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Error occurred while loading the FAQ.'));
                return $resultRedirect->setPath('*/*/');
            }
        }

        $resultPage = $this->resultPageFactory->create();
        $breadcrumbTitle = $id ? __('Edit Faq') : __('New Faq');

        $resultPage->setActiveMenu(self::ADMIN_RESOURCE)
                ->addBreadcrumb($breadcrumbTitle, $breadcrumbTitle);

        $resultPage->getConfig()->getTitle()->prepend(__('Faqs'));
        $resultPage->getConfig()->getTitle()->prepend($id ? __('Edit Faq %1', $faq->getFaqId()) : __('New Faq'));

        return $resultPage;
    }
}
