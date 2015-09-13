<?php
/**
 * Copyright © 2015 WideFocus. All rights reserved.
 * http://www.widefocus.net
 */
/**
 * Class _Block_Tab
 *
 * @author Ashoka de Wit <ashoka@widefocus.net> 
 */
class WideFocus_WidgetPreviews_Block_Adminhtml_Widget_Instance_Edit_Tab_Preview
    extends Mage_Adminhtml_Block_Widget_Form
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
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
     * Return Tab label
     *
     * @return string
     */
    public function getTabLabel()
    {
        return $this->__('Widget Preview');
    }

    /**
     * Return Tab title
     *
     * @return string
     */
    public function getTabTitle()
    {
        return $this->__('Widget Preview');
    }

    /**
     * Can show tab in tabs
     *
     * @return boolean
     */
    public function canShowTab()
    {
        if (Mage::registry('current_widget_instance')) {
            return Mage::registry('current_widget_instance')->isCompleteToCreate();
        }
        return true;
    }

    /**
     * Tab is hidden
     *
     * @return boolean
     */
    public function isHidden()
    {
        return !Mage::getStoreConfigFlag('widefocus_widget_previews/general/enabled')
            || !Mage::getStoreConfigFlag('widefocus_widget_previews/general/enabled_in_instance');
    }
}
