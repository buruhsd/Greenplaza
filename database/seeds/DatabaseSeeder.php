<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(ConfBankTableSeeder::class);
        $this->call(ConfCityTableSeeder::class);
        $this->call(ConfConfigsTableSeeder::class);
        $this->call(ConfGradeTableSeeder::class);
        $this->call(ConfIklanTableSeeder::class);
        $this->call(ConfKomplainTableSeeder::class);
        $this->call(ConfOfficialEmailTableSeeder::class);
        $this->call(ConfPageTableSeeder::class);
        $this->call(ConfPaketHotlistTableSeeder::class);
        $this->call(ConfPaketIklanTableSeeder::class);
        $this->call(ConfPaketPincodeTableSeeder::class);
        $this->call(ConfPaymentTableSeeder::class);
        $this->call(ConfProdukLocationTableSeeder::class);
        $this->call(ConfProdukUnitTableSeeder::class);
        $this->call(ConfProvinceTableSeeder::class);
        $this->call(ConfShipmentTableSeeder::class);
        $this->call(ConfSolusiTableSeeder::class);
        $this->call(ConfSubdistrictTableSeeder::class);
        $this->call(ConfWalletTypeTableSeeder::class);
        $this->call(SysWalletTableSeeder::class);
        $this->call(SysWithdrawalTableSeeder::class);
        $this->call(SysWishlistTableSeeder::class);
        $this->call(SysUserTreeTableSeeder::class);
        $this->call(SysUserShipmentTableSeeder::class);
        $this->call(SysUserDetailTableSeeder::class);
        $this->call(SysUserBankTableSeeder::class);
        $this->call(SysUserAddressTableSeeder::class);
        $this->call(SysTransTableSeeder::class);
        $this->call(SysTransDetailTableSeeder::class);
        $this->call(SysTransHotlistTableSeeder::class);
        $this->call(SysTransIklanTableSeeder::class);
        $this->call(SysTransPincodeTableSeeder::class);
        $this->call(SysCategoryTableSeeder::class);
        $this->call(SysBrandTableSeeder::class);
        $this->call(SysProdukTableSeeder::class);
        $this->call(SysProdukDiscussTableSeeder::class);
        $this->call(SysProdukDiscussReplyTableSeeder::class);
        $this->call(SysProdukGrosirTableSeeder::class);
        $this->call(SysProdukImageTableSeeder::class);
        $this->call(SysReviewTableSeeder::class);
        $this->call(SysSolusiTableSeeder::class);
        $this->call(SysPincodeTableSeeder::class);
        $this->call(SysMessageTableSeeder::class);
        $this->call(SysKomplainTableSeeder::class);
        $this->call(SysKomplainDiscussTableSeeder::class);
        $this->call(SysKomplainPicTableSeeder::class);
        $this->call(SysIklanTableSeeder::class);
        $this->call(SysEmailTableSeeder::class);
        $this->call(PasswordResetsTableSeeder::class);
        $this->call(MigrationsTableSeeder::class);
        $this->call(LogWalletTableSeeder::class);
        $this->call(LogIklanTableSeeder::class);
        $this->call(LogActivityTableSeeder::class);
    }
}
