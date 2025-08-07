<footer style="background-color:#222; color:white; text-align:center; padding:10px; position:fixed; width:100%; bottom:0;">
    Test 2025
</footer>

<!--  -->
<script>
    $(document).ready(function () {
        console.log("Document is ready");
            // loadAllRecords();

            $('#searchdata').on('keyup', function () {
                console.log("Key pressed, value: " + $(this).val());
                var query = $(this).val();
                if (query.length > 2) {
                    console.log("Length of query:", query.length);
                    $.ajax({
                        url: 'http://localhost/orderapp/index.php/order/searchdata',
                        type: 'POST',
                        data: { search: query },
                        success: function (data) {
                            console.log("Successfully responce from server:", data);
                            $('#searchResult tbody').html(data);
                        }
                    });
                } else {
                    loadAllRecords();
                }
            });

            function loadAllRecords() {
                $.ajax({
                    url: 'http://localhost/orderapp/index.php/order/searchdata',
                    type: 'POST',
                    data: { search: '' },
                    success: function (data) {
                        console.log("Responce from server:", data);
                        $('#searchResult tbody').html(data);
                    }
                });
            }
        });
</script>

</body>
</html>