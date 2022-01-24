{include file="header.tpl"}
<form class="mx-5" action={$action} method="POST">
    <div class="form-group mt-5">
        <input type="hidden" name="id" value="{$categoria["id_categoria"]}">
      <label for="nombre">Nombre</label>
      <input type="text" class="form-control" id="nombre" aria-describedby="emailHelp" name="nombre" value="{$categoria["nombre_categoria"]}">
    </div>
    <button type="submit" class="btn btn-outline-info">Enviar</button>
  </form>
  {include file="footer.tpl"}