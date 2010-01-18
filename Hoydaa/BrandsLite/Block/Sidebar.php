<?php

class Hoydaa_BrandsLite_Block_Sidebar extends Mage_Core_Block_Template {

    protected $_size = null;
    protected $_random = true;
    protected $_brands = null;

    public function setSize($size) {
        $this->_size = $size;
    }

    public function setRandom($random) {
        if (strcasecmp($random, 'true') == 0) {
            $this->_random = true;
        } else if (strcasecmp($random, 'false') == 0) {
            $this->_random = false;
        } else {
            throw new Exception;
        }
    }

    public function hasBrands() {
        $brands = $this->getBrands();
        return !empty($brands);
    }

    public function getBrands() {
        if (is_null($this->_brands)) {
            $this->_brands = $this->pick($this->helper('brandslite')->getBrands(), $this->_size, $this->_random);
        }

        return $this->_brands;
    }

    public function pick($array, $num, $random) {
        $count = count($array);

        if (!$num || $num >= $count) {
            return $array;
        } else if ($num <= 0) {
            throw new Exception;
        }

        $diff = $count - $num;

        if (!$random) {
            $keys = array_slice(array_keys($array), $num, $diff, true);
        } else if ($diff == 1) {
            $keys = array(array_rand($array, $diff));
        } else {
            $keys = array_rand($array, $diff);
        }

        foreach ($keys as $key) {
            unset($array[$key]);
        }

        return $array;
    }

}
