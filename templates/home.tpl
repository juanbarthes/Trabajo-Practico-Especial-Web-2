{include file="header.tpl"}
<!-- arranca la parte dinamica -->


<ul class="list-group mx-3">
{foreach from=$categorias item=categoria}

  <li class="list-group-item list-group-item bg-dark text-white text-center h1">
  <a class="text-decoration-none text-reset cat" href='productos/{$categoria->id_categoria}'>{$categoria->nombre_categoria}</a>
  </li>

{/foreach}
  </ul>
  {include file="footer.tpl"}