<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Hardware',
                'description' => 'Problemas relacionados a computadores, peças e equipamentos físicos.',
                'active' => true,
            ],

            [
                'name' => 'Software',
                'description' => 'Falhas, erros ou instalação de programas e aplicativos.',
                'active' => true,
            ],

            [
                'name' => 'Rede',
                'description' => 'Problemas de conexão, internet, Wi-Fi e comunicação de rede.',
                'active' => true,
            ],

            [
                'name' => 'Impressora',
                'description' => 'Erros de impressão, configuração e manutenção de impressoras.',
                'active' => true,
            ],

            [
                'name' => 'Sistema',
                'description' => 'Problemas internos do sistema HelpDesk ou sistemas corporativos.',
                'active' => true,
            ],

            [
                'name' => 'E-mail',
                'description' => 'Problemas relacionados ao envio, recebimento ou acesso ao e-mail.',
                'active' => true,
            ],

            [
                'name' => 'Acesso',
                'description' => 'Solicitações de login, permissões e recuperação de acesso.',
                'active' => true,
            ],

            [
                'name' => 'Segurança',
                'description' => 'Incidentes de segurança, vírus, malware e vulnerabilidades.',
                'active' => true,
            ],

            [
                'name' => 'Outros',
                'description' => 'Categoria para problemas que não se encaixam nas demais.',
                'active' => true,
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::updateOrCreate(
                [
                    'name' => $categoryData['name'],
                ],
                $categoryData
            );
        }
    }
}