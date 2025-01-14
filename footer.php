<!-- Include the full version of jQuery -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script>
     $(document).ready(function () {
            $(".showHideForm").click(function (event) {
                event.preventDefault();
                console.log("Button clicked!");  // Debugging line
                $("#sign-up").toggle();
                $("#log-in").toggle();
            });


        // Debounce for the diary input
        let debounceTimer;
        $('#diary').on('input propertychange', function() {
            clearTimeout(debounceTimer); // Clear the previous timer
            debounceTimer = setTimeout(function() { // Set a new timer
                $.ajax({
                    method: "POST",
                    url: "update.php",
                    data: { content: $("#diary").val() }
                })
                .done(function(msg) {
                    alert("Data Saved: " + msg);
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    alert("Error saving data: " + textStatus);
                });
            }, 500); // Adjust debounce time as needed (500 ms here)
        });
    });
</script>

    </script>
</body>
</html>