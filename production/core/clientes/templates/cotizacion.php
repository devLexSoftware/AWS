

        <!-- Page content -->
            <div class="">

                <div class="page-title">
                    <div class="title_left">
                        <h3>Formato para cotizaciones</h3>
                    </div>

                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Número de folio de cotización">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><a href="ListadoCotizaciones.html">Buscar</a></button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Datos de Cliente</h2>
                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content">
                                <br/>
                                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Nom-Client">Nombre de cliente:<span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="Nomcliente" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el nombre del cliente">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Dir-Client">Dirección de cliente:<span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="DirClient" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese la calle y número">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Col-Client">Colonia de cliente:<span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="ColClient" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese la colonia">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Ciudad-Client">Ciudad de cliente:<span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="CiudClient" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese la ciudad">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="RFC-Client">RFC del Cliente:<span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="RFCClient" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrse el RFC del cliente">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Folio-Client">Folio de Cotización:</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label id="FolioClient" class="form-control col-md-7 col-xs-12">COT00000000</label>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <h2>Detalles de la cotización</h2>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="x_content">
                                            <br/>
                                            <form class="form-horizontal form-label-left input_mask">
                                                <!-- Start row one -->
                                                <div class="col-md-1 col-sm-1 col-xs-12 form-group ">
                                                    <input type="text" class="form-control" id="inputSuccess2" placeholder="No">
                                                </div>

                                                <div class="col-md-3 col-sm-3 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess3" placeholder="Descripcion">
                                                </div>

                                                <div class="col-md-2 col-sm-2 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess4" placeholder="Unidad">
                                                </div>

                                                <div class="col-md-2 col-sm-2 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess5" placeholder="Cantidad">
                                                </div>

                                                <div class="col-md-2 col-sm-1 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess6" placeholder="P.Unitario">
                                                </div>

                                                <div class="col-md-2 col-sm-2 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess7" placeholder="Importe">
                                                </div> <!-- End row one -->

                                                <!-- Start row two-->
                                                <div class="col-md-1 col-sm-1 col-xs-12 form-group ">
                                                    <input type="text" class="form-control" id="inputSuccess2" placeholder="No">
                                                </div>

                                                <div class="col-md-3 col-sm-3 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess3" placeholder="Descripcion">
                                                </div>

                                                <div class="col-md-2 col-sm-2 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess4" placeholder="Unidad">
                                                </div>

                                                <div class="col-md-2 col-sm-2 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess5" placeholder="Cantidad">
                                                </div>

                                                <div class="col-md-2 col-sm-1 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess6" placeholder="P.Unitario">
                                                </div>

                                                <div class="col-md-2 col-sm-2 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess7" placeholder="Importe">
                                                </div> <!-- End row two -->

                                                <!-- Start row three-->
                                                <div class="col-md-1 col-sm-1 col-xs-12 form-group ">
                                                    <input type="text" class="form-control" id="inputSuccess2" placeholder="No">
                                                </div>

                                                <div class="col-md-3 col-sm-3 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess3" placeholder="Descripcion">
                                                </div>

                                                <div class="col-md-2 col-sm-2 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess4" placeholder="Unidad">
                                                </div>

                                                <div class="col-md-2 col-sm-2 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess5" placeholder="Cantidad">
                                                </div>

                                                <div class="col-md-2 col-sm-1 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess6" placeholder="P.Unitario">
                                                </div>

                                                <div class="col-md-2 col-sm-2 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess7" placeholder="Importe">
                                                </div> <!-- End row three -->

                                                <!-- Start row four-->
                                                <div class="col-md-1 col-sm-1 col-xs-12 form-group ">
                                                    <input type="text" class="form-control" id="inputSuccess2" placeholder="No">
                                                </div>

                                                <div class="col-md-3 col-sm-3 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess3" placeholder="Descripcion">
                                                </div>

                                                <div class="col-md-2 col-sm-2 col-xs-12 form-group">
                                                   <input type="text" class="form-control" id="inputSuccess4" placeholder="Unidad">
                                                </div>

                                                <div class="col-md-2 col-sm-2 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess5" placeholder="Cantidad">
                                                </div>

                                                <div class="col-md-2 col-sm-1 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess6" placeholder="P.Unitario">
                                                </div>

                                                <div class="col-md-2 col-sm-2 col-xs-12 form-group">
                                                   <input type="text" class="form-control" id="inputSuccess7" placeholder="Importe">
                                                </div> <!-- End row four -->

                                                <!-- Start row five-->
                                                <div class="col-md-1 col-sm-1 col-xs-12 form-group ">
                                                    <input type="text" class="form-control" id="inputSuccess2" placeholder="No">
                                                </div>

                                                <div class="col-md-3 col-sm-3 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess3" placeholder="Descripcion">
                                                </div>

                                                <div class="col-md-2 col-sm-2 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess4" placeholder="Unidad">
                                                </div>

                                                <div class="col-md-2 col-sm-2 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess5" placeholder="Cantidad">
                                                </div>

                                                <div class="col-md-2 col-sm-1 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess6" placeholder="P.Unitario">
                                                </div>

                                                <div class="col-md-2 col-sm-2 col-xs-12 form-group">
                                                   <input type="text" class="form-control" id="inputSuccess7" placeholder="Importe">
                                                </div> <!-- End row five -->

                                                <!-- Start row six-->
                                                <div class="col-md-1 col-sm-1 col-xs-12 form-group ">
                                                    <input type="text" class="form-control" id="inputSuccess2" placeholder="No">
                                                </div>

                                                <div class="col-md-3 col-sm-3 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess3" placeholder="Descripcion">
                                                </div>

                                                <div class="col-md-2 col-sm-2 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess4" placeholder="Unidad">
                                                </div>

                                                <div class="col-md-2 col-sm-2 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess5" placeholder="Cantidad">
                                                </div>

                                                <div class="col-md-2 col-sm-1 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess6" placeholder="P.Unitario">
                                                </div>

                                                <div class="col-md-2 col-sm-2 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess7" placeholder="Importe">
                                                </div> <!-- End row six -->

                                                <!-- Start row seven-->
                                                <div class="col-md-1 col-sm-1 col-xs-12 form-group ">
                                                    <input type="text" class="form-control" id="inputSuccess2" placeholder="No">
                                                </div>

                                                <div class="col-md-3 col-sm-3 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess3" placeholder="Descripcion">
                                                </div>

                                                <div class="col-md-2 col-sm-2 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess4" placeholder="Unidad">
                                                </div>

                                                <div class="col-md-2 col-sm-2 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess5" placeholder="Cantidad">
                                                </div>

                                                <div class="col-md-2 col-sm-1 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess6" placeholder="P.Unitario">
                                                </div>

                                                <div class="col-md-2 col-sm-2 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess7" placeholder="Importe">
                                                </div> <!-- End row seven -->

                                                <!-- Start row eight-->
                                                <div class="col-md-1 col-sm-1 col-xs-12 form-group ">
                                                    <input type="text" class="form-control" id="inputSuccess2" placeholder="No">
                                                </div>

                                                <div class="col-md-3 col-sm-3 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess3" placeholder="Descripcion">
                                                </div>

                                                <div class="col-md-2 col-sm-2 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess4" placeholder="Unidad">
                                                </div>

                                                <div class="col-md-2 col-sm-2 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess5" placeholder="Cantidad">
                                                </div>

                                                <div class="col-md-2 col-sm-1 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess6" placeholder="P.Unitario">
                                                </div>

                                                <div class="col-md-2 col-sm-2 col-xs-12 form-group">
                                                    <input type="text" class="form-control" id="inputSuccess7" placeholder="Importe">
                                                </div> <!-- End row eight -->

                                                <div class="form-group">
                                                    <div class="col-md-2 col-sm-2 col-xs-12 col-md-offset-10">
                                                        <input type="text" class="form-control" readonly="readonly" id="outputSubtotal" placeholder="Subtotal">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-2 col-sm-2 col-xs-12 col-md-offset-10">
                                                        <input type="text" class="form-control" readonly="readonly" id="outputIVA" placeholder="IVA">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-2 col-sm-2 col-xs-12 col-md-offset-10">
                                                        <input type="text" class="form-control" readonly="readonly" id="outputTotal" placeholder="Total">
                                                    </div>
                                                </div>

                                                <div class="ln_solid"></div>

                                                <div class="form-group">
                                                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-10">
                                                        <button type="submit" class="btn btn-success"> Guardar e Imprimir</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

            </div>

        <!-- /page content -->
