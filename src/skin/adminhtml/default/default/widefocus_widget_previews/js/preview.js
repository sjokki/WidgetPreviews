/**
 * Copyright © 2015 WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

// Set up namespace
var WideFocus = WideFocus || {};
WideFocus.WidgetPreviews = WideFocus.WidgetPreviews || {};

/**
 * Show a preview for a widget form
 *
 * @param iframe Element
 * @return void
 */
WideFocus.WidgetPreviews.Preview = function (iframe, options) {

    var defaults = {
        selectors: {
            refreshPreview: '.refresh-preview',
            container: '.widget-preview-container'
        }
    };

    var refreshPreview = function() {
        if (validateForm()) {
            var params = Form.serialize(iframe.up('form'));
            iframe.src = options.url + '?' + params;
        }
    }

    var validateForm = function() {
        var formInstance = new varienForm(iframe.up('form'));
        return (formInstance.validator && formInstance.validator.validate())
            || !formInstance.validator;
    }

    var initialize = function() {
        iframe.up(options.selectors.container).on(
            'click', options.selectors.refreshPreview,
            function (event, element) {
                refreshPreview();
            }
        );
    }

    options = Object.extend(defaults, options);
    initialize();
}