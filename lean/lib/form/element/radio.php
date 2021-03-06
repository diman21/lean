<?php
namespace lean\form\element;

/**
 * Radio form element
 */
class Radio extends \lean\form\Element {

    protected $options;
    protected $tabindex;

    /**
     * @param       $name
     * @param array $options
     */
    public function __construct($name, $options, $label = '', $tabindex = null) {
        parent::__construct($name, $label);
        $this->options = $options;
        $this->tabindex = $tabindex;
    }

    /**
     * get options
     * @return array
     */
    public function getOptions() {
        return $this->options;
    }

    /**
     * @return Text
     */
    public function display($key = null) {
        if ($key === null) {
            foreach ($this->options as $key => $option) {
                $this->display($key);
            }
            return $this;
        }
        $label = '';
        $title = $this->options[$key];
        if (mb_strlen(trim($title)) > 0) {
            $label = sprintf('<label for="%s_%s">%s</label>', $this->getId(), $key, $title);
        }
        printf('<input %1$s type="radio" name="%2$s" id="%2$s_%3$s" value="%3$s" %4$s %5$s/>%6$s',
            $this->getAttributeString(),
            $this->getId(),
            $key,
            $this->tabindex !== null
                ? 'tabindex="' . $this->tabindex++ . '"'
                : '',
            $key == $this->getValue()
                ? ' checked="checked"'
                : '', $label);
        return $this;
    }
}