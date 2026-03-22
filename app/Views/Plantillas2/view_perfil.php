<!--div class="container mt-4" id="ContenedorLogin" style="height:420px; width: 600px;">
    <h1 style="text-align: center; border-bottom: 2px solid #7DA128;" class="mt-4"><i class="fa-solid fa-user"></i></h1> 
    
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mx-12 justify-content-center">

            <div class="col-md-12" style="text-align: center; font-size:23px; text-transform: uppercase; font-weight: bold; font-family: Georgia;">
                <label for="usuario" class="form-label"> <?php echo $usuario['nombre']?> <?php echo $usuario['apellido']?></label>
            </div>

            <div class="row justify-content-justify">
                <div class="col-md-6 mt-2">
                    <label for="usuario" class="form-label"> <strong>Usuario:</strong> <h6 style="margin:5px;">@<?php echo $usuario['nombre_usuario']?></h6></label>
                </div>

                <div class="col-md-6 mt-2">
                    <label for="usuario" class="form-label"> <strong>Email:</strong> <h6 style="margin:5px;"><?php echo $usuario['email']?></h6></label>
                </div>
                
                <?php if($usuario['telefono'] != NULL): ?>
                    <div class="col-md-6 mt-2">
                        <label for="usuario" class="form-label"> <strong>Telefono:</strong> <h6 style="margin:5px;"><?php echo $usuario['telefono']?></h6></label>
                    </div>
                <?php else : ?>
                    <div class="col-md-6 mt-2">
                        <label for="usuario" class="form-label"> <strong>Teléfono:</strong> <h6 style="margin:5px; text-align:center;">-</h6></label>
                    </div>
                <?php endif; ?>

                <?php if($usuario['perfil_id'] == '1'): ?>
                    <div class="col-md-6 mt-2">
                        <label for="usuario" class="form-label"> <strong>Perfil:</strong> <h6 style="margin:5px;">Administrador</h6></label>
                    </div>
                <?php else : ?>
                    <div class="col-md-6 mt-2">
                        <label for="usuario" class="form-label"> <strong>Perfil:</strong> <h6 style="margin:5px;">Cliente</h6></label>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <h1 style="text-align: center; border-bottom: 2px solid #7DA128;" class="mt-4"></h1>
</div-->

