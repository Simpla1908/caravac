<div class="tab-pane table-responsive" id="tab_1">
    <table class="table table-bordered table-condensed table-hover table-striped t2">
        <thead>
            <tr>
                <th>N°</th>
                <th>Désignation</th>
                <th>Initiale</th>
                <th>Entrée</th>
                <th>Sortie</th>
                <th>Avarie</th>
                <th>Solde</th>
                <th>Unité</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($articles as $art) {
                $q0 = 0;
                $qin = 0;
                $qout = 0;
                $qsolde = 0;
                $qte_declasse = 0;
                $idprod = $art->idprod;
                $des = $art->produit;
                if (in_array($idprod, $_SESSION['fs']['id'])) {
                    if (isset($_SESSION['fs']['q0'][$idprod])) {
                        $q0 = $_SESSION['fs']['q0'][$idprod];
                    } else {
                        $_SESSION['fs']['q0'][$idprod] = $q0;
                    }
                    if (isset($_SESSION['fs']['qin'][$idprod])) {
                        $qin = $_SESSION['fs']['qin'][$idprod];
                    } else {
                        $_SESSION['fs']['qin'][$idprod] = $qin;
                    }
                    if (isset($_SESSION['fs']['qout'][$idprod])) {
                        $qout = $_SESSION['fs']['qout'][$idprod];
                    } else {
                        $_SESSION['fs']['qout'][$idprod] = $qout;
                    }
                    if (isset($_SESSION['fs']['qavarie'][$idprod])) {
                        $qte_declasse = $_SESSION['fs']['qavarie'][$idprod];
                    } else {
                        $_SESSION['fs']['qavarie'][$idprod] = $qte_declasse;
                    }
                } else {
                    array_push($_SESSION['fs']['id'], $idprod);
                    $_SESSION['fs']['q0'][$idprod] = $q0;
                    $_SESSION['fs']['qin'][$idprod] = $qin;
                    $_SESSION['fs']['qout'][$idprod] = $qout;
                    $_SESSION['fs']['qavarie'][$idprod] = $qte_declasse;
                }
                $_SESSION['fs']['des'][$idprod] = $art->produit;
                $qsolde = ($q0 + $qin) - ($qout + $qte_declasse);
                $_SESSION['fs']['qsolde'][$idprod] = $qsolde;
            ?>
            <tr class="odd gradeX">
                <td><?php echo $i ?></td>
                <td><?php echo $des ?></td>
                <td><?php echo $q0 ?></td>
                <td><?php echo $qin ?></td>
                <td><?php echo $qout ?></td>
                <td><?php echo $qte_declasse ?></td>
                <td><?php echo $qsolde ?></td>
                <td><?php echo $art->unite ?></td>
            </tr>
            <?php
                $i++;
            };
            ?>
        </tbody>
    </table>
</div>
<!-- /.tab-pane -->
<div class="tab-pane active " id="tab_2">
    <table class="table table-bordered table-condensed table-hover table-striped t2">
        <thead>
            <tr>
                <th>N°</th>
                <th>Désignation</th>
                <th>Solde</th>
                <th>Unité</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($articles as $art) {
                $q0 = 0;
                $qin = 0;
                $qout = 0;
                $qsolde = 0;
                $qte_declasse = 0;
                $idprod = $art->idprod;
                $des = $art->produit;
                $qte_min = $art->qte_min;
                if (in_array($idprod, $_SESSION['fs']['id'])) {
                    if (isset($_SESSION['fs']['q0'][$idprod])) {
                        $q0 = $_SESSION['fs']['q0'][$idprod];
                    } else {
                        $_SESSION['fs']['q0'][$idprod] = $q0;
                    }
                    if (isset($_SESSION['fs']['qin'][$idprod])) {
                        $qin = $_SESSION['fs']['qin'][$idprod];
                    } else {
                        $_SESSION['fs']['qin'][$idprod] = $qin;
                    }
                    if (isset($_SESSION['fs']['qout'][$idprod])) {
                        $qout = $_SESSION['fs']['qout'][$idprod];
                    } else {
                        $_SESSION['fs']['qout'][$idprod] = $qout;
                    }
                    if (isset($_SESSION['fs']['qavarie'][$idprod])) {
                        $qte_declasse = $_SESSION['fs']['qavarie'][$idprod];
                    } else {
                        $_SESSION['fs']['qavarie'][$idprod] = $qte_declasse;
                    }
                } else {
                    array_push($_SESSION['fs']['id'], $idprod);
                    $_SESSION['fs']['q0'][$idprod] = $q0;
                    $_SESSION['fs']['qin'][$idprod] = $qin;
                    $_SESSION['fs']['qout'][$idprod] = $qout;
                    $_SESSION['fs']['qavarie'][$idprod] = $qte_declasse;
                }
                $_SESSION['fs']['des'][$idprod] = $art->produit;
                $qsolde = ($q0 + $qin) - ($qout + $qte_declasse);
                $_SESSION['fs']['qsolde'][$idprod] = $qsolde;
            ?>
            <?php if ($qte_min >= $qsolde && $qsolde > 0) { ?>
            <tr class="odd gradeX">
                <td><?php echo $i ?></td>
                <td><?php echo $des ?></td>
                <td><?php echo $qsolde ?></td>
                <td><?php echo $art->unite ?></td>
            </tr>
            <?php
                    $i++;
                };
                ?>
            <?php } ?>
        </tbody>
    </table>
</div>