<?php
class ASM_Modulename_Model_Observer
{

    public function beforeLoadLayout(Varien_Event_Observer $observer) {
	 
	
	if(Mage::app()->getRequest()->getControllerName()=='index' && 
	   Mage::app()->getRequest()->getActionName()=='index' ){
	
        $collection = Mage::getModel('catalog/product')->getCollection()->addAttributeToFilter('show_on_main','1');
        
        //Mage::log($prodIds);
        if($collection->count()){
   
            
	Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);


	$listBlock = Mage::app()->getLayout()->createBlock('catalog/product_list')
		->setTemplate('catalog/product/list.phtml')
		->setCollection($collection);
	
	
	Mage::app()->getLayout()->getBlock('content')->append($listBlock); 


        }
	}

	return $this;
	

    }

}