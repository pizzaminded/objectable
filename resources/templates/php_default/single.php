<div class="table-responsive">
    <table class="table table-sm table-striped table-bordered table-hover">

        <tbody>
        <?php foreach ($row as $fieldLabel => $fieldValue) { ?>
            <tr>

                <td><?= $fieldLabel ?></td>
                <td><?= $fieldValue ?></td>

            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>