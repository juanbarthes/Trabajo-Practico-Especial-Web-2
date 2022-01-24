{include file="header.tpl"}
<div class="container">
    <form class="my-3" action="verificarusuario" method="POST">
        <div class="form-group">
            <label for="email">Email de usuario</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Direccion email">
        </div>
        <div class="form-group">
            <label for="contraseña">Contraseña</label>
            <input type="password" class="form-control" id="contraseña" name="contraseña" placeholder="Contraseña">
            <small id="emailHelp" class="form-text text-muted">No compartas tu contraseña con nadie</small>

        </div>
        <button type="submit" class="btn btn-outline-info">Ingresar</button>
    </form>
    {if $mensaje != ""}
        <div class="alert alert-danger " role="alert">
            {$mensaje}
        </div>
    {/if}
</div>
{include file="footer.tpl"}