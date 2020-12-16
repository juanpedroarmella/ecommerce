<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="../css/styles.css">
    <base href="{BASE_URL}">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <title>documento</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="home">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="navbar-brand" href="pagina/1">Productos <span class="sr-only">(current)</span></a>
                    </li>
                    {if $logged==0}
                        <li class="nav-item active">
                            <a class="navbar-brand" href="registro">Registrarse <span class="sr-only">(current)</span></a>
                        </li>
                    {/if}
                    {if $logged==2}
                        <li class="nav-item active">
                            <a class="navbar-brand" href="users">Usuarios <span class="sr-only">(current)</span></a>
                        </li>
                    {/if}
                    <li class="nav-item active">
                        <div class="container ">
                            <form action="searchProducts" method="POST" class="form-inline my-2 my-lg-0">
                                <input class="form-control mr-sm-2" name="inputBuscar" placeholder="Buscar Producto" aria-label="Search">
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                            </form>
                        </div>
                    </li>
                </ul>
                {if $logged==0}
                    <form action="verifyUser" method="POST" class="form-inline">
                        <div class="form-group mb-2">
                            <input type="text" class="form-control" name="user" placeholder="user">
                        </div>
                        <div class="form-group mx-sm-2 mb-2">
                            <input type="password" name="pass" class="form-control" id="inputPassword2" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Login</button>
                    </form>
                {/if}
                {if $logged==1 || $logged==2}
                    <a href="logout" class="btn btn-danger">logout</a>
                {/if}
            </div>
        </nav>
    </header>