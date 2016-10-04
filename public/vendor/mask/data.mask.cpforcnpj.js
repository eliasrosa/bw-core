$(function(){

    var MaskBehavior = function (val) {
      return val.replace(/\D/g, '').length <= 11 ? '000.000.000-009' : '00.000.000/0000-00';
    }

    var spOptions = {
      onKeyPress: function(val, e, field, options) {
          field.mask(MaskBehavior.apply({}, arguments), options);
      },

      //
      clearIfNotMatch: true,
    };

    //
    $('input[data-mask-cpforcnpj]').mask(MaskBehavior, spOptions);
});
