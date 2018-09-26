 function refresh_div() {
        jQuery.ajax({
            url:'includes/notification-inc.php',
            type:'POST',
            data: { method: 'fetch' },
            success:function(data) {
                jQuery(".notification").html(data);
            }
        });
    }

    t = setInterval(refresh_div,1000);