<?php
/**
 * Copyright © 2015 WideFocus. All rights reserved.
 * http://www.widefocus.net
 */
/**
 * Class WideFocus_WidgetPreviews_Block_Adminhtml_Widget_Preview
 *
 * @author Ashoka de Wit <ashoka@widefocus.net> 
 */
class WideFocus_WidgetPreviews_Block_Adminhtml_Widget_Preview
    extends Mage_Core_Block_Template
{
    /**
     * Should the template chooser be shown
     *
     * @return bool
     */
    public function isTemplateChooserVisible()
    {
        return (bool) Mage::registry('current_widget_instance');
    }

    /**
     * Get the HTML for the template chooser
     *
     * @return string
     */
    public function getTemplateChooserHtml()
    {
        /** @var Mage_Widget_Model_Widget_Instance $widget */
        $widget = Mage::registry('current_widget_instance');
        if (!$widget) {
            return '';
        }

        $block = $this->getLayout()
            ->createBlock('core/html_select')
            ->setOptions($widget->getWidgetTemplates())
            ->setName('widget_preview[template]');

        return $block->toHtml();
    }

    /**
     * Should the store chooser be shown
     *
     * @return bool
     */
    public function isStoreChooserVisible()
    {
        return !Mage::app()->isSingleStoreMode();
    }

    /**
     * Get the HTML for the store chooser
     *
     * @return string
     */
    public function getStoreChooserHtml()
    {
        $block = $this->getLayout()
            ->createBlock('core/html_select')
            ->setOptions(Mage::getModel('adminhtml/system_store')->getStoreValuesForForm())
            ->setValue(Mage::app()->getDefaultStoreView()->getId())
            ->setName('widget_preview[store]');

        return $block->toHtml();
    }

    /**
     * Get the HTML for the refresh button
     *
     * @return string
     */
    public function getRefreshButtonHtml()
    {
        $block = $this->getLayout()
            ->createBlock('adminhtml/widget_button')
            ->setData([
                'label'     => $this->__('Load preview'),
                'class'     => 'show-hide refresh-preview'
            ]);

        return $block->toHtml();
    }

    /**
     * Get the id of the iframe
     *
     * @return string
     */
    public function getIframeId()
    {
        return 'widget_preview_iframe';
    }

    /**
     * Get the URL of the preview
     *
     * @return string
     */
    public function getPreviewUrl()
    {
        return $this->getUrl('*/widefocus_widget/preview');
    }

    /**
     * Get the widget type
     *
     * @return string
     */
    public function getWidgetType()
    {
        $widget = Mage::registry('current_widget_instance');
        if ($widget) {
            return $widget->getType();
        }
        return '';
    }
}
