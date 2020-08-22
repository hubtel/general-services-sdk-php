<?php



namespace HubtelUssdFramework;

/**
 * Represents ussd responses to be sent to SMSGH.
 * 
 *
 */
class UssdResponse
{
    /**
     * @var string
     */
    const RESPONSE_TYPE_RESPONSE = "Response";

    /**
     * @var string
     */
    const RESPONSE_TYPE_RELEASE = "Release";

    /**
     * @var string
     */
    const RESPONSE_TYPE_ADDTOCART = "AddToCart";

    /**
     * @var string
     */
    private $_sessionId;

    /**
     * @var string
     */
    private $_type;

    /**
     * @var string
     * @access private
     */
    private $_message;

    /**
     * @var string
     */
    private $_mask;

    /**
     * @var string
     */
    private $_maskNextRoute;

    /**
     * @var CartItem
     */
    private $_item;

    /**
     * @var string
     */
    private $_serviceCode;

    /**
     * @var string
     */
    private $_label;

    /**
     * @var string
     */
    private $_dataType;

    /**
     * @var DataItem
     */
    private $_data;

    /**
     * @var addTocart
     */
    private $_addToCart;



    /**
     * @var \Exception
     */
    private $_exception;

    /**
     * @var string
     */
    private $_nextRoute;

    /**
     * @var bool
     */
    private $_redirect;

    /**
     * @var bool
     */
    private $_autoDialOn;

    /**
     * @var string
     */
    private $_fieldType;

    function __construct()
    {
        $this->_redirect = false;
        $this->_autoDialOn = true;
    }

    function isRelease()
    {
        return $this->_nextRoute === null;
    }

    function setType($type)
    {
        $this->_type = $type;
    }


    function isAutoDialOn()
    {
        return $this->_autoDialOn;
    }
    /**
     * Sets whether or not auto dial processing should be continued.
     * For example, framework uses this property to end auto dial when 
     * input validation fails for menus and form options.
     * 
     * @param bool $autoDialOn true to continue auto dial processing, false
     *             to end it.
     */
    function setAutoDialOn($autoDialOn)
    {
        if (!is_bool($autoDialOn)) {
            throw new \InvalidArgumentException('"autoDialOn" argument is not ' .
                'a boolean: ' . var_export($autoDialOn, true));
        }
        $this->_autoDialOn = $autoDialOn;
    }
    /**
     * @return bool
     */
    function isRedirect()
    {
        return $this->_redirect;
    }

    /**
     * @return string
     */
    function getNextRoute()
    {
        return $this->_nextRoute;
    }

    function setSessionId($sessionId)
    {
        $this->_sessionId = $sessionId;
    }

    /**
     * Used internally by framework. See SMSGH USSD documentation 
     * for details. Please do not edit!!!
     * 
     * @param string $clientState
     */
    function setClientState($clientState)
    {
        if ($clientState !== null && !is_string($clientState)) {
            throw new \InvalidArgumentException('"clientState" argument is not ' .
                'a string: ' . var_export($clientState, true));
        }
        $this->_clientState = $clientState;
    }
    /**
     * Gets any exception which occured during the processing of a 
     * ussd request.
     * 
     * @return \Exception ussd request processing error or null if no such 
     *                    error occured.
     */
    function getException()
    {
        return $this->_exception;
    }

    /**
     * @param UssdResponse $instance
     * 
     * @return string
     */
    static function toJson($instance)
    {
        $arr = array(
                'sessionId' => $instance->getSessionId(),
                'type' => $instance->getType(),
                'message' => $instance->getMessage(),
                "mask" => $instance->getMask(),
                "maskNextRoute" => $instance->getMaskNextRoute(),
                "item" => $instance->getItem(),
                "serviceCode" => $instance->getServiceCode(),
                "label" => $instance->getLabel(),
                "dataType" => $instance->getDataType(),
                "fieldType" => $instance->getFieldType(),
                'data' => $instance->getData(),
                'addToCart' => $instance->getAddToCart()
        );
        $json = json_encode($arr);
        return $json;
    }
    /**
     * Gets the type of the ussd response. SMSGH uses this to determine whether
     * or not session has ended.
     * 
     * @return string type of ussd response
     */
    function getSessionId()
    {
        return $this->_sessionId;
    }

