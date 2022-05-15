<?php
/**
* 
* PayU Argentina para Magento 2
* 
* @category     elOOm
* @package      Modulo PayUAr
* @copyright    Copyright (c) 2022 Ã©lOOm (https://eloom.tech)
* @version      2.0.0
* @license      https://opensource.org/licenses/OSL-3.0
* @license      https://opensource.org/licenses/AFL-3.0
*
*/
declare(strict_types=1);

namespace Eloom\PayUAr\Model;

use Eloom\PayU\Gateway\Config\Cc\Config as CcConfig;
use Eloom\PayU\Gateway\Config\Config;
use Eloom\PayUAr\Api\FinancialInterface;
use Magento\Checkout\Model\Session;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Serialize\Serializer\Json;

class Financial implements FinancialInterface {
	
	private $serializer;
	
	private $config;
	
	private $ccConfig;
	
	private $checkoutSession;
	
	public function __construct(Json     $serializer = null,
	                            Config   $config,
	                            CcConfig $ccConfig,
	                            Session  $checkoutSession) {
		
		$this->serializer = $serializer ?: ObjectManager::getInstance()->get(Json::class);
		$this->config = $config;
		$this->ccConfig = $ccConfig;
		$this->checkoutSession = $checkoutSession;
	}
	
	public function getCosts() {
		$quote = $this->checkoutSession->getQuote();
		$storeId = $quote->getStoreId();
		$installmentRanges = $this->ccConfig->getInstallmentRanges($storeId);
		$data = [];
		
		foreach ($installmentRanges as $range) {
			foreach (range($range['from'], $range['to']) as $installment) {
				$interest = floatval($range['interest']);
				
				if (isset($range['tea'])) {
					$data[] = [
						'key' => $installment,
						'tea' => floatval($range['tea']),
						'cft' => round((pow(1 + ($interest / 100), 12) - 1) * 100, 2),
					];
				}
			}
		}
		
		return $this->serializer->serialize(['data' => $data]);
	}
}