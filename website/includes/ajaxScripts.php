    <script type="text/javascript">
        $(document).ready(function() {
            function ramInfo() {
                $.ajax({
                    type: 'POST',
                    url: "../ajax/dedicated/ram.php",
                    success: function(data) {
                        $('#raminfo').html(data);
                    }
                });
            }

            function diskInfo() {
                $.ajax({
                    type: 'POST',
                    url: "../ajax/dedicated/disk.php",
                    success: function(data) {
                        $('#diskinfo').html(data);
                    }
                });
            }

            function cpuInfo() {
                $.ajax({
                    type: 'POST',
                    url: "../ajax/dedicated/cpu.php",
                    success: function(data) {
                        $('#cpuInfo').html(data);
                    }
                });
            }

            function bookInfo() {
                $.ajax({
                    type: 'POST',
                    url: "../ajax/info/book.php",
                    success: function(data) {
                        $('#bookInfo').html(data);
                    }
                });
            }

            function userInfo() {
                $.ajax({
                    type: 'POST',
                    url: "../ajax/info/users.php",
                    success: function(data) {
                        $('#userInfo').html(data);
                    }
                });
            }

            setInterval(ramInfo, 3000);
            setInterval(cpuInfo, 3000);
            setInterval(diskInfo, 3000);
            setInterval(bookInfo, 3000);
            setInterval(userInfo, 3000);
        });
    </script>