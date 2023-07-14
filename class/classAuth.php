<?php

    require_once './class/conexion/conexion.php';
    require_once './class/respuestas.php';

    class auth extends conexion {

        public function login($dataJson){
            $_respuestas = new respuestas;
            $datos = json_decode($dataJson,true);
            if(!isset($datos['usuario']) || !isset($datos['password'])){
                //error con los campos
                return $_respuestas->error_400();
            }else{
                //todo esta bien
                $usuario = $datos['usuario'];
                $password = $datos['password'];
                $password = parent::encriptarPassword($password);
                $datos = $this->obtenerDatosUsuario($usuario);

                if($datos){
                    //si existe el usuario
                    if ($password == $datos[0]['usu_password']) {
                        if ($datos[0]['usu_estado'] == 1) {
                            // crear token
                            $verificar = $this->insertarToken($datos[0]['usu_id']);
                            if($verificar){
                                //si se guardo
                                $result = $_respuestas->response;
                                $result['result'] = array(
                                    'token' => $verificar
                                );
                                return $result;
                            }else{
                                //error al guardar token
                                return $_respuestas->error_500('Error interno, no hemos podido guaradar');
                            }

                        }else{
                            return $_respuestas->error_200('el usuario esta inactivo');
                        }
                    }else{
                        return $_respuestas->error_200('contraseña incorrecta');
                    }
                }else{
                    //si no existe el usuario
                    return $_respuestas->error_200("el usuario $usuario no existe");
                }

            }
        }

        private function obtenerDatosUsuario($correo){
            $query = "SELECT * from usuario WHERE usu_correo = '$correo'";
            $datos = parent::obtenerDatos($query);
            if(isset($datos[0]["usu_id"])){
                return $datos;
            }else{
                return 0;
            }
        }

        private function insertarToken($usuarioId){
            $val = true;
            $token = bin2hex(openssl_random_pseudo_bytes(16,$val));
            $date = date("Y-m-d H:i");
            $estado = 1;
            $query = "UPDATE usuario SET usu_token = '$token' WHERE usu_id = $usuarioId";
            $verifica = parent::nonQuery($query);
            if($verifica){
                return $token;
            }else{
                return 0;
            }
        }

    }

?>