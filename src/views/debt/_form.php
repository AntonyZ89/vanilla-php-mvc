<form action="#" method="post">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="description">Descrição</label>
                <input type="text" name="description" id="description" class="form-control" value="Hello world"></input>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="value">Valor</label>
                <input type="text" name="value" id="value" class="form-control" value="123.45">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="due_date">Data de Vencimento</label>
                <input type="date" name="due_date" id="due_date" class="form-control" value="2020-02-02">
            </div>
        </div>
    </div>
    <div class="clearfix">
        <div class="float-end mt-2">
            <button type="submit" class="btn btn-success">
                Atualizar
            </button>
        </div>
    </div>
</form>