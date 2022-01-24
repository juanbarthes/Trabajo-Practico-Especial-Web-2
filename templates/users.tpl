{include file="headerAdmin.tpl"}
<h1>Lista de Usuarios</h1>
<table class="table table-dark my-3">
    <thead>
        <tr>
            <th scope="col">Nick</th>
            <th scope="col">Email</th>
            <th scope="col">Admin</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        {foreach from=$users item=user}
            <tr>
                <td>{$user->nick}</td>
                <td>{$user->email}</td>
                <td>{$user->admin}</td>
                <td><a href="giveAdmin/{$user->id}" class="btn btn-outline-success">Dar Permisos</a></td>
                <td><a href="deleteUser/{$user->id}" class="btn btn-outline-danger">Eliminar</a></td>
                </td>
            </tr>
        {/foreach}
    </tbody>
</table>
{include file="footer.tpl"}