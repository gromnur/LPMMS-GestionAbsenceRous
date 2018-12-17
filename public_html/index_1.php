<div class="col-md-10 ">
                    <div class="row selection">
                        <div class="col-xs-3">
                            <label>Departement : </label>
                            <select>
                                <option value="">departement</option>
                                <option value="">--Please choose an option--</option>
                                <option value="">--Please choose an option--</option>
                            </select>
                        </div>
                        <div class="col-xs-3">
                            <label>Departement : </label>
                            <select>
                                <option value="">filiere</option>
                                <option value="">azertyuiop</option>
                                <option value="">--Please choose an option--</option>
                            </select>
                        </div>
                        <div class="col-xs-3">
                            <label>Departement : </label>
                            <select>
                                <option value="">groupe</option>
                                <option value="">--Please choose an option--</option>
                                <option value="">--Please choose an option--</option>
                            </select>
                        </div>
                        <div class="col-xs-3">
                            <label>Departement : </label>
                            <select>
                                <option value="">groupe</option>
                                <option value="">--Please choose an option--</option>
                                <option value="">--Please choose an option--</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-2"><label>Nom</label></div>
                        <div class="col-xs-2"><label>Prénom</label></div>
                        <div class="col-xs-2"><label>Date</label></div>
                        <div class="col-xs-2"><label>Matière</label></div>
                        <div class="col-xs-2"><label>Absent</label></div>
                    </div>
                    <?php
                    for ($i = 1; $i <= 50; $i++) {
                        ?>
                        <div class='row '>
                            <div class="col-xs-2 ligne">Nom</div>
                            <div class="col-xs-2 ligne">Prénom</div>
                            <div class="col-xs-2 ligne">Date</div>
                            <div class="col-xs-2 ligne">Matière</div>
                            <div class="col-xs-2 ligne"> <input type="checkbox" /></div>
                        </div>
                    <?php } ?>          
                    <a href="#" class="btn valid">Valider</a>
                </div>