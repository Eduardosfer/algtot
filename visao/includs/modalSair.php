
<!--Modal Sair-->
<div id="sair" class="modal fade bs-example-modal-sm" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="mySmallModalLabel">

   <div class="modal-dialog" role="document">

    <div class="modal-dialog modal-sm" role="document">

      <div class="modal-content">

         <div class="modal-header" style="background-color: #4cae4c; color: white;text-align:center;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="gridSystemModalLabel">Deseja realmente sair ?</h4>
         </div>

        <form name="sair" action="../controle/Usuario.php" method="post">

          <div class="modal-footer" style="text-align:center;">
            <div class="row">
              <div class="col-sm-6">
                  <button style="width:100px;" name="acao" type="button" data-dismiss="modal" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> Não</button>
              </div>
              <div class="col-sm-6">
                <button style="width:100px;" name="acao" value="Deslogar" type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Sim</button>
              </div>
            </div>
          </div>

        </form>

      </div>

    </div><!-- /.modal-content -->
  </div>
</div><!-- /.modal-dialog -->
