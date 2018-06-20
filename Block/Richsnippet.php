<?php
namespace Vrolijkonline\Riviyo\Block;
use \Vrolijkonline\Riviyo\Helper\Data;
 
class Richsnippet extends \Magento\Framework\View\Element\Template
{

	public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Vrolijkonline\Riviyo\Helper\Data $helper,
        array $data = []
    ) {
 
        $this->_helper = $helper;
 
        parent::__construct(
            $context,
            $data
        );
    }

    public function getRiviyoData()
    {
    	if (!$this->_helper->isEnabled()) return false;
    	if (!$this->_helper->getRiviyoConfig('richsnippet_enable')) return false;
    	return [
    		"magento_data" => [
    			"website_name" => $this->_helper->getRiviyoConfig('richsnippet_webshop_name')
    		],
    		"riviyo_data" => $this->_helper->get_data()
    	];
        return 'Hello world!';
    }
}