<?php

?>
<script>
    function updateTime() {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes().toString().padStart(2, '0');
        var seconds = now.getSeconds().toString().padStart(2, '0');
        var timeString = hours + ':' + minutes + ':' + seconds;
        document.getElementById('clock').textContent = 'Current time: ' + timeString;
    }

    updateTime();
    setInterval(updateTime, 1000);
</script>
