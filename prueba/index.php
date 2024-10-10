<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Users</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1, h2 {
            color: #333;
            text-align: center;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        input[type="text"], input[type="email"], input[type="number"], input[type="submit"] {
            display: block;
            width: calc(100% - 20px);
            margin: 10px auto;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            cursor: pointer;
            border: none;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        table th {
            background-color: #007bff;
            color: white;
        }
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .action-btn {
            background-color: #dc3545;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            border: none;
        }
        .action-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>CRUD de Usuarios</h1>

    <!-- Formulario para insertar un nuevo usuario -->
    <h2>Insertar Usuario</h2>
    <form action="insertar.php" method="POST">
        <input type="text" name="name" placeholder="Nombre" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="submit" value="Insertar">
    </form>

    <!-- Formulario para actualizar un usuario -->
    <h2>Actualizar Usuario</h2>
    <form action="actualizar.php" method="POST">
        <input type="number" name="id" placeholder="ID de usuario" required>
        <input type="text" name="name" placeholder="Nuevo nombre" required>
        <input type="email" name="email" placeholder="Nuevo email" required>
        <input type="submit" value="Actualizar">
    </form>

    <!-- Formulario para borrar un usuario -->
    <h2>Borrar Usuario</h2>
    <form action="borrar.php" method="POST">
        <input type="number" name="id" placeholder="ID de usuario" required>
        <input type="submit" value="Borrar">
    </form>

    <!-- Sección para leer los usuarios -->
    <h2>Lista de Usuarios</h2>
    <form action="leer.php" method="GET">
        <input type="submit" value="Leer Usuarios">
    </form>

    <!-- Tabla para mostrar los usuarios (si se usa en leer.php) -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <!-- Aquí se mostrarán los usuarios desde leer.php -->
            <!-- Ejemplo estático -->
            <tr>
                <td>1</td>
                <td>Joker</td>
                <td>joker@dominio.es</td>
                <td><a href="borrar.php?id=1" class="action-btn">Borrar</a></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Promethea</td>
                <td>promethea@dominio.es</td>
                <td><a href="borrar.php?id=2" class="action-btn">Borrar</a></td>
            </tr>
        </tbody>
    </table>
</div>

</body>
</html>
