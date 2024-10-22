<?php

declare(strict_types=1);

namespace Ps\Faq\Model;

use Magento\Framework\Model\AbstractModel;
use Ps\Faq\Api\Data\FaqInterface;

class Faq extends AbstractModel implements FaqInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Ps\Faq\Model\ResourceModel\Faq::class);
    }

    /**
     * @inheritDoc
     */
    public function getFaqId()
    {
        return $this->getData(self::FAQ_ID);
    }

    /**
     * @inheritDoc
     */
    public function setFaqId($faqId)
    {
        return $this->setData(self::FAQ_ID, $faqId);
    }

    /**
     * @inheritDoc
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * @inheritDoc
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * @inheritDoc
     */
    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * @inheritDoc
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * @inheritDoc
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * @inheritDoc
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }
}
