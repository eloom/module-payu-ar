<?php
/**
* 
* PayU Argentina para Magento 2
* 
* @category     Ã©lOOm
* @package      Modulo PayUAr
* @copyright    Copyright (c) 2021 Ã©lOOm (https://eloom.tech)
* @version      1.0.1
* @license      https://opensource.org/licenses/OSL-3.0
* @license      https://opensource.org/licenses/AFL-3.0
*
*/
declare(strict_types=1);

namespace Eloom\PayUAr\Block\Adminhtml\Form\Field;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;

class Installments extends AbstractFieldArray {
	
	/**
	 * Prepare rendering the new field by adding all the needed columns
	 */
	protected function _prepareToRender() {
		$this->addColumn('from', ['label' => __('From'), 'class' => 'required-entry validate-number']);
		$this->addColumn('to', ['label' => __('To'), 'class' => 'required-entry validate-number']);
		$this->addColumn('interest', ['label' => __('Interest (a.m.)'), 'class' => 'required-entry validate-number']);
		$this->addColumn('tea', ['label' => __('TEA (a.a.)'), 'class' => 'required-entry validate-number']);
		
		$this->_addAfter = false;
		$this->_addButtonLabel = __('Add');
	}
	
}