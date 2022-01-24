<form class="">
    <div class="form-group comment-form">
        <label for="score">Puntuación</label>
        <select class="form-control" id="score">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
        </select>
    </div>
    <div class="form-group comment-form">
        <label for="review">Reseña</label>
        <textarea class="form-control" id="review" rows="3"></textarea>
        <button type="button" class="btn btn-primary my-3" id="commentButton" data-user={$user} data-product="{$producto["id"]}">Enviar</button>
    </div>
</form>