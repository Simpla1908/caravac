<div class="col-lg-12 table-responsive">
                <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2"  style="text-align: center;">REF</th>
                    <th rowspan="2"  style="text-align: center;">PASSIF</th>
                    <th rowspan="2"  style="text-align: center;">NOTE</th>  
                    <th style="text-align: center;">EXERCICE AU N</th>
                    <th style="text-align: center;">EXERCICE AU N-1</th>
                </tr>
                <tr>
                    <th  style="text-align: center;">Net</th>
                    <th  style="text-align: center;">Net</th>
                </tr>
            </thead>
            <tbody>
                   <?php
                     foreach ($result as $rows) {
                      ?>
                <tr>
                    <td><?php echo $rows->ref;?></td>
                    <td><?php echo $rows->rubrique;?></td>
                    <td><?php echo $rows->note;?></td>
                    <td></td>
                    <td></td>
                </tr>
              <?php
                   }
                 ?>
            </tbody>
        </table>
</div>