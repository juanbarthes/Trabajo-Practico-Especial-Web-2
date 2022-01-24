{include file="headerAdmin.tpl"}
<!-- arranca la parte dinamica -->
<hr>
<hr>
<div class="d-flex justify-content-center h1 mx-3">
    <a href="formularioCategoria" class="mx-3 h1 btn btn-outline-info">Crear categoria</a>
    <a href="formularioProducto" class="mx-3 h1 btn btn-outline-success">Agregar Producto</a>
</div>

<ul class="list-group mx-3">
    {foreach from=$categorias item=categoria}
        <li class="list-group-item list-group-item bg-dark text-white text-center h1">
            <a class="text-decoration-none text-reset cat" href='productos/{$categoria->id_categoria}'>{$categoria->nombre_categoria}</a>
            <a class="btn btn-outline-success" href='formularioCategoria?id_c={$categoria->id_categoria}'>Editar</a>
            <a class="btn btn-outline-danger" href='deleteCategoria/{$categoria->id_categoria}'>Borrar</a>
        </li>
    {/foreach}
</ul>

{include file="footer.tpl"}