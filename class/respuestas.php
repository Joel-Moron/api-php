<?php
    class respuestas{

        public $response = [
            'status' => 'ok',
            'result' => array()
        ];

        public function error_405(){
            $this->response['status'] = 'error';
            $this->response['result'] = array(
                'error_id' => '405',
                'error_msg' => 'Metodo no permitido'
            );
            return $this->response;
        }

        public function error_200($tring = 'Datos incorrectos'){
            $this->response['status'] = 'error';
            $this->response['result'] = array(
                'error_id' => '200',
                'error_msg' => $tring
            );
            return $this->response;
        }

        public function error_400(){
            $this->response['status'] = 'error';
            $this->response['result'] = array(
                'error_id' => '400',
                'error_msg' => 'Datos enviados incompletos o cn formato incorrecto'
            );
            return $this->response;
        }

        public function error_500($tring = 'Error interno del servidor'){
            $this->response['status'] = 'error';
            $this->response['result'] = array(
                'error_id' => '500',
                'error_msg' => $tring
            );
            return $this->response;
        }


    }
?>