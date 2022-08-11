<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details
 *
 * Created By: MageDelight Pvt. Ltd.
 */
namespace Magebit\Faq\Ui\Component\Form\Button;

use Magento\Backend\Block\Widget\Context;
use Magento\Cms\Block\Adminhtml\Page\Edit\GenericButton;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Delete extends GenericButton implements ButtonProviderInterface
{
    /**
     * @var Context
     */
    protected $context;
    /**
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        $this->context = $context;
    }
    /**
     * Get button data
     *
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        $id = $this->context->getRequest()->getParam('id');
        if ($id) {
            $data = [
                'label' => __('Delete'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                    'Are you sure to do this?'
                ) . '\', \'' . $this->getDeleteUrl() . '\')',
                'sort_order' => 20,
            ];
        }
        return $data;
    }
    /**
     * @return string
     */
    public function getDeleteUrl()
    {
        $id = $this->context->getRequest()->getParam('id');
        return $this->getUrl('*/*/delete', ['id' => $id]);
    }
}
