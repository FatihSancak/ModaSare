<!-- Modal -->
<div>
    <div class="modal fade" id="maliyetEkle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form method="post" action="">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Maliyet Ekle</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <!-- maliyet başlangıcı-->
                        <div class="rowmb-3 ">
                            <!-- maliyet basliklari -->
                            <label class="col-sm-3 form-label" for="maliyetBaslik">Maliyet Seçiniz</label>
                            <div class="col-sm-9 ">
                                <input type="hidden" value="<?= $_GET["ModelID"] ?>" name="modelID">
                                <select class="form-select" name="maliyetBaslik" id=maliyetBaslik
                                        aria-label="Maliyet Türü Seçimi">
                                    <option value="" selected>Maliyet Seçiniz</option>
                                    <?php echo $options; ?>
                                </select>
                            </div>
                        </div>
                        <!-- maliyet fiyatı -->
                        <div class="row">
                            <label class="col-sm-3form-label" for="maliyetBaslik">Maliyet</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="maliyet"
                                       placeholder="Maliyet Miktarı">
                            </div>
                        </div>
                        <!-- date  -->
                        <div class="row">
                            <label class="col-sm-3col-form-label " for="startDate">Maliyet Tarihi</label>
                            <div class="col-sm-9form-label ">
                                <input type="date" name="maliyetTarihi" class="form-control" id="datepicker"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-success">Maliyet Kaydet</button>
                    </div>
                </div>
            </div>

        </form>

    </div>
</div>
</div>