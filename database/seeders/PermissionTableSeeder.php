<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $permissions = [
        'الرئيسية',
        'اقسام المنتجات',
        'المنتجات',
        'اقسام منتجات الملابس',
        'منتجات الملابس',
        'المقاسات',
        'اوردرات',
        'اوردرات الملابس',
        'اراء العملاء',
        'العملاء',
        'الطلبات',//
        'المسخدمين',
        'صلاحيات المستخدمين',
        
        //section
        'اضافة قسم',
        'تعديل القسم',
        'حذف القسم',
        
        //clothing section
        'اضافة قسم الملابس',
        'تعديل قسم الملابس',
        'حذف قسم الملابس',
        
        //product
        'اضافة منتج',
        'تعديل المنتج',
        'حذف المنتج',
        'عرض صور المنتج',
        
        //clothing product
        'اضافة منتج الملابس',
        'تعديل منتج الملابس',
        'حذف منتج الملابس',
        'عرض حجم وسعر المنتج',
        'عرض لون المنتج',
        'عرض صور المنتج الملابس',
        
        //size
        'اضافة مقاس',
        'حذف مقاس',

        //color
        'الالوان',
        'اضافة لون',
        'حذف لون',
        
        //order
        'قبول الاوردر',
        'رفض الاوردر',
        'اتمام الاوردر',
        'حذف الاوردر',
        //clothing order
        'قبول اوردر الملابس',
        'رفض اوردر الملابس',
        'اتمام اوردر الملابس',
        'حذف اوردر الملابس',

        'حذف اراء العملاء',

        'اضافة مستخدم',
        'عرض المستخدم',
        'تعديل المستخدم',
        'حذف المستخدم',

        'اضافة صلاحية',
        'عرض الصلاحية',
        'تعديل الصلاحية',
        'حذف الصلاحية',
    ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
