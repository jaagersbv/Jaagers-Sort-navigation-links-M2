<?php
namespace Jaagers\Sortnavigationlinks\Ui\Component\DataProvider\SearchResult;

use Magento\Framework\Api;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Psr\Log\LoggerInterface as Logger;

class Navigationlinks extends \Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_request = null;
    protected $_objectManager = null;

    /**
     * @param EntityFactory $entityFactory
     * @param Logger $logger
     * @param FetchStrategy $fetchStrategy
     * @param EventManager $eventManager
     * @param string $mainTable
     * @param string $resourceModel
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function __construct(
        EntityFactory $entityFactory,
        Logger $logger,
        FetchStrategy $fetchStrategy,
        EventManager $eventManager,
        $mainTable,
        \Magento\Framework\App\RequestInterface $request,
        $resourceModel
    ) {
        $this->_request = $request;
        parent::__construct( $entityFactory, $logger, $fetchStrategy, $eventManager, $mainTable, $resourceModel );
    }

    /**
     * @return \Magento\Framework\App\RequestInterface
     */
    private function getRequest(){
        return $this->_request;
    }

    /**
     * @return \Magento\Framework\App\ObjectManager
     */
    private function getObjectManager(){

        if( !$this->_objectManager ){
            $this->_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        }
        return $this->_objectManager;
    }

    /**
     * isAjax=true namespace=authenticate_email_list sorting[direction]=asc sorting[field]=order_id
     * @return $this
     */
    protected function _initSelect() {
        parent::_initSelect();

        $id = $this->getRequest()->getParam('entity_id');
        if( $id ) {
            $link = $this->getObjectManager()->create('Jaagers\Authenticate\Model\Authorder')->load($id);
            if ($link) {
                $this->addEntityIdFilter($link->getId());
            }
        }
        return $this;
    }

    public function addEntityIdFilter( $entity_id = null)
    {
        if( $entity_id )
            $this->addFieldToFilter('entity_id', $entity_id);

        return $this;
    }
}