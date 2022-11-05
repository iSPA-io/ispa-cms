<?php

namespace Database\Seeders;

use App\Constants\Tables;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $tables = [
            Tables::AUDIT_LOGS => ['viewAny', 'view'],
            Tables::ENUMERATES => ['viewAny', 'view', 'create', 'edit', 'update', 'delete'],
            Tables::ENUMERATES_TYPE => ['viewAny', 'view', 'create', 'edit', 'update', 'delete'],
            Tables::LANGUAGES => ['viewAny', 'view', 'create', 'edit', 'update', 'delete', 'locked'],
            Tables::PERMISSIONS => ['viewAny', 'view', 'create', 'edit', 'update', 'delete', 'group_delete'],
            Tables::ROLES => ['viewAny', 'view', 'create', 'edit', 'update', 'delete'],
            Tables::USERS => ['viewAny', 'view', 'create', 'edit', 'update', 'delete', 'email', 'username', 'mobile', 'role', 'type', 'password'],
        ];

        foreach ($tables as $table => $actions) {
            foreach ($actions as $action) {
                (new Permission())->create([
                    'group' => str($table)->singular(),
                    'name' => $action,
                    'title' => $this->getTitleByName($action),
                ]);
            }
        }
    }

    /**
     * Get the title by name
     *
     * @author malayvuong
     * @since 7.0.0 - 2022-09-29, 00:05 ICT
     */
    protected function getTitleByName(string $action): string
    {
        return match ($action) {
            'viewAny' => 'View any | Xem tất cả',
            'view' => 'View detail | Xem chi tiết',
            'create' => 'POST Create new | Tạo mới',
            'edit' => 'GET Edit | Lấy dữ liệu để sửa',
            'update' => 'POST Update | Cập nhật',
            'delete' => 'Delete | Xóa',
            'group_delete' => 'Group delete | Xóa nhiều',
            'email' => 'Edit Email | Sửa Email',
            'username' => 'Edit Username | Sửa Username',
            'mobile' => 'Edit Mobile | Sửa Mobile',
            'role' => 'Change User Role | Thay đổi quyền của User',
            'type' => 'Change User Type | Thay đổi loại của User',
            'password' => 'Reset Password | Đặt lại mật khẩu',
            'locked' => 'Lock to read only | Khóa chỉ xem',
            default => $action,
        };
    }
}
