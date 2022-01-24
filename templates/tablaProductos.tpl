{include file="header.tpl"}
<hr>
<h1 class="text-center">Nuestros Productos</h1>
<hr><table class="table table-dark">
    <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">precio</th>
            <th scope="col">Categorias</th>
        </tr>
    </thead>
    <tbody>
        {foreach from=$productos item=producto}
            <tr>
                <td><a class="text-reset text-decoration-none" href='producto/{$producto["id"]}'>{$producto["nombre"]}</a></td>
                <td>{$producto["precio"]}</td>
                <td>{$producto["nombre_categoria"]}</td>
            </tr>
        {/foreach}
    </tbody>
</table>
{include file="footer.tpl"}