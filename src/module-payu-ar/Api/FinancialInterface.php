<?php
/**
* 
* PayU Argentina para Magento 2
* 
* @category     Ã©lOOm
* @package      Modulo PayUAr
* @copyright    Copyright (c) 2021 Ã©lOOm (https://www.eloom.com.br)
* @version      1.0.0
* @license      https://opensource.org/licenses/OSL-3.0
* @license      https://opensource.org/licenses/AFL-3.0
*
*/
declare(strict_types=1);

namespace Eloom\PayUAr\Api;

/**
 * Interface for Financial Costs.
 * @api
 * @since 100.0.2
 */
interface FinancialInterface {
	
	/**
	 * Get costs.
	 *
	 * @return string
	 * @throws \Magento\Framework\Exception\LocalizedException
	 */
	public function getCosts();
}