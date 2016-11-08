<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DashboardViewCreation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
       /* DB::statement("DROP VIEW IF EXISTS view_dashboard_orders");
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
                from  reactive_dev_scp_platform.`view_dashboard_months` `t` 
                    left join reactive_dev_scp_platform.`view_dashboard_order_list` `b` on(`t`.`month` = `b`.`month` and `t`.`status` = `b`.`status`);"
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
        //
        DB::statement("DROP VIEW IF EXISTS view_dashboard_orders");
    }
}
