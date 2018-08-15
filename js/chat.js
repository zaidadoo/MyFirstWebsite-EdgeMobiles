 function refresh_div() {
        jQuery.ajax({
            url:'includes/chat-inc.php',
            type:'POST',
            data: { method: 'fetch' },
            success:function(data) {
                jQuery(".messages").html(data);
            }
        });
    }

    t = setInterval(refresh_div,1000);