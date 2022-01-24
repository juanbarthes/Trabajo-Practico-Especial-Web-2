{include file="headerAdmin.tpl"}
<hr>
<h1 class="text-center">Nuestros Productos</h1>
<hr>
<table class="table table-dark">
    <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">precio</th>
            <th scope="col">Categorias</th>
            <th scope="col">Opcion-1</th>
            <th scope="col">Opcion-2</th>
        </tr>
    </thead>
    <tbody>
        {foreach from=$productos item=producto}
            <tr>
                <td><a class="text-reset text-decoration-none" href='producto/{$producto["id"]}'>{$producto["nombre"]}</a></td>
                <td>{$producto["precio"]}</td>
                <td>{$producto["nombre_categoria"]}</td>
                <td><a class="btn btn-outline-success" href='formularioProducto?id_p={$producto["id"]}'>Editar</a></td>
                <td><a class="btn btn-outline-danger" href='deleteProducto?id_p={$producto["id"]}'>Borrar</a></td>
            </tr>
        {/foreach}
    </tbody>
</table>
{include file="footer.tpl"}