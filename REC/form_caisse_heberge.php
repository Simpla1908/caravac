    
    <form role="form">
        <div class="col-lg-4">
            <fieldset>
                <div class="form-group" >
                    <select id="id_hotel" class="form-control" name="id_hotel">
                        <option value="0">Situation globale</option>
                        <?php
                        include("./Amelioration/caisse/caisse_hotel.php");
                        foreach ($hotels as $h):
                            echo '<option value=' . $h->id_hotel . '>' . $h->nom_hotel . '</option>';
                        endforeach;
                        ?>
                    </select>
                </div>
        </div> 
        <div class="col-lg-4">
            <button type="submit" class="btn btn-primary" id="btn_valider_encours">Valider</button>
            </fieldset>
    
        </div>
    </form>   
    
