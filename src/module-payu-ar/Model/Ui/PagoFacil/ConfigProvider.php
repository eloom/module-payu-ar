<?php
/**
* 
* PayU Argentina para Magento 2
* 
* @category     elOOm
* @package      Modulo PayUAr
* @copyright    Copyright (c) 2021 Ã©lOOm (https://eloom.tech)
* @version      1.0.3
* @license      https://opensource.org/licenses/OSL-3.0
* @license      https://opensource.org/licenses/AFL-3.0
*
*/
declare(strict_types=1);

namespace Eloom\PayUAr\Model\Ui\PagoFacil;

use Eloom\PayUAr\Gateway\Config\PagoFacil\Config as PagoFacilConfig;
use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Framework\Session\SessionManagerInterface;
use Magento\Framework\Escaper;
use Magento\Framework\View\Asset\Repository;

class ConfigProvider implements ConfigProviderInterface {

	const CODE = 'eloom_payments_payu_pagofacil';

	protected $assetRepo;

	private $config;

	private $session;

	protected $escaper;

	public function __construct(Repository              $assetRepo,
	                            SessionManagerInterface $session,
	                            Escaper                 $escaper,
	                            PagoFacilConfig         $pagoFacilConfig) {
		$this->assetRepo = $assetRepo;
		$this->session = $session;
		$this->escaper = $escaper;
		$this->config = $pagoFacilConfig;
	}

	public function getConfig() {
		$storeId = $this->session->getStoreId();

		$payment = [];
		$isActive = $this->config->isActive($storeId);
		if ($isActive) {
			$payment = [
				self::CODE => [
					'isActive' => $isActive,
					'instructions' => $this->getInstructions($storeId),
					'url' => [
						'logo' => $this->assetRepo->getUrl('Eloom_PayUAr::images/pago-facil.svg')
					]
				]
			];
		}

		return [
			'payment' => $payment
		];
	}

	protected function getInstructions($storeId): string {
		return $this->escaper->escapeHtml($this->config->getInstructions($storeId));
	}
}