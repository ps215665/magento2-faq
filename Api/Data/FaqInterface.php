<?php

declare(strict_types=1);

namespace Ps\Faq\Api\Data;

interface FaqInterface
{
    public const FAQ_ID = 'faq_id';
    public const TITLE = 'title';
    public const CONTENT = 'content';
    public const STATUS = 'status';

    /**
     * Get faq_id
     *
     * @return int
     */
    public function getFaqId();

    /**
     * Set faq_id
     *
     * @param int $faqId
     * @return \Ps\Faq\Faq\Api\Data\FaqInterface
     */
    public function setFaqId($faqId);

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set title
     *
     * @param string $title
     * @return \Ps\Faq\Faq\Api\Data\FaqInterface
     */
    public function setTitle($title);

    /**
     * Get content
     *
     * @return string
     */
    public function getContent();

    /**
     * Set content
     *
     * @param string $content
     * @return \Ps\Faq\Faq\Api\Data\FaqInterface
     */
    public function setContent($content);

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus();

    /**
     * Set status
     *
     * @param boolean $status
     * @return \Ps\Faq\Faq\Api\Data\FaqInterface
     */
    public function setStatus($status);
}
