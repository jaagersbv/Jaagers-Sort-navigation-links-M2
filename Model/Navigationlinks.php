<?php
/**
 * Copyright © 2016 Jaagers. All rights reserved.
 */

namespace Jaagers\Sortnavigationlinks\Model;

class Navigationlinks extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init('Jaagers\Sortnavigationlinks\Model\ResourceModel\Navigationlinks');
    }
}
