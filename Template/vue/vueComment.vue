{literal}
<section>
    <table class="table table-dark" >
  <thead>
    <tr>
      <th scope="col-lg-4">Comentario</th>
      <th scope="col-lg-4">Puntaje</th>

    </tr>
  </thead>
  <tbody id="vue-comment" >
    <tr v-for="comment in comment" id="comentarios">
      <td class="td d-none elComentario" name="elComentario"  scope="col-lg-4"></td>
      <td class="td" scope="col-lg-4">{{ comment.comment }}</td>
      <td class="td" scope="col-lg-4">{{ comment.score}}</td>
      <td><input v-if="loged === '2'" type="submit" v-on:click="deleteComment(comment.id_comment)" v-bind:id="comment.id_comment" class="btn btn-danger" value="eliminar"></td>
    </tr>
  </tbody>
</table>
</section>
{/literal}