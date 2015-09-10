<?php
/**
 * Copyright © 2015 WideFocus. All rights reserved.
 * http://www.widefocus.net
 */
/**
 * Class WideFocus_WidgetPreviews_Adminhtml_Widefocus_WidgetController
 *
 * @author Ashoka de Wit <ashoka@widefocus.net> 
 */
class WideFocus_WidgetPreviews_Adminhtml_Widefocus_WidgetController
    extends Mage_Adminhtml_Controller_Action
{
    /**
     * Preview a widget
     *
     * @return void
     */
    public function previewAction()
    {
        $previewParams = $this->getRequest()->getParam('widget_preview', []);
        $selectedStoreId = isset($previewParams['store'])
            ? $previewParams['store']
            : Mage::app()->getDefaultStoreView()->getId();

        $this->emulateStore($selectedStoreId);
        $this->loadLayout();

        $type = $this->getRequest()->getParam('widget_type');
        if (!$type && isset($previewParams['widget_type'])) {
            $type = $previewParams['widget_type'];
        }
        $widgetParams = $this->getRequest()->getParam('parameters', []);
        if (isset($previewParams['template'])) {
            $widgetParams['template'] = $previewParams['template'];
        }

        $code = Mage::getSingleton('widget/widget')->getWidgetDeclaration(
            $type,
            $widgetParams,
            true
        );

        $this->getLayout()->getBlock('widget_preview')->setWidgetCode($code);
        $this->renderLayout();
    }

    /**
     * Emulate store frontend locale and layout
     *
     * @param int $selectedStoreId
     * @return $this
     */
    protected function emulateStore($selectedStoreId)
    {
        Mage::app()->getLocale()->emulate($selectedStoreId);
        Mage::app()->setCurrentStore(Mage::app()->getStore($selectedStoreId));

        Mage::getDesign()->setArea('frontend')
            ->setStore($selectedStoreId)
            ->setPackageName();

        return $this;
    }

    /**
     * Check if the request is allowed
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('admin');
    }
}
