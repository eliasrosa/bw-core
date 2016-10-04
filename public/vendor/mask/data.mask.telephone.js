$(function(){

    var TelephoneMaskBehavior = function (val) {
      return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    }

    var spOptions = {
      onKeyPress: function(val, e, field, options) {
          field.mask(TelephoneMaskBehavior.apply({}, arguments), options);
      },

      //
      clearIfNotMatch: true,
    };

    //
    $('input[data-mask-telephone]').mask(TelephoneMaskBehavior, spOptions);
});
