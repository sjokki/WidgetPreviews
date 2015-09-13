<?php
/**
 * Copyright © 2015 WideFocus. All rights reserved.
 * http://www.widefocus.net
 */
/**
 * Class WideFocus_WidgetPreviews_Block_Adminhtml_Widget_Preview_Container
 *
 * @author Ashoka de Wit <ashoka@widefocus.net> 
 */
class WideFocus_WidgetPreviews_Block_Adminhtml_Widget_Preview_Container
    extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Prepare the container for the preview
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $form->setUseContainer(false);

        $fieldset = $form->addFieldset('preview_fieldset', [
            'legend'    => $this->__('Widget Preview'),
            'class'     => 'fieldset-wide',
        ]);

        $fieldset->setHtmlContent($this->getChildHtml());
        $this->setForm($form);
        return $this;
    }

    /**
     * Prepare html output
     *
     * @return string
     */
    protected function _toHtml()
    {
        if (!Mage::getStoreConfigFlag('widefocus_widget_previews/general/enabled')
            || !Mage::getStoreConfigFlag('widefocus_widget_previews/general/enabled_in_wysiwig')
        ) {
            return '';
        }
        return parent::_toHtml();
    }
}
