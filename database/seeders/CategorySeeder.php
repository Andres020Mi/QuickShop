<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Tecnología', 'description' => 'Dispositivos, gadgets y software.'],
            ['name' => 'Ropa', 'description' => 'Prendas de vestir, accesorios de moda y calzado.'],
            ['name' => 'Deportes', 'description' => 'Equipamiento deportivo, ropa y accesorios para el deporte.'],
            ['name' => 'Hogar y Decoración', 'description' => 'Muebles, decoración del hogar y productos esenciales para tu espacio.'],
            ['name' => 'Belleza', 'description' => 'Cosméticos, cuidado de la piel y productos de bienestar.'],
            ['name' => 'Libros', 'description' => 'Libros de ficción, no ficción y educativos.'],
            ['name' => 'Juguetes', 'description' => 'Juguetes y juegos para niños de todas las edades.'],
            ['name' => 'Alimentos', 'description' => 'Comida, bebidas y artículos para el hogar.'],
            ['name' => 'Automotriz', 'description' => 'Piezas de automóvil, accesorios y herramientas.'],
            ['name' => 'Salud y Bienestar', 'description' => 'Equipos de fitness, suplementos alimenticios y productos de bienestar.'],
            ['name' => 'Bebé y Niños', 'description' => 'Productos para el cuidado del bebé, ropa y juguetes para niños.'],
            ['name' => 'Electrónica', 'description' => 'Electrodomésticos, teléfonos móviles, computadoras y accesorios.'],
            ['name' => 'Joyería y Relojes', 'description' => 'Anillos, collares, pulseras y relojes.'],
            ['name' => 'Música y Películas', 'description' => 'CDs, vinilos, DVDs, Blu-rays y servicios de streaming.'],
            ['name' => 'Alimentos y Bebidas', 'description' => 'Comida gourmet, snacks, bebidas y más.'],
            ['name' => 'Material de Oficina', 'description' => 'Mobiliario de oficina, papelería y suministros.'],
            ['name' => 'Mascotas', 'description' => 'Alimentos para mascotas, juguetes y accesorios para todo tipo de animales.'],
            ['name' => 'Papelería', 'description' => 'Cuadernos, bolígrafos, papeles y otros artículos de papelería.'],
            ['name' => 'Jardín y Exterior', 'description' => 'Herramientas de jardinería, muebles de exterior y accesorios para patio.'],
            ['name' => 'Instrumentos Musicales', 'description' => 'Guitarras, teclados, baterías y otros instrumentos musicales.'],
            ['name' => 'Viajes y Equipaje', 'description' => 'Maletas, accesorios de viaje y artículos esenciales para el equipaje.'],
            ['name' => 'Arte y Manualidades', 'description' => 'Materiales de arte, manualidades y kits de bricolaje.'],
            ['name' => 'Vintage', 'description' => 'Artículos coleccionables, ropa vintage y muebles retro.'],
            ['name' => 'Muebles', 'description' => 'Muebles para la sala, el dormitorio, la cocina y la oficina.'],
            ['name' => 'Deportes al Aire Libre', 'description' => 'Equipo para ciclismo, senderismo, camping y pesca.'],
            ['name' => 'Lujo', 'description' => 'Productos de alta gama, marcas exclusivas y artículos de lujo.'],
            ['name' => 'Regalos y Ocasiones', 'description' => 'Artículos para regalar en cumpleaños, aniversarios y ocasiones especiales.'],
            ['name' => 'Cervezas Artesanales y Licores', 'description' => 'Cervezas artesanales, vinos y licores de todo el mundo.'],
            ['name' => 'Coleccionables', 'description' => 'Cómics, artículos raros y coleccionables de diversas categorías.'],
        ]);
    }
}
