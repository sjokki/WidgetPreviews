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

        $previewBlock = $this->getLayout()->getBlock('widget_preview');
        if ($previewBlock) {
            $fieldset->setHtmlContent($previewBlock->toHtml());
        }

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
        return false;
    }
}
