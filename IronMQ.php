<?php
namespace br0sk\ironmq;

use yii\base\Component;

/**
 * This comopnent let's you use IronMQ V3 in yii2.
 */ 
class IronMQ extends Component
{
    private $_ironmq = null;
	
	private $configArray = [];
 
	//Mandatory config params
	private $_projectId = null;
    private $_token = null;
	
	//Optional config params
	private $_protocol = null;
    private $_host = null;
    private $_port = null;
    private $_apiVersion = null;

    public function init()
    {
        parent::init();
				
        //Mandatory config parameters
		if (!$this->_projectId) {
            throw new InvalidConfigException('ProjectId cannot be empty!');
        }
		else {
			$this->configArray['project_id'] = $this->_projectId;
		}
        if (!$this->_token) {
            throw new InvalidConfigException('WriteKey cannot be empty!');
        }
		else {
			$this->configArray['token'] = $this->_token;
		}
		//Optional config parameters
		if ($this->_protocol !== null) {
			$this->configArray['protocol'] = $this->_protocol;
		}
		if ($this->_host !== null) {
			$this->configArray['host'] = $this->_host;
		}
		if ($this->_port !== null) {
			$this->configArray['port'] = $this->_port;
		}
		if ($this->_protocol !== null) {
			$this->configArray['api_version'] = $this->_apiVersion;
		}		

        //Create a new IronMQ object if it hasn't already been created
        if ($this->_ironmq === null) {
            $this->_ironmq = new \IronMQ\IronMQ($this->configArray);
        }
    }
    
    public function setToken($value) {
		if($value != null) {
			$this->configArray['token'] = $value;
			$this->_token = $value;
		}
		else {
			unset($this->configArray['token']);
			$this->_token = null;
		}
		if($this->_ironmq !== null) {
			$this->_ironmq = new \IronMQ\IronMQ($this->configArray);
        }
		echo("Set token\n");
		var_dump($this->configArray);
	}

    public function getToken() {
        return $this->_token;
    }
    
    public function setProjectId($value) {
		if($value != null) {
			$this->configArray['project_id'] = $value;
			$this->_projectId = $value;
		}
		else {
			unset($this->configArray['project_id']);
			$this->_projectId = null;
		}
        if($this->_ironmq !== null) {
			$this->_ironmq = new \IronMQ\IronMQ($this->configArray);
        }
	}

    public function getProjectId() {
        return $this->_projectId;
    }
	
	public function setProtocol($value) {
		if($value != null) {
			$this->configArray['protocol'] = $value;
			$this->_protocol = $value;
		}
		else {
			unset($this->configArray['protocol']);
			$this->_protocol = null;
		}		if($this->_ironmq !== null) {
			$this->_ironmq = new \IronMQ\IronMQ($this->configArray);
		}
	}

	public function getProtocol() {
		return $this->_protocol;
	}
	
	public function setHost($value) {
		
		if($value != null) {
			$this->configArray['host'] = $value;
			$this->_host = $value;
		}
		else {
			unset($this->configArray['host']);
			$this->_host = null;
		}
		if($this->_ironmq !== null) {
			$this->_ironmq = new \IronMQ\IronMQ($this->configArray);
		}
	}

	public function getHost() {
		return $this->_host;
	}
	
	public function setPort($value) {
		if($value != null) {
			$this->configArray['port'] = $value;
			$this->_port = $value;
		}
		else {
			unset($this->configArray['port']);
			$this->_port = null;
		}
		if($this->_ironmq !== null) {
			$this->_ironmq = new \IronMQ\IronMQ($this->configArray);
		}
	}

	public function getPort() {
		return $this->_port;
	}
    
	public function setApiVersion($value) {
		if($value != null) {
			$this->configArray['api_version'] = $value;
			$this->_apiVersion = $value;
		}
		else {
			unset($this->configArray['api_version']);
			$this->_apiVersion = null;
		}
		if($this->_ironmq !== null) {
			$this->_ironmq = new \IronMQ\IronMQ($this->configArray);
		}
	}

	public function getApiVersion() {
		return $this->_apiVersion;
	}
	
    /**
     * Proxy the calls to the IronMQ object if the methods doesn't explixitly exist in this class.
     * See the getters and setters above for methods that shall work directly on this component
     * rather than on the IronMQ Object. 
     * 
     * If the method called is not found in the Keen Object continue with standard Yii behaviour
     */ 
    public function __call($method, $params)
    {
        //Override the normal Yii functionality checking the Keen SDK for a matching method
        if (method_exists($this->_ironmq, $method)) {
            return call_user_func_array(array($this->_ironmq, $method), $params);
        }
        
        //Use standard Yii functionality, checking behaviours
        return parent::__call($method, $params);
    }
}
