<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'view banners', 'create banners', 'edit banners', 'delete banners',
            'view programs', 'create programs', 'edit programs', 'delete programs',
            'view notices', 'create notices', 'edit notices', 'delete notices',
            'view events', 'create events', 'edit events', 'delete events',
            'view downloads', 'create downloads', 'edit downloads', 'delete downloads',
            'view faqs', 'create faqs', 'edit faqs', 'delete faqs',
            'view pages', 'create pages', 'edit pages', 'delete pages',
            'view contacts', 'delete contacts',
            'view users', 'create users', 'edit users', 'delete users',
        ];

        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::firstOrCreate(['name' => $permission]);
        }

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $editor = Role::firstOrCreate(['name' => 'editor']);

        $admin->givePermissionTo(\Spatie\Permission\Models\Permission::all());

        $editorPerms = [
            'view banners', 'create banners', 'edit banners',
            'view programs', 'create programs', 'edit programs',
            'view notices', 'create notices', 'edit notices',
            'view events', 'create events', 'edit events',
            'view downloads', 'create downloads', 'edit downloads',
            'view faqs', 'create faqs', 'edit faqs',
            'view pages', 'edit pages',
            'view contacts',
        ];
        $editor->givePermissionTo($editorPerms);
    }
}
