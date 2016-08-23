;(function ($) {
    
    $.fn.ace = function (options) {
        
        var options = $.extend({
            
            mode  : 'php',
            theme : 'github'

        }, options);
        
        return this.each(function () {
            
            var textarea  = $(this),
                editorCon = $('<div>', {
                    
                    position : 'absolute',
                    width    : textarea.width(),
                    height   : textarea.height()

            }).insertAfter(textarea);
            
            // Hiding the textarea
            textarea.css('display', 'none');
            
            var editor = ace.edit(editorCon[0]);
            
            editor.getSession().setValue(textarea.val());
            editor.getSession().setMode('ace/mode/' + options.mode);
            editor.setTheme('ace/theme/' + options.theme);
            
            // Syncing  the text area the respective code editor
            editor.on('change', function(){
                textarea.val(editor.getSession().getValue());
            });

        });

    };

}(jQuery));