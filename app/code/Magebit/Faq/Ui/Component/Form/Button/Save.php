<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 *
 * Created By: MageDelight Pvt. Ltd.
 */
namespace Magebit\Faq\Ui\Component\Form\Button;
use Magento\Cms\Block\Adminhtml\Page\Edit\GenericButton;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Ui\Component\Control\Container;
class Save extends GenericButton implements ButtonProviderInterface
{
    /**
     * Get button data
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'faq_question_form.faq_question_form',
                                'actionName' => 'save',
                                'params' => [false],
                            ],
                        ],
                    ],
                ],
            ],
            'class_name' => Container::SPLIT_BUTTON,
            'options' => $this->getOptions(),
        ];

    }
    /**
     * Retrieve options
     *
     * @return array
     */
    protected function getOptions()
    {
        $options[] = [
            'id_hard' => 'save_and_close',
            'label' => __('Save & Close'),
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'faq_question_form.faq_question_form',
                                'actionName' => 'save',
                                'params' => [true],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        return $options;
    }
}
