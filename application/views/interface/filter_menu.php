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
    <?php
        $header_printed = false;
        $date_printed = false;
    ?>

    <?php
        $current_group = '';
        $current_category = '';

        echo '<table border="1" cellpadding="1" cellspacing="0" style="border-collapse: collapse;">';

        foreach ($characteristic as $row) {
            $group_name = $row['group_name'];
            $text = $row['text'];
            $option_value = $row['option_value'];

            if ($group_name !== $current_group) {
                echo '<tr>';
                echo '<td colspan="3"><b>' . htmlspecialchars($group_name) . '</b></td>';
                echo '</tr>';
                $current_group = $group_name;
            } else {
                echo '<tr>';
                echo '<td></td>';
                echo '</tr>';
            }

            if ($text !== $current_category) {
                echo '<tr>';
                echo '<td colspan="3"><b>' . htmlspecialchars($text) . '</b></td>';
                echo '</tr>';
                $current_category = $text;
            } else {
                echo '<tr>';
                echo '<td></td>';
                echo '</tr>';
            }

            echo '<tr>';
            echo '<td>';

            echo htmlspecialchars($option_value);

            $checked = '';
            echo '<label style="margin-left:10px;">';
            echo '<input type="checkbox" name="selected_items[]" value="' . htmlspecialchars($option_value) . '" ' . $checked . '>';
            echo '</label>';

            echo '</td>';

            echo '</tr>';
        }
        echo '</table>';
    ?>


    <!-- <?php if (isset($characteristic) && is_array($characteristic) && count($characteristic) > 0): ?>
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
    <?php endif; ?> -->
</div>
</div>