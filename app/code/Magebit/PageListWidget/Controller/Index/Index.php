<?php

declare(strict_types=1);

namespace Magebit\PageListWidget\Controller\Index;

use Magento\Cms\Model\PageFactory;
use Magento\Framework\App\ActionInterface;

class Index implements ActionInterface
{
    protected $pageFactory;

    public function __construct(PageFactory $pageFactory)
    {
        $this->pageFactory = $pageFactory;
    }

    public function execute()
    {
        return $this->pageFactory->create();
    }
}
