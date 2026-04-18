<table  border="1"  id="table">
    <thead>
        <?php foreach ($data['tableau']as $cle => $element) { ?>
            <tr>
                <th> <?php echo $cle; ?></th>
            </tr>
        <?php } ?>
    </thead>
    <tbody>
        <?php foreach ($data['donnees'] as $d) { ?> 
            <tr class="odd gradeX">
                <?php foreach ($data['tableau'] as $cle => $element) { ?> 
                    <td><?php echo $d->$element; ?> </td>
                <?php } ?>
            </tr>
        <?php } ?>
    </tbody>
</table>

