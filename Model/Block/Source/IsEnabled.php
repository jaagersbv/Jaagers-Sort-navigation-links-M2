<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Jaagers\Sortnavigationlinks\Model\Block\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class IsActive
 */
class IsEnabled implements OptionSourceInterface
{
    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];

        $options[] = [
            'value' => 0,
            'label' => __("Disabled"),
        ];
        $options[] = [
            'value' => 1,
            'label' => __("Enabled"),
        ];

        return $options;
    }
}
