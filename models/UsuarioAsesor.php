<?php
class Usuario extends Conectar
{
    /* Funcion para login de acceso del usuario */
    public function login()
    {
        $conectar = parent::conexion();
        parent::set_names();
        if (isset($_POST["enviar"])) {
            $correo = $_POST["usu_correo"];
            $pass = $_POST["usu_pass"];
            if (empty($correo) and empty($pass)) {
                /* En caso esten vacios correo y contraseña, devolver al index con mensaje = 2 */
                header("Location:" . conectar::ruta() . "index.php?m=2");
                exit();
            } else {
                // $sql = "select * from  sc_gitse3.tb_usuario	where  usuario_login  = 'WBALSA' and usuario_clave = '123'";

                $sql = "select * from  sc_gitse3.tb_usuario	where  usuario_login  = ? and usuario_clave = ? ";
                $stmt = $conectar->prepare($sql);
                $stmt->bindValue(1, $correo);
                $stmt->bindValue(2, $pass);
                $stmt->execute();
                $resultado = $stmt->fetch();
                if (is_array($resultado) and count($resultado) > 0) {
                    $_SESSION["usuario_id"] = $resultado["usuario_id"];
                    $_SESSION["usuario_login"] = $resultado["usuario_login"];
                    // $_SESSION["usu_ape"] = $resultado["usu_ape"];
                    // $_SESSION["usu_correo"] = $resultado["usu_correo"];
                    // $_SESSION["rol_id"] = $resultado["rol_id"];
                    /* Si todo esta correcto indexar en home */
                    header("Location:" . Conectar::ruta() . "view/UsuHome/");
                    exit();
                } else {
                    /* En caso no coincidan el usuario o la contraseña */
                    header("Location:" . conectar::ruta() . "index.php?m=1");
                    exit();
                }
            }
        }
    }

    /* Mostrar los datos del usuario segun el ID */
    public function get_usuario_x_id($usu_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_usuario WHERE est=1 AND usu_id=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /* Actualizar la informacion del perfil del usuario segun ID */
    public function update_usuario_perfil($usu_id, $usu_nom, $usu_apep, $usu_apem, $usu_pass, $usu_sex, $usu_telf)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_usuario 
                SET
                    usu_nom = ?,
                    usu_apep = ?,
                    usu_apem = ?,
                    usu_pass = ?,
                    usu_sex = ?,
                    usu_telf = ?
                WHERE
                    usu_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_nom);
        $sql->bindValue(2, $usu_apep);
        $sql->bindValue(3, $usu_apem);
        $sql->bindValue(4, $usu_pass);
        $sql->bindValue(5, $usu_sex);
        $sql->bindValue(6, $usu_telf);
        $sql->bindValue(7, $usu_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /* Funcion para insertar usuario */
    public function insert_usuario($usu_nom, $usu_apep, $usu_apem, $usu_correo, $usu_pass, $usu_sex, $usu_telf, $rol_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO tm_usuario (usu_id,usu_nom,usu_apep,usu_apem,usu_correo,usu_pass,usu_sex,usu_telf,rol_id,fech_crea, est) VALUES (NULL,?,?,?,?,?,?,?,?,now(),'1');";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_nom);
        $sql->bindValue(2, $usu_apep);
        $sql->bindValue(3, $usu_apem);
        $sql->bindValue(4, $usu_correo);
        $sql->bindValue(5, $usu_pass);
        $sql->bindValue(6, $usu_sex);
        $sql->bindValue(7, $usu_telf);
        $sql->bindValue(8, $rol_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /* Funcion para actualizar usuario */
    public function update_usuario($usu_id, $usu_nom, $usu_apep, $usu_apem, $usu_correo, $usu_pass, $usu_sex, $usu_telf, $rol_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_usuario
                SET
                    usu_nom = ?,
                    usu_apep = ?,
                    usu_apem = ?,
                    usu_correo = ?,
                    usu_pass = ?,
                    usu_sex = ?,
                    usu_telf = ?,
                    rol_id = ?
                WHERE
                    usu_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_nom);
        $sql->bindValue(2, $usu_apep);
        $sql->bindValue(3, $usu_apem);
        $sql->bindValue(4, $usu_correo);
        $sql->bindValue(5, $usu_pass);
        $sql->bindValue(6, $usu_sex);
        $sql->bindValue(7, $usu_telf);
        $sql->bindValue(8, $rol_id);
        $sql->bindValue(9, $usu_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /* Eliminar cambiar de estado a la categoria */
    public function delete_usuario($usu_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_usuario
                SET
                    est = 0
                WHERE
                    usu_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /* Listar todas las categorias */
    public function get_usuario()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_usuario WHERE est = 1";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /* Listar todas las categorias */
    public function get_usuario_modal($cur_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_usuario 
                WHERE est = 1
                AND usu_id not in (select usu_id from td_curso_usuario where cur_id=? AND est=1)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $cur_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
}
