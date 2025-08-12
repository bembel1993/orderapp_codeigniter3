<footer style="background-color:#222; color:white; text-align:center; padding:10px; position:fixed; width:100%; bottom:0;">
    Test 2025
</footer>

<!--  -->
<script>
$(document).ready(function () {
        console.log("Document is ready");

            $('#searchdata').on('keyup', function () {
                console.log("Key pressed, value: " + $(this).val());
                var query = $(this).val();
                if (query.length > 1) {
                    console.log("Length of query:", query.length);

                    $.ajax({
                        url: 'http://localhost/orderapp/index.php/order/searchdata',
                        type: 'POST',
                        data: { search: query },
                        dataType: 'json',
                        success: function (response) {
                            console.log("Successfully responce from server NOMENKLATURA:", response);
                            // HTML TABLE 1
                            var htmlNomenklatura = '<table border="1">';
                            var headers = Object.keys(response.nomenklatura[0]);
                            if (response.nomenklatura.length > 0) {
                                htmlNomenklatura += '<tbody>';
                                response.nomenklatura.forEach(function(row) {
                                    htmlNomenklatura += '<tr>';
                                    headers.forEach(function(header) {
                                        htmlNomenklatura += '<td><label style="margin-left:10px;">' 
                                                                    + row[header] + 
                                                                '</label></td>';
                                    });
                                    htmlNomenklatura += '</tr>';
                                });
                            } else {
                                htmlNomenklatura += '<tr><td colspan="100%">No data</td></tr></tbody></table>';
                            }
                            htmlNomenklatura += '</tbody></table>';
                            $('#searchResult tbody').html(htmlNomenklatura);

                            // HTML TABLE 2
                            var filtrdata = response.filtrdata;

                            if (filtrdata && filtrdata.length > 0) {
                                var uniqueOptions = {};

                                filtrdata.forEach(function(item) {
                                    var key = item.group_name + '||' + item.text;
                                    if (!uniqueOptions[key]) {
                                        uniqueOptions[key] = new Set();
                                    }
                                    uniqueOptions[key].add(item.option_value);
                                });

                                var htmlFilter = '';
                                htmlFilter += '<table border="1" cellpadding="1" cellspacing="0" style="border-collapse: collapse;" id="filtrSearchResult">';

                                for (var key in uniqueOptions) {
                                    if (uniqueOptions.hasOwnProperty(key)) {
                                        var parts = key.split('||');
                                        var group_name = parts[0];
                                        var text = parts[1];

                                        htmlFilter += '<tr><td colspan="3"><b>' + htmlspecialchars(group_name) + '</b></td></tr>';
                                        htmlFilter += '<tr><td colspan="3"><b>' + htmlspecialchars(text) + '</b></td></tr>';

                                        uniqueOptions[key].forEach(function(option_value) {
                                            var checked = '';
                                            htmlFilter += '<tr>';
                                            htmlFilter += '<td>' + htmlspecialchars(option_value) + '</td>';
                                            htmlFilter += '<td>';
                                            htmlFilter += '<label style="margin-left:10px;">';
                                            htmlFilter += '<input type="checkbox" name="selected_items[]" value="' + htmlspecialchars(option_value) + '" ' + checked + '>';
                                            htmlFilter += '</label>';
                                            htmlFilter += '</td>';
                                            htmlFilter += '</tr>';
                                        });
                                    }
                                }

                                htmlFilter += '</table>';

                                $('#filtrSearchResult').html(htmlFilter);
                            } else {
                                $('#filtrSearchResult').html('<td colspan="100%">No data</td>');
                            }
                        }
                    });
                } else {
                    loadAllRecords('');
                }
            });

            function loadAllRecords(query) {
                
                $.ajax({
                        url: 'http://localhost/orderapp/index.php/order/searchdata',
                        type: 'POST',
                        data: { search: query },
                        dataType: 'json',
                        success: function (response) {
                            console.log("Successfully (loadAllRecords) :", response);
                            // HTML TABLE 1
                            var htmlNomenklatura = '<table border="1">';
                            var headers = Object.keys(response.nomenklatura[0]);
                            if (response.nomenklatura.length > 0) {
                                
                                htmlNomenklatura += '<tbody>';
                                response.nomenklatura.forEach(function(row) 
                                {
                                    htmlNomenklatura += '<tr>';
                                    headers.forEach(function(header) {
                                        htmlNomenklatura += '<td>' + row[header] + '</td>';
                                    });
                                    htmlNomenklatura += '</tr>';
                                });
                            } else {
                                htmlNomenklatura += '<tr><td colspan="100%">No data</td></tr></tbody></table>';
                            }
                            htmlNomenklatura += '</tbody></table>';
                            $('#searchResult tbody').html(htmlNomenklatura);

                            // HTML TABLE 2
                            var filtrdata = response.filtrdata;

                            if (filtrdata && filtrdata.length > 0) {
                                var uniqueOptions = {};

                                filtrdata.forEach(function(item) {
                                    var key = item.group_name + '||' + item.text;
                                    if (!uniqueOptions[key]) {
                                        uniqueOptions[key] = new Set();
                                    }
                                    uniqueOptions[key].add(item.option_value);
                                });

                                var htmlFilter = '';
                                htmlFilter += '<table border="1" cellpadding="1" cellspacing="0" style="border-collapse: collapse;" id="filtrSearchResult">';

                                for (var key in uniqueOptions) {
                                    if (uniqueOptions.hasOwnProperty(key)) {
                                        var parts = key.split('||');
                                        var group_name = parts[0];
                                        var text = parts[1];

                                        htmlFilter += '<tr><td colspan="3"><b>' + htmlspecialchars(group_name) + '</b></td></tr>';
                                        htmlFilter += '<tr><td colspan="3"><b>' + htmlspecialchars(text) + '</b></td></tr>';

                                        uniqueOptions[key].forEach(function(option_value) {
                                            var checked = '';
                                            htmlFilter += '<tr>';
                                            htmlFilter += '<td>' + htmlspecialchars(option_value) + '</td>';
                                            htmlFilter += '<td>';
                                            htmlFilter += '<label style="margin-left:10px;">';
                                            htmlFilter += '<input type="checkbox" name="selected_items[]" value="' + htmlspecialchars(option_value) + '" ' + checked + '>';
                                            htmlFilter += '</label>';
                                            htmlFilter += '</td>';
                                            htmlFilter += '</tr>';
                                        });
                                    }
                                }

                                htmlFilter += '</table>';
                            } else {
                                $('#filtrSearchResult').html('<p>No data</p>');
                            }
                        }
                    });
            }
            
            function htmlspecialchars(str) {
                if (typeof str !== 'string') {
                    return str;
                }
                return str.replace(/&/g, '&amp;')
                        .replace(/</g, '&lt;')
                        .replace(/>/g, '&gt;')
                        .replace(/"/g, '&quot;')
                        .replace(/'/g, '&#39;');
            }
        });
</script>

</body>
</html>