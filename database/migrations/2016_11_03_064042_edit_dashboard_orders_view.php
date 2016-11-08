<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditDashboardOrdersView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        ///*
        /*
        DB::statement("DROP VIEW IF EXISTS view_dashboard_months");
        DB::statement(
            "CREATE VIEW view_dashboard_months
        AS
        select 
                    `f`.`month` AS `month`,
                    `s`.`status` AS `status`
                        from (select 1 AS `month`
                        union select 2 AS `month`
                        union select 3 AS `month` 
                        union select 4 AS `month` 
                        union select 5 AS `month` 
                        union select 6 AS `month` 
                        union select 7 AS `month` 
                        union select 8 AS `month` 
                        union select 9 AS `month` 
                        union select 10 AS `month` 
                        union select 11 AS `month` 
                        union select 12 AS `month`) `f` 
                    join (select 
                        'Completed' AS `status` 
                            union select 'Pending' AS `status`
                            union select 'Accepted' AS `status` 
                            union select 'Rejected' AS `status`) `s`;"
        );

        DB::statement("DROP VIEW IF EXISTS view_dashboard_orders");
        DB::statement(
            "CREATE VIEW view_dashboard_orders
            AS
            select
            coalesce(`b`.`orders`,0) AS `orders`,
            `t`.`status` AS `status`,
            coalesce(`b`.`supplier_id`,0) AS `supplier_id`,
            coalesce(`b`.`gross_total`,0) AS `gross_total`,
            coalesce(`b`.`net_total`,0) AS `net_total`,
            coalesce(`b`.`discount`,0) AS `discount`,
            monthname(str_to_date(`t`.`month`,'%m')) AS `month_name`,
            `t`.`month` AS `month` 
                from view_dashboard_months `t` 
                    left join (select 
                        month(date_format(`a`.`created_at`,'%Y-%m-01')) AS `month`,
                        monthname(date_format(`a`.`created_at`,'%Y-%m-01')) AS `month_name`,
                        count(0) AS `orders`,`a`.`supplier_id` AS `supplier_id`,
                        `a`.`status` AS `status`,sum(`a`.`gross_total`) AS `gross_total`,
                        sum(`a`.`net_total`) AS `net_total`,sum(`a`.`discount`) AS `discount` 
                    from `scp`.`order` `a`
                    where (`a`.`created_at` > (now() - interval 6 month))
                    group by date_format(`a`.`created_at`,'%Y-%m-01'),`a`.`supplier_id`,`a`.`status`) `b` on(((`t`.`month` = `b`.`month`) and (`t`.`status` = `b`.`status`)));"
        );
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*
        DB::statement("DROP VIEW IF EXISTS view_dashboard_orders");
        DB::statement("DROP VIEW IF EXISTS view_dashboard_months");
        */
    }

}