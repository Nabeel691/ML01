<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 *
 * Created By: MageDelight Pvt. Ltd.
 */
namespace Magebit\Faq\Ui\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;

class QuestionActions extends Column
{
    const URL_EDIT_PATH = 'faq\question\edit';
    const URL_DELETE_PATH = 'faq\question\delete';
    /*
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;
    /**
     * @param \Magento\Framework\UrlInterface                              $urlBuilder
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Framework\View\Element\UiComponentFactory           $uiComponentFactory
     * @param array                                                        $components
     * @param array                                                        $data
     */
    public function __construct(
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['id'])) {
                    $item[$this->getData('name')] = [
                    'view' => [
                        'href' => $this->urlBuilder->getUrl(
                            static::URL_EDIT_PATH,
                            [
                                'partner' => $item['id']
                            ]
                        ),
                        'label' => __('Edit')
                    ],
                    'delete' => [
                        'href' => $this->urlBuilder->getUrl(
                            static::URL_DELETE_PATH,
                            [
                                'partner' => $item['id']
                            ]
                        ),
                        'label' => __('Delete'),
                        'confirm' => [
                            'title' => __('Delete "${ $.$data.question }"'),
                            'message' => __('Are you sure you wan\'t to delete a "${ $.$data.question }" record?')
                        ]
                    ]
                ];
                }
            }
        }
        return $dataSource;
    }
}