    function getType()
    {
        return $this->_type;
    }

    /**
     * Gets ussd response message.
     * 
     * @return string ussd response message.
     */
    function getMessage()
    {
        return $this->_message;
    }

    function getMask()
    {
        return $this->_mask;
    }

    function getMaskNextRoute()
    {
        return $this->_maskNextRoute;
    }

    function getItem()
    {
        return $this->_item;
    }

    function getServiceCode()
    {
        return $this->_serviceCode;
    }

    function getLabel()
    {
        return $this->_label;
    }

    function getDataType()
    {
        return $this->_dataType;
    }

    function getFieldType()
    {
        return $this->_fieldType;
    }

    function getAddToCart()
    {
        return $this->_addToCart;
    }

    function getData()
    {
        return $this->_data;
    }

    function setException($exception)
    {
        if ($exception !== null && !($exception instanceof \Exception)) {
            throw new \InvalidArgumentException('"exception" argument is not ' .
                'an Exception: ' . var_export($exception, true));
        }
        $this->_exception = $exception;
    }





    public static function Render($message, $nextRoute = null, $dataItems = null, $cartItem = null, $label = null, $dataType = null, $fieldType = '', $sessionId = null, $mask = false, $maskNextRoute = null, $serviceCode = null, $addToCart=null)
    {
        return !($dataItems || $cartItem || $label || $dataType || $fieldType) ? self::RenderMessageOnly($message, $nextRoute) : self::RenderMessageWithList($message, $nextRoute, $dataItems, $cartItem, $label, $dataType, $fieldType, $sessionId, $mask, $maskNextRoute, $serviceCode, $addToCart);
    }

    private static function RenderMessageOnly($message, $nextRoute = null, $addToCart)
    {
        $response = new self;
        $response->_type = $nextRoute ? self::RESPONSE_TYPE_RESPONSE : self::RESPONSE_TYPE_RELEASE;
        $response->_message = $message;
        $response->_nextRoute = $nextRoute;
        $response->_addToCart = $addToCart;
        return $response;
    }

    private static function RenderMessageWithList($message, $nextRoute = null, $dataItems = null, $cartItem = null, $label = null, $dataType = null, $fieldType = '', $sessionId = null, $mask = false, $maskNextRoute = null, $serviceCode = null, $addToCart = null)
    {
        $response = new self;
        $response->_sessionId = $sessionId;
        $response->_type = $nextRoute ? self::RESPONSE_TYPE_RESPONSE : self::RESPONSE_TYPE_RELEASE;
        $response->_message = $message;
        $response->_mask = $mask;
        $response->_maskNextRoute = $maskNextRoute;
        $response->_nextRoute = $nextRoute;
        $response->_item = $cartItem;
        $response->_serviceCode = $serviceCode;
        $response->_label = $label;
        $response->_dataType = $dataType;
        $response->_data = $dataItems;
        $response->_fieldType = $fieldType;
        $response->_addToCart = $addToCart;
        return $response;
    }


    public static function AddToCart($message,  $data = '', $sessionId = null, $nextRoute = null, $mask = false)
    {
        $response = new self;
        $response->_sessionId = $sessionId;
        $response->_type = $nextRoute ? self::RESPONSE_TYPE_RELEASE : self::RESPONSE_TYPE_ADDTOCART;
        $response->_message = $message;
        $response->_mask = $mask;
        $response->_item = $data;
        $response->_data = [];
        $response->_dataType = DataType::DISPLAY;
        $response->_fieldType = FieldTypes::TEXT;
        $response->_nextRoute = $nextRoute;
        return $response;
    }

    public static function redirect($nextRoute = null)
    {
        $response = new self;
        $response->_nextRoute = $nextRoute;
        $response->_redirect = true;
        return $response;
    }
}
