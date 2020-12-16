{include file='./header.tpl'}
<div class="container">
<table class="table table-dark" style="margin-top: 100px;">
<thead>
  <tr>
  <th scope="col">imagen</th>
  <th scope="col">nombre</th>
  <th scope="col">precio</th>
  <th scope="col">stock</th>
  <th scope="col">category</th>
  <th scope="col">ver mas</th>
  </tr>
</thead>
<tbody>
{foreach from=$Searching item=search}
    <tr>
        <th scope="col"><img src="{$search->imagen}" class="card-img-top" alt="Card image cap"></th>
        <th scope="col">{$search->nombre}</th>
        <th scope="col">{$search->price}</th>
        <th scope="col">{$search->stock}</th>
        <th scope="col">{$search->category}</th>
        <th scope="col"><a href="productos/{$search->id_product}" class="btn btn-dark" value="{$search->id_product}">Descripcion</a></th>
{/foreach}}
        </tbody>
</table>
</div>