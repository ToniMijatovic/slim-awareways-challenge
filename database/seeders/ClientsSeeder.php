<?php
use Phinx\Seed\AbstractSeed;

class ClientsSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'name' => 'Walter'
            ],
            [
                'name' => 'Jesse'
            ],
            [
                'name' => 'Skylar'
            ],
            [
                'name' => 'Hank'
            ],
            [
                'name' => 'Gus'
            ],
            [
                'name' => 'Mike'
            ],
            [
                'name' => 'Saul'
            ]
        ];

        $clients = $this->table('client');
        $clients->insert($data)->save();
    }
}
