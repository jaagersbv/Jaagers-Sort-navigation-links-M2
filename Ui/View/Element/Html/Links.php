<?php
namespace Jaagers\Sortnavigationlinks\Ui\View\Element\Html;
class Links
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Jaagers\Sortnavigationlinks\Model\ResourceModel\Navigationlinks\Collection
     */
    protected $collection;

    /**
     * @var \Jaagers\Sortnavigationlinks\Model\Navigationlinks
     */
    protected $model;

    /**
     * @var \Magento\Framework\DataObjectFactory
     */
    protected $dataObjectFactory;

    protected $cache = [];

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Jaagers\Sortnavigationlinks\Model\ResourceModel\Navigationlinks\Collection $collection,
        \Jaagers\Sortnavigationlinks\Model\Navigationlinks $model,
        \Magento\Framework\DataObjectFactory $dataObjectFactory
    ) {
        $this->dataObjectFactory = $dataObjectFactory;
        $this->storeManager = $storeManager;
        $this->collection = $collection;
        $this->model = $model;
    }

    public function instantiateCollection()
    {
        return $this->collection->create();
    }

    public function cmp($a, $b) {
        $a_sort = $a->getSort();
        $b_sort = $b->getSort();

        if($a_sort == $b_sort)
            return 1;

        return ($a_sort < $b_sort) ? -1 : 1;
    }

    private function getCollectionByGroup($group) {

        $collection = [];
        foreach($this->modelCache[$group] as $model) {
            if ((bool)$model->getEnabled())
                $collection[] = $model;
        }

        uasort($collection, array($this, 'cmp'));
        return $collection;
    }

    protected $modelCache = [];

    private function getOrCreateRow($code, $group, $label, $store_id)
    {
        if(!isset($this->modelCache[$group])) {
            $this->collection->getSelect()->reset(\Magento\Framework\DB\Select::WHERE);
            $this->collection->getSelect()->reset(\Magento\Framework\DB\Select::ORDER);

            $collection = $this->collection
                ->clear()
                ->addFieldToSelect('*')
                ->addFieldToFilter('store_id', $store_id);

            $this->modelCache[$group] = [];

            foreach ($collection as $model)
            {
                $this->modelCache[$model->getLinkGroup()][$model->getCode()] = $model;
            }
        }

        if (isset($this->modelCache[$group][$code])) {
            $model = $this->modelCache[$group][$code];

            $model->setData('store_id', $store_id);
            $model->setData('name', $label);
        }
        else {
            $model = $this->model->clearInstance();

            $model->setData(
                [
                    'store_id' => $store_id,
                    'name' => $label,
                    'code' => $code,
                    'sort' => '10000',
                    'link_group' => $group,
                    'enabled' => '1'
                ]
            );
        }

        $model->getResource()->save($model);

        $this->modelCache[$group][$code] = $model;

        return $model;
    }

    public function beforeGetChildHtml(\Magento\Framework\View\Element\Html\Links $subject)
    {
        $layout = $subject->getLayout();
        $group = $subject->getNameInLayout();

        $store_id = $this->storeManager->getStore()->getStoreId();

        if(!isset($this->cache[$group])) {
            $this->cache[$group] = [];
        }

        foreach ($layout->getChildNames($group) as $code) {

            if(!isset($this->cache[$group][$code])) {

                $block = $layout->getBlock($code);

                $model = $this->getOrCreateRow($code, $group, $block->getLabel(), $store_id);

                $this->cache[$group][$code] = [
                    'block' => $block,
                    'model' => $model
                ];
            }

            $model = $this->cache[$group][$code]['model'];

            $is_enabled = (bool)$model->getEnabled();

            if(!$is_enabled) {
                $layout->unsetChild($code, $block->getAlias());
            }
        }

        $collection = $this->getCollectionByGroup($group);

        foreach($collection as $row) {
            $layout->reorderChild($group, $row['code'], null);
        }
    }

    public function aroundGetLinks(\Magento\Framework\View\Element\Html\Links $subject, \Closure $proceed)
    {
        $group = $subject->getNameInLayout();
        $returnValue = $proceed();

        $finalValue = [];
        $filtered_links = [];

        $store_id = $this->storeManager->getStore()->getStoreId();

        foreach ($returnValue as $code => $link) {

            $model = $this->getOrCreateRow($code, $group, (!empty($link->getLabel()) ? $link->getLabel() : __($code)), $store_id);

            $enabled = (bool)$model->getEnabled();

            if ($enabled) {
                $link['sort'] = $model->getSort();
                $filtered_links[$code] = $link;
            }
        }

        $collection = $this->getCollectionByGroup($group);

        foreach($collection as $row) {
            $finalValue[] = $filtered_links[$row->getCode()];
        }

        return $finalValue; // if its object make sure it return same object which you addition data
    }


}