<div style="height: 83vh; width: 300%; display: flex; padding-top: 3%;">
<div style="
    width: 350%; 
    height: 100%;
    padding-top: 0px; 
    border: 1px solid #000;
    overflow-y: auto;
    box-sizing: border-box;
">
    <h3>Filter</h3>
    <?php if (isset($characteristic) && is_array($characteristic) && count($characteristic) > 0): ?>
        <table border="1" cellpadding="1" cellspacing="0" style="border-collapse: collapse;" id="searchCharacteristic">
            <thead>
                <tr>
                    <?php
                        $headers = array_keys($characteristic[0]);
                        foreach ($headers as $header): 
                    ?>
                        <th><?php echo htmlspecialchars($header); ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($characteristic as $row): ?>
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