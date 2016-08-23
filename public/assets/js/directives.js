var crunzUi = angular.module('CrunzUi');

/**
 *Service for binding a date picker to a form control
 */
crunzUi.directive('datePicker', function () {
    return {
        restrict : 'A',
        link     : function (scope, element, attrs, ctrl) {
          $(element).datetimepicker({
            format: 'YYYY/MM/DD'
          });  
        }
    }
});

/**
 *Service for binding a time picker to a form control
 */
crunzUi.directive('timePicker', function () {
    return {
        restrict : 'A',
        link     : function (scope, element, attrs, ctrl) {
          $(element).datetimepicker({
            format: 'HH:mm'
          });  
        }
    }
});

/**
 *Service for binding a date and time picker to a form control
 */
crunzUi.directive('dateTimePicker', function () {
    return {
        restrict : 'A',
        link     : function (scope, element, attrs, ctrl) {
          $(element).datetimepicker({
            format: 'YYYY/MM/DD HH:mm'
          });  
        }
    }
});

/**
 * Setting up a code editor
 */
crunzUi.directive('phpCode', function () {
  return {
      restrict : 'A',
      link     : function (scope, element, attrs, ctrl) {     
        $(element).ace({
          mode  : 'php',
          theme : 'dawn'
        });
      }
  }
});

/**
 * Select all feature
 */
crunzUi.directive('selectAll', function () {
  return {
    restrict : 'A',
    link     : function (scope, element, attrs, ctrl) {
      $(element).on('change', function () {
        $('[name="' + attrs.selectAll + '[]' + '"').prop('checked', $(this).prop('checked'));
      });
    }
  }
});

/**
 * Confirmation dialogue
 */
crunzUi.directive('shouldConfirm', function () {
  return {
    restrict : 'A',
    link     : function (scope, element, attrs, ctrl) {
      $(element).confirmation();
    }
  }
});

/**
 * Create a bulk actions form
 */
crunzUi.directive('bulkActionsForm', function () {
  
  return {
    restrict    : 'EA',
    templateUrl : '/assets/partials/bulk-actions-form.html',
    link        : function (scope, element, attrs, ctrl) {
        
        var $form   = $('#bulk-actions-form');

        scope.form   = { verb: null };
        scope.action = scope.actions[0];

        $form.find('[type="submit"]').on('click', function(e) {
          
          // Prevent the default behavior of submit button
          e.preventDefault();
          
          // Add _method hidden field in case the HHTP verb id not get or post
          if (typeof scope.action.method != 'undefined'
              &&     scope.action.method != 'get'
              &&     scope.action.method != 'post'
          ) {
            
            // Adding support for all HTTP verbs
            scope.form.verb = scope.action.method;

            // Since the event is triggered outside of Angular environment, we need to manually
            // call $apply to update the models
            scope.$apply();
          }

          // Attaching the checked items to the form as an array of hidden fields
          $('[name="' + attrs.items + '"]:checked').each(function (index) {
              var $item  = $(this),
                  $fld   = $('<input>', {
                    
                    type   : 'hidden',
                    value  : $item.val(),
                    name   : attrs.items

                  }).appendTo($form);
          });

          // Now submit the form
          $form.submit();

        });
    }
  }
}); 