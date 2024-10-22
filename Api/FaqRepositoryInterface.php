<?php

declare(strict_types=1);

namespace Ps\Faq\Api;

interface FaqRepositoryInterface
{
    /**
     * Save Faq
     *
     * @param \Ps\Faq\Api\Data\FaqInterface $faq
     * @return \Ps\Faq\Api\Data\FaqInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Ps\Faq\Api\Data\FaqInterface $faq);

    /**
     * Retrieve Faq
     *
     * @param string $faqId
     * @return \Ps\Faq\Api\Data\FaqInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($faqId);

    /**
     * Delete Faq
     *
     * @param \Ps\Faq\Api\Data\FaqInterface $faq
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\Ps\Faq\Api\Data\FaqInterface $faq);

    /**
     * Delete Faq by ID
     *
     * @param string $faqId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($faqId);
}
