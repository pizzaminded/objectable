<table>
    <thead>
    <tr>
        <?php foreach ($headers as $header) { ?>
            <td>
                <?php dump($header); ?>
            </td>
        <?php } ?>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($rows as $row) { ?>
        <tr>
            <?php foreach ($row as $cell) { ?>
                <td>
                    <?= $cell; ?>
                </td>
            <?php } ?>
        </tr>
    <?php } ?>
    </tbody>
</table>