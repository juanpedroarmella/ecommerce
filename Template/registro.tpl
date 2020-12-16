{include file='./header.tpl'}
<div class="container-fluid">
    <div>
        <h3> Registrese en nuestro sitio web!</h3>
    </div>
    <div>
        <form method="POST" action="insertUser">
            <div class="form-group">
                <label >Nombre Usuario</label>
                <input type="text" class="form-control" name="usuario">
            </div>
            <div class="form-group">
                <label >Contraseña</label>
                <input type="password" class="form-control" name="contrasenia" >
            </div>
            <button type="submit" class="btn btn-primary">Registrarse!</button>
        </form>
    </div>
</div>
{include file='./footer.tpl'}