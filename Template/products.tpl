{include file='./header.tpl'}
<section>
    <div class="container " >
    {if $logged == 2}
        <h2 class="marginSection">Lista de productos</h2>
        {else}
        <h2 class="form">Lista de productos</h2>
    {/if}
    <div class="container ">
        <form action="searchPriceProducts" method="POST" class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" name="minPrice" placeholder="Precio Minimo" aria-label="Search">
            <input class="form-control mr-sm-2" name="maxPrice" placeholder="Precio Maximo" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
        </form>
    </div>
        {if $logged == 2}
            <form action="insert" method="POST" enctype="multipart/form-data" >
                <div class="form-row  marginSection"  >
                    <div class="col">
                        <input type="text" class="form-control" name="nombre" placeholder="Nombre Producto">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="price" placeholder="Precio">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="stock" placeholder="Stock">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="descripcion" placeholder="Descripcion">
                    </div>
                    <div>
                    <select name="category" class="form-control">
                    {foreach from=$Category item=category}
                        <option value="{$category->id_category}">{$category->category}</option>
                    {/foreach}
                    </select>
                    </div>
                    <div class="col">
                        <input type="file" class="form-control uploadImagen" name="input_name" id="imagenUpload" >
                    </div>
                </div>
                    <div class="col" style="padding: 0;">
                        <button type="submit" class="btn btn-outline-dark btn-insert">Insertar</button>
                    </div>
            </form>
        {/if}
    </div>
    

    <div class="container ">
    <div class="container "> 
    {if $logged == 2}
        <table class="table table-striped table-dark tabla table-responsive-md marginSection" >
    {else}
        <table class="table table-striped table-dark tabla table-responsive-md marginSection">
    {/if} 
            <thead class="thead-dark">
                <tr>
                    <th scope="col">imagen</th>
                    <th scope="col">nombre</th>
                    <th scope="col">precio</th>
                    <th scope="col">stock</th>
                    <th scope="col">category</th>
                    <th scope="col">ver mas</th>
                    {if $logged == 2}
                        <th scope="col">Delete</th>
                        <th scope="col">Update</th>
                    {/if}
                </tr>
            </thead>
            <tbody>
                {foreach from=$Products item=product}
                    <tr>
                        <th scope="col"><img src="{$product->imagen}" class="card-img-top" alt="Card image cap"></th>
                        <th scope="col">{$product->nombre}</th>
                        <th scope="col">{$product->price}</th>
                        <th scope="col">{$product->stock}</th>
                        <th scope="col">{$product->category}</th>
                        <th scope="col"><a href="productos/{$product->id_product}" class="btn btn-dark" value="{$product->id_product}">Descripcion</a></th>
                        {if $logged == 2}
                            <th scope="col"><a href="delete/{$product->id_product}" class="btn btn-dark" value="{$product->id_product}">Eliminar</a></th>
                            <th><button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal{$product->id_product}">Modificar</button></th>
                            <div class="modal fade" id="exampleModal{$product->id_product}" tabindex="-2" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modificar</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="update/{$product->id_product}" method="POST" class="container" enctype="multipart/form-data">
        
                                                <div class="form-group">
        
                                                    <input type="text" class="form-control" name="nombreUpdate" value="{$product->nombre}">
                                                </div>
                                                <div class="form-group">
        
                                                    <input type="text" class="form-control" name="priceUpdate" value="{$product->price}">
                                                </div>
                                                <div class="form-group">
        
                                                    <input type="text" class="form-control" name="stockUpdate" value="{$product->stock}">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="descripcionUpdate" value="{$product->descripcion}">
                                                </div>
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" name="image" id="image" value="{$product->imagen}">
                                                    <input type="file" class="form-control" name="imagen" id="imagenUpload" value="{$product->imagen}" placeholder="{$product->imagen}">
                                                </div>
                                                <div>
                                                    <select name="categoryUpdate" class="form-control">
                                                        {foreach from=$Category item=category}
                                                            <option value="{$category->id_category}">{$category->category}</option>
                                                        {/foreach}
                                                    </select>
                                                </div>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-outline-dark">update</button>
                                            </form>
                                        </div>
        
                                    </div>
                                </div>
                            </div>
            </div>
        {/if}
        </tr>
    {/foreach}
    </tbody>
 
    <table class="table table-striped table-dark tabla table-responsive-md margentabla">
    <div class="paginador">
        <ul>{*FALTA QUE REDIRECCIONE Y CONSULTE POR EL NUEVO ELEMENTO*}
        {for $foo=1 to $CantidadProductos}
            <li><a href="pagina/{$foo}">{$foo}</a></li>
        {/for}
        </ul>
    </div>
        {if $logged == 2}
            <form action="insertCategory" method="POST">
                <div class="form-row ">
                    <div class="col">
                        <input type="text" class="form-control" name="nameCategory" placeholder="Nombre Categoria">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-outline-dark">Insertar</button>
                    </div>
                </div>
            </form>
        {/if}
        <p>Haz click en el nombre de las categorias para ver que productos contiene cada una!</p>
        <thead class="thead-dark">
            <tr>

                <th scope="col">nombre</th>
                {if $logged == 2}
                    <th scope="col">eliminar</th>
                    <th scope="col">modificar</th>
                {/if}
            </tr>
        </thead>
        <tbody>
            {foreach from=$Category item=category}
                <tr>

                    <th scope="col"><a href="category/{$category->id_category}"  class="letterCategory">{$category->category}</a></th>
                    {if $logged == 2}
                        <th scope="col"><a href="deleteCategory/{$category->id_category}" class="btn btn-dark" value="{$category->id_category}">Eliminar</a></th>
                        <th><button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal{$category->id_category}">Modificar</button></th>
                        <div class="modal fade" id="exampleModal{$category->id_category}" tabindex="-2" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modificar</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="updateCategory/{$category->id_category}" method="POST" class="container">
        
                                            <div class="form-group">
        
                                                <input type="text" class="form-control" name="nombreUpdateCategory" value="{$category->category}">
                                            </div>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-outline-dark">update</button>
                                        </form>
                                    </div>
        
                                </div>
                            </div>
                        </div>
                    {/if}
                </tr>
            {/foreach}
        </tbody>
    </table>
    </div>
</section>

{include file='./footer.tpl'}