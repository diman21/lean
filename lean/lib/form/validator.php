<?php
namespace lean\form;

interface Validator {

    /**
     * @abstract
     * @param mixed  $value
     * @param string $message
     * @return boolean
     */
    public function isValid($value, &$messages = array());
}

abstract class Validator_Abstract implements Validator {
    private $messages;
    public function __construct($messages = array()) {
        $this->messages = $messages;
    }

    public function getErrorMessage($error) {
        if(!array_key_exists($error, $this->messages))
            throw new \lean\Exception("Error message not found for key '$error'");
        return $this->messages[$error];
    }
}

class Validator_Mandatory extends Validator_Abstract {

    const ERR_NO_VALUE = 'no_value_set';

    /**
     * @param mixed  $value
     * @param string $message
     * @return boolean
     */
    public function isValid($value, &$messages = array()) {
        if($value === null || is_string($value) && !strlen($value)) {
            $messages[] = $this->getErrorMessage(self::ERR_NO_VALUE);
            return false;
        }

        return true;
    }
}

class Validator_Equal extends Validator_Abstract {

    const ERR_NOT_EQUAL = 'not_equal';

    /**
     * @var Element
     */
    private $compare;

    /**
     * @param array $messages
     * @param \lean\form\Element $compareElement
     */
    public function __construct($messages = array(), Element $compareElement) {
        parent::__construct($messages);

        $this->compare = $compareElement;
    }

    /**
     * @param mixed  $value
     * @param string $message
     * @return boolean
     */
    public function isValid($value, &$messages = array()) {
        if($value != $this->compare->getValue()) {
            $messages[] = $this->getErrorMessage(self::ERR_NOT_EQUAL);
            return false;
        }

        return true;
    }
}