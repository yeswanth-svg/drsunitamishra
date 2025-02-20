$('.icp-dd').iconpicker();
            $('.icp-dd').on('iconpickerSelected', function (e) {
                var selectedIcon = e.iconpickerValue;
                $(this).parent().parent().children('input').val(selectedIcon);
});<?php /**PATH /home/drsunitamishra.com/public_html/resources/views/components/icon-picker.blade.php ENDPATH**/ ?>