<div style="display: flex;">
    <?php $this->load->view('interface/filter_menu'); ?>
    <div style="padding:27px; width: 80%; margin-left: 0px;">
        <h2 style="padding-top:1%;">Content</h2>
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
</div>