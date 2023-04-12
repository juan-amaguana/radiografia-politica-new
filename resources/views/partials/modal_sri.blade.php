<!-- Modal Renta -->
                <div id="modal1" class="modal modal-fixed-footer">
                  <div class="modal-content">
                    <h5 class="fcd-custom-color">Impuesto a la renta</h5>
                    <div class="col m2"></div>
                    <div class="col m5">
                      <table class="highlight fcd-custom-color">
                        <thead>
                          <tr>
                              <th>Año</th>
                              <th>Valor Impuesto</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($sri_renta_detalle as $sri_renta_detalles)
                          <tr>
                              <td>{{ $sri_renta_detalles->anio_sri }}</td>
                              <td>
                                @if($sri_renta_detalles->declaracion == 2)
                                {{number_format($sri_renta_detalles->valor_impuesto_sri,2,",",".") }}
                                @else
                                  El funcionario no ha declarado
                                @endif
                              </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>

                    </div>
                    <div class="col m2"></div>
                  </div>
                  <div class="modal-footer">
                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
                  </div>
                </div>
                <!-- Modal divisas -->
                <div id="modal2" class="modal modal-fixed-footer">
                  <div class="modal-content">
                    <h5 class="fcd-custom-color">Impuesto salida divisas</h5>
                    <div class="col m2"></div>
                    <div class="col m5">
                      <table class="highlight fcd-custom-color">
                        <thead>
                          <tr>
                              <th>Año</th>
                              <th>Valor Impuesto</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($sri_divisas_detalle as $sri_divisas_detalles)
                          <tr>
                              <td>{{ $sri_divisas_detalles->anio_sri }}</td>
                              <td>
                                @if($sri_divisas_detalles->declaracion == 2)
                                {{ number_format($sri_divisas_detalles->valor_impuesto_sri,2,",",".") }}
                                @else
                                  El funcionario no ha declarado
                                @endif

                              </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>

                    </div>
                    <div class="col m2"></div>
                  </div>
                  <div class="modal-footer">
                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
                  </div>
                </div>
