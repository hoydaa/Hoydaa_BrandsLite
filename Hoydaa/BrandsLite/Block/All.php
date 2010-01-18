<?php

function compareBrands($brand1, $brand2) {
    return strcmp($brand1['label'], $brand2['label']);
}

class Hoydaa_BrandsLite_Block_All extends Mage_Core_Block_Template {

    protected $_brandGroups = null;

    public function hasBrandGroups() {
        $brandGroups = $this->getBrandGroups();
        return !empty($brandGroups);
    }

    public function getBrandGroups() {
        if (is_null($this->_brandGroups)) {
            $brands = $this->helper('brandslite')->getBrands();

            usort($brands, 'compareBrands');

            foreach ($brands as $brand) {
                $this->_brandGroups[strtoupper($brand['label']{0})][] = $brand;
            }
        }

        return $this->_brandGroups;
    }

}
