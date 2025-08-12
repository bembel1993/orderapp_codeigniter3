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
                        dataType: 'json',
                        success: function (response) {
                            var htmlNomenklatura = '<table border="1">';

                            if (response.nomenklatura.length > 0) {
                                htmlNomenklatura += '<tbody>';
                                response.nomenklatura.forEach(function(row) {
                                    htmlNomenklatura += '<tr>';
                                    headers.forEach(function(header) {
                                        
                                    });
                                    htmlNomenklatura += '</tr>';
                                });
                            } else {
                                htmlNomenklatura += '<tr><td colspan="100%">No data</td></tr></tbody></table>';
                            }
                            htmlNomenklatura += '</tbody></table>';

                            // строим HTML для второй таблицы
                            var htmlFiltrdata = '';

                            if (response.filtrdata.length > 0) {
                                var headers2 = Object.keys(response.filtrdata[0]);
                                
                                headers2.forEach(function(header) {
                                    htmlFiltrdata += '<th>' + header + '</th>';
                                });

                                response.filtrdata.forEach(function(row) {
                                    htmlFiltrdata += '<tr>';
                                    headers2.forEach(function(header) {
                                        htmlFiltrdata += '<td><label style="margin-left:10px;">' 
                                                                    + htmlspecialchars(row[header]) + 
                                                                '</label></td>';
                                    });
                                    htmlFiltrdata += '</tr>';
                                });
                            } else {
                                htmlFiltrdata = '<tr><td colspan="100%">No data</td></tr>';
                            }

                            // вставляем обе таблицы в контейнеры
                            $('#searchResult tbody').html(htmlNomenklatura);
                            $('#filtrSearchResult').html(htmlFiltrdata);
                        }
                    });
                } else {
                    loadAllRecords(query);
                }
            });

            function loadAllRecords(query) {
                
                $.ajax({
                        url: 'http://localhost/orderapp/index.php/order/searchdata',
                        type: 'POST',
                        data: { search: query },
                        dataType: 'json',
                        success: function (response) {
                            var htmlNomenklatura = '<table border="1">';

                            if (response.nomenklatura.length > 0) {
                                var headers = Object.keys(response.nomenklatura[0]);
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

                            // строим HTML для второй таблицы
                            var htmlFiltrdata = '';

                            if (response.filtrdata.length > 0) {
                                var headers2 = Object.keys(response.filtrdata[0]);
                                headers2.forEach(function(header) {
                                    htmlFiltrdata += '<th>' + header + '</th>';
                                });
                                response.filtrdata.forEach(function(row) {
                                    htmlFiltrdata += '<tr>';
                                    headers2.forEach(function(header) {
                                        htmlFiltrdata += '<td><label style="margin-left:10px;">' 
                                                                    + row[header] + 
                                                                '</label></td>';
                                    });
                                    htmlFiltrdata += '</tr>';
                                });
                            } else {
                                htmlFiltrdata = '<tr><td colspan="100%">No data</td></tr>';
                            }

                            // вставляем обе таблицы в контейнеры
                            $('#searchResult tbody').html(htmlNomenklatura);
                            $('#filtrSearchResult').html(htmlFiltrdata);
                        }
                    });
            }
        });