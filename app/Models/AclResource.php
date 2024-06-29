<?php

namespace App\Models;

class AclResource
{
    // menus
    const SYSTEM_MENU = 'system-menu';
    const PURCHASING_MENU = 'purchasing-menu';
    const SALES_MENU = 'sales-menu';
    const INVENTORY_MENU = 'inventory-menu';
    const SERVICE_MENU = 'service-menu';
    const REPORT_MENU = 'report-menu';
    const EXPENSE_MENU = 'cost-menu';
    const FINANCE_MENU = 'finance-menu';
    const WITNESS_MENU = 'witness-menu';
    const OFFICER_MENU = 'officer-menu';
    const ORDER_MENU = 'order-menu';

    // reports
    const VIEW_REPORTS = 'view-reports';

    // system
    const USER_ACTIVITY = 'user-activity';
    const USER_MANAGEMENT = 'user-management';
    const USER_GROUP_MANAGEMENT = 'user-group-management';
    const WITNESS_MANAGEMENT = 'witness-management';
    const OFFICER_MANAGEMENT = 'officer-management';
    const PARTNER_MANAGEMENT = 'partner-management';
    const SERVICE_MANAGEMENT = 'service-management';
    const SETTINGS = 'settings';
    const CUSTOMER_MANAGEMENT = 'customer-management';

    // cash transaction
    const CASH_TRANSACTION_CATEGORY_MANAGEMENT = 'cash-transaction-category-management';
    const CASH_ACCOUNT_MANAGEMENT = 'cash-account-management';
    const CASH_TRANSACTION_MANAGEMENT = 'cash-transaction-management';

    // expenses
    const EXPENSE_CATEGORY_MANAGEMENT = 'expense-category-management';
    const EXPENSE_MANAGEMENT = 'expense-management';

    public static function all()
    {
        return [
            'Manajemen Order' => [
                self::ORDER_MENU => 'Menu Pesanan',
                self::CUSTOMER_MANAGEMENT => 'Kelola Pelanggan',
            ],
            'Manajemen Keuangan' => [
                self::FINANCE_MENU => 'Menu Keuangan',
                self::CASH_ACCOUNT_MANAGEMENT => 'Kelola Akun / Rekening',
                self::CASH_TRANSACTION_MANAGEMENT => 'Kelola Transaksi Keuangan',
                self::CASH_TRANSACTION_CATEGORY_MANAGEMENT => 'Kelola Kategori Transaksi',
            ],
            'Manajemen Sistem' => [
                self::SYSTEM_MENU => 'Menu sistem',
                self::USER_ACTIVITY => 'Aktifitas Pengguna',
                self::USER_MANAGEMENT => 'Pengguna',
                self::USER_GROUP_MANAGEMENT => 'Grup pengguna',
                self::SETTINGS => 'Pengaturan',
                self::WITNESS_MANAGEMENT => 'Kelola Saksi',
                self::OFFICER_MANAGEMENT => 'Kelola Officer',
                self::PARTNER_MANAGEMENT => 'Kelola Partner',
                self::SERVICE_MANAGEMENT => 'Kelola Layanan',
            ]
        ];
    }
}
