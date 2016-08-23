;(function($) {
    
    $.fn.actionForm = function () {
        
        var options = $.extend({

            list: 'list'

        }, options);
        
        return this.each(function () {
            
            $(this).find('[type="submit"]').on('click', function (e) {
                
                e.preventDefault();

                var form   = $(this).parents('form'),
                    action = form.find('option:selected'),
                    method = action.attr('data-method') == 'GET' ? 'GET' : 'POST';
                    
                    // Clone selected list of entries
                    $('[name="' + options.list +'[]"]:checked')                    
                    .clone()
                    .prop('checked', true)
                    .appendTo(form)
                    
                    // Setting _method value in case data-method attribute is not GET or set
                    if(action.attr('data-method') && 
                      (action.attr('data-method') != 'GET' || 
                       action.attr('data-method') != 'POST'))
                    {
                        
                        $('<input>', {
                            type  : 'hidden',
                            name  : '_method',
                            value : action.attr('data-method')
                        }).appendTo(form);
                    }

                    // Set the proper action and method and send the form
                    form.attr('action', action.val())
                        .attr('method', method)
                        .submit();

            });
        });
    }
}(jQuery))