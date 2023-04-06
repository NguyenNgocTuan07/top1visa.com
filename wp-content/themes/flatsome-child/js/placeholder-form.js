jQuery(document).ready(function($) {
    jQuery('.conguoithanomykhong').change(function() {
        var selectedValue = jQuery(this).val();
        if(selectedValue == "Có") {
            jQuery('.conguoithanomykhongchon').show();
        } else {
            jQuery('.conguoithanomykhongchon').hide();
        }
    });
    jQuery('.cobanbeomykhong').change(function() {
        var selectedValue = jQuery(this).val();
        if(selectedValue == "Có") {
            jQuery('.cobanbechon').show();
        } else {
            jQuery('.cobanbechon').hide();
        }
    });
    jQuery('.coaidicungban').change(function() {
        var selectedValue = jQuery(this).val();
        console.log("20",selectedValue);
        if(selectedValue == "Có") {
            jQuery('.coaidicungbanchon').show();
        } else {
            jQuery('.coaidicungbanchon').hide();
        }
    });
    jQuery('.tinhtrangcongviec').change(function() {
        var selectedValue = jQuery(this).val();
           console.log("29",selectedValue);
        if(selectedValue == "Có") {
            jQuery('.tinhtrangcongviecchon').show();
        } else {
            jQuery('.tinhtrangcongviecchon').hide();
        }
    });
     jQuery('.coconchua').change(function() {
        var selectedValue = jQuery(this).val();
        if(selectedValue == "Có") {
            jQuery('.coconchuachon').show();
        } else {
            jQuery('.coconchuachon').hide();
        }
    });
      jQuery('.bandabaogiobituchoivisa').change(function() {
        var selectedValue = jQuery(this).val();
        if(selectedValue == "Có") {
            jQuery('.bandabaogiobituchoivisachon').show();
        } else {
            jQuery('.bandabaogiobituchoivisachon').hide();
        }
    });

     
    jQuery('.tinhtranghonnhan').change(function() {
        var selectedValue = jQuery(this).val();
        if(jQuery.trim(selectedValue).replace(/\s/g, "") === "Kếthôn") {
            jQuery('.tinhtranghonnhanchon').show();
            jQuery('.tinhtranglyhonchon').hide();
        } else if(jQuery.trim(selectedValue).replace(/\s/g, "") === "Lyhôn") {
            jQuery('.tinhtranglyhonchon').show();
            jQuery('.tinhtranghonnhanchon').hide();
        } else {
            jQuery('.tinhtranglyhonchon').hide();
            jQuery('.tinhtranghonnhanchon').hide();
        }
    });
    jQuery('.mucdichdulic').change(function() {
        var selectedValue = jQuery(this).val();
        if(jQuery.trim(selectedValue).replace(/\s/g, "") === "Đicôngtác") {
            jQuery('.mucdichdulicchon').show();
        } else {
           jQuery('.mucdichdulicchon').hide();
          //  jQuery('.tinhtranghonnhanchon').hide();
        }
    });
    //   jQuery('.cobanbeomykhong').change(function() {
    //     var selectedValue = jQuery(this).val();
    //     if(selectedValue == "Có") {
    //         jQuery('.cobanbechon').show();
    //     } else {
    //         jQuery('.cobanbechon').hide();
    //     }
    // });
    $('input').focusin(function() {
        input = $(this);
        input.data('place-holder-text', input.attr('placeholder'))
        input.attr('placeholder', '');
    });
    $('input').focusout(function() {
        input = $(this);
        input.attr('placeholder', input.data('place-holder-text'));
    });
});