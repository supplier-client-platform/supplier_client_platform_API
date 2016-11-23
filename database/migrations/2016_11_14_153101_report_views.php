<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReportViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::statement("DROP VIEW IF EXISTS view_dashboard_order_list");
        DB::statement(
            "CREATE VIEW view_dashboard_order_list
            AS
            select 
            month(date_format(`a`.`created_at`,'%Y-%m-01')) AS `month`,
            monthname(date_format(`a`.`created_at`,'%Y-%m-01')) AS `month_name`,
            count(0) AS `orders`,`a`.`supplier_id` AS `supplier_id`,
            `a`.`status` AS `status`,sum(`a`.`gross_total`) AS `gross_total`,
            sum(`a`.`net_total`) AS `net_total`,sum(`a`.`discount`) AS `discount` 
            from `order` `a`
            where (`a`.`created_at` > (now() - interval 6 month))
            group by date_format(`a`.`created_at`,'%Y-%m-01'),`a`.`supplier_id`,`a`.`status`;"
        );

        DB::statement("DROP VIEW IF EXISTS view_report_sales");
        DB::statement(
            "CREATE VIEW view_report_sales
            AS
            SELECT
                `order`.`supplier_id` AS `supplier_id`,
                `order`.`updated_at` AS `order_date`,
                `order`.`id` AS `order_id`,
                `product`.`id` AS `product_id`,
                `product`.`name` AS `product_name`,
                `brand`.`id` AS `brand_id`,
                `brand`.`brandname` AS `brand_name`,
                `order_product`.`product_quantity` AS `product_quantity`,
                `product`.`price` AS `product_price`,
                `order`.`status` AS `order_status`
            FROM
                `order_product`,
                `product`,
                `order`,
                `brand`
            WHERE
                `order_product`.`order_id` = `order`.`id` AND `order_product`.`product_id` = `product`.`id` AND `brand`.`id` = `product`.`brand_id`"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        DB::statement("DROP VIEW IF EXISTS view_report_sales");
        DB::statement("DROP VIEW IF EXISTS view_dashboard_order_list");
    }
}
