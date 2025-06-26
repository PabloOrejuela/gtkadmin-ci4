<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TruncateDb extends Seeder {

    public function run() {
        // $this->db->table('socios')->truncate();
        $this->db->table('bir')->truncate();
        $this->db->table('inscripciones')->truncate();
        $this->db->table('socios')->where('id >', 3)->delete();
        $this->db->table('usuarios')->where('id >', 3)->delete();
    }
}
