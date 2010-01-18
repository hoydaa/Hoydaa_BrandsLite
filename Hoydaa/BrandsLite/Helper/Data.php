<?php

class Hoydaa_BrandsLite_Helper_Data extends Mage_Core_Helper_Abstract {

    protected $_brands = null;

    public function getBrands() {
        if (is_null($this->_brands)) {
            $this->_brands = Mage::getModel('eav/config')->getAttribute('catalog_product', 'manufacturer')
                ->getSource()->getAllOptions(false);
        }

        return $this->_brands;
    }

}
