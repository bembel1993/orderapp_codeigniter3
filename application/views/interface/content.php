



<div style="padding:27px;">
    <h2>Contents</h2>
    <p>list of products</p>
    <?php if (isset($rows) && is_array($rows) && count($rows) > 0): ?>
        <table border="1" cellpadding="1" cellspacing="0" style="border-collapse: collapse;" id="searchResult">
            <thead>
                <tr>
                    <?php
                        $headers = array_keys($rows[0]);
                        foreach ($headers as $header): 
                    ?>
                        <th><?php echo htmlspecialchars($header); ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <?php
                            foreach ($headers as $header): ?>
                                <td>
                                    <?php echo htmlspecialchars(isset($row[$header]) ? $row[$header] : ''); ?>
                                </td>
                            <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No data</p>
    <?php endif; ?>
</div>

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