<?php
/**
 * Copyright © 2015 WideFocus. All rights reserved.
 * http://www.widefocus.net
 */
/**
 * Class WideFocus_WidgetPreviews_Block_Widget_Preview
 *
 * @author Ashoka de Wit <ashoka@widefocus.net> 
 */
class WideFocus_WidgetPreviews_Block_Widget_Preview
    extends Mage_Core_Block_Template
{
    /**
     * Get the preview of the widget
     *
     * @return string
     */
    public function getPreview()
    {
        return Mage::getModel('widget/template_filter')->filter($this->getWidgetCode());
    }

    /**
     * Set the widget code
     *
     * @param string $code
     * @return $this
     */
    public function setWidgetCode($code)
    {
        return $this->setData('widget_code', $code);
    }

    /**
     * Get the widget code
     *
     * @return string
     */
    public function getWidgetCode()
    {
        return $this->getData('widget_code');
    }
}
