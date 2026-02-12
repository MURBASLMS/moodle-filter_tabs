var result = {
    name: 'AddonTabsFilterHandler',
    filterName: 'tabs',

    isEnabled: function() {
        return true;
    },

    shouldBeApplied: function(options, site) {
        return true;
    },

    filter: function(text) {
        return text;
    },

    handleHtml: function(container) {
        // Stop ionChange from our accordions reaching any parent accordion group.
        var wrappers = container.querySelectorAll('.filter-tabs-wrapper');
        for (var i = 0; i < wrappers.length; i++) {
            wrappers[i].addEventListener('ionChange', function(event) {
                event.stopPropagation();
            });
        }
    }
};

this.CoreFilterDelegate.registerHandler(result);
