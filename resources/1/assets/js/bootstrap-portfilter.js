/* ============================================================
 * bootstrap-portfilter.js for Bootstrap v2.3.1
 * https://github.com/geedmo/portfilter
 * ============================================================
 * Copyright 2012 Twitter, Inc.
 *
 * jQuery (Very) Lightweight Portfolio Filter for Bootstrap
 *
 * Author: Geedmo (http://geedmo.com)
 * Version: 1.0
 * Usage:
 *   For handlers
 * 	   <tag data-toggle="portfilter" data-target="targetname">...
 *   For items
 * 	   <tag data-tag="targetname">...
 * ============================================================ */
! function($) {

    "use strict"; // jshint ;_;

    var pluginName = 'portfilter';

    /* PUBLIC CLASS DEFINITION
     * ============================== */

    var PortFilter = function(element) {

        this.$element = $(element)
        this.stuff = $('[data-tag]');
        this.target = this.$element.data('target') || '';

    }

    PortFilter.prototype.filter = function(params) {
        var items = [],
            target = this.target;
        this.stuff
            .fadeOut('slow').promise().done(function() {
                $(this).each(function() {
                    if ($(this).data('tag') == target || target == 'all')
                        items.push(this);
                });
                $(items).show()
            });
    }


    /* PLUGIN DEFINITION
     * ======================== */

    var old = $.fn[pluginName]

    $.fn[pluginName] = function(option) {
        return this.each(function() {
            var $this = $(this),
                data = $this.data(pluginName);

            if (!data) $this.data(pluginName, (data = new PortFilter(this)))

            if (option == 'filter') data.filter()
        })
    }

    // DEFAULTS
    $.fn[pluginName].defaults = {}

    // CONSTRUCTOR CONVENTION 
    $.fn[pluginName].Constructor = PortFilter;


    /* PORTFILTER NO CONFLICT
     * ================== */

    $.fn[pluginName].noConflict = function() {
        $.fn[pluginName] = old
        return this
    }

    /* PORTFILTER DATA-API
     * =============== */

    $(document).on('click.portfilter.data-api', '[data-toggle^=portfilter]', function(e) {
        $(this).portfilter('filter')
    })

}(window.jQuery);