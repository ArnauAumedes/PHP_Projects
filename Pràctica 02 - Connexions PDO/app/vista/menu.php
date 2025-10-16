<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Gestió d'Articles - Sistema CRUD</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/practicas/Pràctica 02 - Connexions PDO/public/css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            
            <?php
            // Mostrar mensajes de éxito o error después de eliminar
            if (isset($_GET['deleted'])):
                switch ($_GET['deleted']) {
                    case 'success':
                        $deletedId = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Èxit!</strong> Article amb ID ' . $deletedId . ' eliminat correctament.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                              </div>';
                        break;
                    case 'error':
                        $errorMsg = isset($_GET['msg']) ? htmlspecialchars($_GET['msg']) : 'No s\'ha pogut eliminar l\'article';
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error!</strong> ' . $errorMsg . '
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                              </div>';
                        break;
                    case 'noid':
                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Atenció!</strong> ID d\'article no proporcionat.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                              </div>';
                        break;
                }
            endif;
            
            // Mostrar mensajes después de crear
            if (isset($_GET['created'])):
                switch ($_GET['created']) {
                    case 'success':
                        $createdId = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Èxit!</strong> Article creat correctament amb ID ' . $createdId . '.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                              </div>';
                        break;
                    case 'error':
                        $errorMsg = isset($_GET['msg']) ? htmlspecialchars($_GET['msg']) : 'No s\'ha pogut crear l\'article';
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error!</strong> ' . $errorMsg . '
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                              </div>';
                        break;
                }
            endif;
            
            // Mostrar mensajes después de actualizar
            if (isset($_GET['updated'])):
                switch ($_GET['updated']) {
                    case 'success':
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Èxit!</strong> Article actualitzat correctament.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                              </div>';
                        break;
                }
            endif;
            ?>
            
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Gestionar <b>Articles</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="?action=create" class="btn btn-success"><i class="material-icons">&#xE147;</i> <span>Afegir Nou Article</span></a>
                        <a href="?action=update" class="btn btn-warning"><i class="material-icons">&#xE254;</i> <span>Actualitzar</span></a>
                        <a href="/practicas/Pràctica 02 - Connexions PDO/app/vista/delete.php" class="btn btn-danger"><i class="material-icons">&#xE15C;</i> <span>Eliminar</span></a>                        
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Títol</th>
                        <th>Cos</th>
                        <th>DNI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($error_message)): ?>
                        <tr>
                            <td colspan="4" class="text-center text-danger">
                                <strong><?php echo htmlspecialchars($error_message); ?></strong>
                            </td>
                        </tr>
                    <?php elseif (empty($articles)): ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                <em>No hi ha articles disponibles. <a href="?action=create">Crea el primer article</a></em>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($articles as $index => $article): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($article->getId()); ?></td>
                            <td><?php echo htmlspecialchars($article->getTitol()); ?></td>
                            <td><?php echo htmlspecialchars(substr($article->getCos(), 0, 50)) . (strlen($article->getCos()) > 50 ? '...' : ''); ?></td>
                            <td><?php echo htmlspecialchars($article->getDni()); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>        
</div>

<script>
$(document).ready(function(){
    // Activar tooltip
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
</body>
</html>