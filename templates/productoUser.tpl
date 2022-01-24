{include file="header.tpl"}

<div class="divproducto container">
  <img class="my-2" src="{$producto['imagen']}" alt="Card image cap">
  {if {$permits} == 'admin'}
    <br>
    <a class="btn btn-outline-danger" href='removeImage/{$producto['id']}'>Quitar imagen</a>  
  {/if}
  <div class="card-body">
    <h2 class="card-title">{$producto["nombre"]}</h2>
    <h5 class="card-title">Precio: {$producto["precio"]} ARS</h5>
    <p class="card-text">{$producto["descripcion"]}</p>
    <p class="card-text"><small class="text-muted">Stock: {$producto["stock"]}</small></p>
  </div>
</div>
<h2>Comentarios</h2>
{include file="commentForm.tpl"}
<div class="my-2 mx-5 p-3 bg-success" data-permits="{$permits}" data-id={$producto["id"]} id="commentsBox">
</div>
<script src="js/comments.js"></script>
{include file="footer.tpl"}