{include file='./header.tpl'}
<div class="container" style="margin-top: 80px;">
<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">Nombre Usuario</th>
      <th scope="col">Delete User</th>
      <th scope="col">Permisos</th>
    </tr>
  </thead>
  <tbody>
  {foreach from=$users item=user}
    <tr>
      <th scope="row">{$user->user}</th>
      <th scope="row"><a href="deleteUser/{$user->id_user}" class="btn btn-dark">Eliminar</a></th>

      <th><button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal{$user->id_user}">Modificar</button></th>
                            <div class="modal fade" id="exampleModal{$user->id_user}" tabindex="-2" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modificar</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="updateUser/{$user->id_user}" method="POST" class="container">
                                                <div class="form-group">
                                                <select name="permisos" class="form-control">
                                                    <option value="1">usuario</option>
                                                    <option value="2">admin</option>
                                            </select>
                                                </div>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-outline-dark">update</button>
                                            </form>
                                        </div>
        
                                    </div>
                                </div>
                            </div>
    </tr>
  {/foreach}
  </tbody>
</table>
</div>
{include file='./footer.tpl'}