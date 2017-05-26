<div class="modal modal-bill-delete">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Potwierdź</h4>
      </div>
      <div class="modal-body">
        <p>Czy na pewno chcesz usunąć ten rachunek?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Zamknij</button>
        <form id="form-bill-delete" action="" method="post">
          <input type="hidden" name="_method" value="DELETE">
          {{ csrf_field() }}
          <button type="submit" class="btn btn-danger">Usuń</button>
        </form>
      </div>
    </div>
  </div>
</div>