<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;
use App\Models\UsuarioModel;
use App\Models\SocioModel;
                        

class UsuariosSeeder extends Seeder {

    public function run(){

        $faker = Factory::create();
        $this->usuarioModel = new UsuarioModel();
        $this->socioModel = new SocioModel();
        $socios = [];
        $bir = [];
        $usuarios = [];

        for ($i=0; $i <= 3; $i++) { 
            $usuarios[] = [
                'nombre' => $faker->name,
                'cedula' => '1705520227',
                'email' => $faker->email,
                'user' => $faker->userName,
                'password' => md5($faker->password),
                'telefono' => md5($faker->phoneNumber),
                'direccion' => md5($faker->address),
                'acuerdo_terminos' => 1,
                'idciudad' => 178,
                'estado' => 1,
                'idrol' => 2,   
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }
        
        $this->db->table('usuarios')->insertBatch($usuarios);

        //SOCIOS
        foreach ($usuarios as $usuario) {
            $id = $this->usuarioModel->where('nombre', $usuario['nombre'])->findAll();
            $socios[] = [
                'codigo_socio' => $faker->unique->numerify('GTK-#####'),
                'patrocinador' => '1',
                'nodopadre' => 0,
                'posicion' => 0,
                'fecha_inscripcion' => date('Y-m-d H:i:s'),
                'porcentaje_billetera' => 0, 
                'idusuario' => $id[0]->id, 
                'idrango' => 1,
                'estado' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }
        $this->db->table('socios')->insertBatch($socios);

        //BIR
        foreach ($socios as $socio) {
            $id = $this->socioModel->where('codigo_socio', $socio['codigo_socio'])->findAll();
            $bir[] = [
                'idsocio' => 1,
                'socio_nuevo' => $id[0]->id,
                'cantidad' => 50,
                'concepto' => 'INGRESO POR BIR ACREDITADO',
                'fecha' => date('Y-m-d H:i:s'),
                'estado' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $inscripciones[] = [
                'idsocio' => $id[0]->id,
                'pago' => '50',
                'estado' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }
        $this->db->table('inscripciones')->insertBatch($inscripciones);
        $this->db->table('bir')->insertBatch($bir);
    }
}
