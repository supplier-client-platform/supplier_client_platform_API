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
        //
        DB::statement("DROP VIEW IF EXISTS view_dashboard_orders");
        DB::statement(
            "CREATE VIEW view_dashboard_orders
            AS
            Select 
            coalesce(b.orders,0) as  orders,
            t.status,
            coalesce(b.supplier_id,0) as  supplier_id,
            coalesce(b.gross_total,0) as  gross_total,
            coalesce(b.net_total,0) as  net_total,
            coalesce(b.discount,0) as  discount,
            MONTHNAME(STR_TO_DATE(t.month, '%m')) as month_name,
            t.month
         
         
            from
            (select f.`month`, s.`status`
             from
                (SELECT 1 AS `month`
                UNION 
                SELECT 2 AS `month`
                 UNION 
                SELECT 3 AS `month`
                 UNION 
                SELECT 4 AS `month`
                 UNION 
                SELECT 5 AS `month`
                 UNION 
                SELECT 6 AS `month`
                 UNION 
                SELECT 7 AS `month`
                 UNION 
                SELECT 8 AS `month`
                 UNION 
                SELECT 9 AS `month`
                 UNION 
                SELECT 10 AS `month`
                 UNION 
                SELECT 11 AS `month`

                UNION 
                SELECT 12 AS `month`
                ) AS f, 
                ( SELECT 'Completed' as status
                UNION
                SELECT 'Pending' as status
                UNION
                SELECT 'Accepted' as status
                UNION
                SELECT 'Rejected' as status
                ) AS s
            
            ) AS t
            
            left join 
            (SELECT 
            MONTH(DATE_FORMAT(a.created_at, '%Y-%m-01')) as month, 
            MONTHNAME(DATE_FORMAT(a.created_at, '%Y-%m-01')) as month_name, 
            count(*) as orders,
            a.supplier_id,
            a.status ,
            SUM(a.gross_total) as gross_total,
            SUM(a.net_total) as net_total,
            SUM(a.discount) as discount
            
            FROM `order` as a 
            where a.created_at > DATE_SUB(NOW(),INTERVAL 6 MONTH) 
            group by DATE_FORMAT(a.created_at, '%Y-%m-01'),a.supplier_id,a.status) b on (t.`month` = b.`month` ) AND  (t.status = b.status);"
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
        DB::statement("DROP VIEW IF EXISTS view_dashboard_orders");
    }
}
