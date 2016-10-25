<?php
/**
 * Copyright © 2016 Jaagers. All rights reserved.
 */

namespace Jaagers\Sortnavigationlinks\Model\ResourceModel;

class Navigationlinks extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Model Initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('jaagers_sortnavigationlinks', 'entity_id');
    }
}
