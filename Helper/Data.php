<?php
 
namespace Vrolijkonline\Riviyo\Helper;
use \Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;
 
class Data extends AbstractHelper
{
	const XML_PATH_RIVIYO = 'riviyo/';

	private $riviyo_data = [];

    public function __construct(
    	\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
   	){
   		$this->scopeConfig = $scopeConfig;
    	$this->load_riviyo_api_data();
    }

    private function load_riviyo_api_data(){
    	$this->riviyo_data = json_decode(file_get_contents('https://www.riviyo.nl/reviews/mutsaars-bikes/2ffced5ddc437df3b94954cd5a85d525'));

    }

    public function get_data(){
    	return $this->riviyo_data;
    }


    public function getConfigValue($field, $storeId = null)
	{
		return $this->scopeConfig->getValue(
			$field, ScopeInterface::SCOPE_STORE, $storeId
		);
	}

	public function getGeneralConfig($code, $storeId = null)
	{

		return $this->getConfigValue(self::XML_PATH_RIVIYO .'general/'. $code, $storeId);
	}

	public function getRiviyoConfig($code, $storeId = null)
	{

		return $this->getConfigValue(self::XML_PATH_RIVIYO .'riviyo/'. $code, $storeId);
	}

	public function isEnabled(){
		return $this->getGeneralConfig('enable');
	}
}