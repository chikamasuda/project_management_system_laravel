<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sales')->insert([
            [
                'id'                      => '1',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '300000',
                'sales_date'              => '20200330',
                'planned_deposit_date'    => '20200415',
                'deposit_date'            => '20200415',
            ],
            [
                'id'                      => '2',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '300000',
                'sales_date'              => '20200430',
                'planed_deposit_date'     => '20200515',
                'deposit_date'            => '20200515',
            ],
            [
                'id'                      => '3',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '300000',
                'sales_date'              => '20200530',
                'planed_deposit_date'     => '20200615',
                'deposit_date'            => '20200615',
            ],
            [
                'id'                      => '4',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '300000',
                'sales_date'              => '20200630',
                'planed_deposit_date'     => '20200715',
                'deposit_date'            => '20200715',
            ],
            [
                'id'                      => '5',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '300000',
                'sales_date'              => '20200730',
                'planed_deposit_date'     => '20200815',
                'deposit_date'            => '20200815',
            ],
            [
                'id'                      => '6',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '300000',
                'sales_date'              => '20200830',
                'planed_deposit_date'     => '20200915',
                'deposit_date'            => '20200915',
            ],
            [
                'id'                      => '7',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '300000',
                'sales_date'              => '20200930',
                'planed_deposit_date'     => '20201015',
                'deposit_date'            => '20201015',
            ],
            [
                'id'                      => '8',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '300000',
                'sales_date'              => '20201030',
                'planed_deposit_date'     => '20201115',
                'deposit_date'            => '20201115',
            ],
            [
                'id'                      => '9',
                'project_id'              => '3',
                'status'                  => '3',
                'content'                 => 'プロジェクト3の月額報酬',
                'amount'                  => '200000',
                'sales_date'              => '20201030',
                'planed_deposit_date'     => '20201130',
                'deposit_date'            => '20201130',
            ],
            [
                'id'                      => '10',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '300000',
                'sales_date'              => '20201130',
                'planed_deposit_date'    => '20201215',
                'deposit_date'            => '20201215',
            ],
            [
                'id'                      => '11',
                'project_id'              => '3',
                'status'                  => '3',
                'content'                 => 'プロジェクト3の月額報酬',
                'amount'                  => '200000',
                'sales_date'              => '20201130',
                'planed_deposit_date'    => '20201231',
                'deposit_date'            => '20201231',
            ],
            [
                'id'                      => '12',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '300000',
                'sales_date'              => '20201231',
                'planed_deposit_date'    => '20210115',
                'deposit_date'            => '20210115',
            ],
            [
                'id'                      => '13',
                'project_id'              => '3',
                'status'                  => '3',
                'content'                 => 'プロジェクト3の月額報酬',
                'amount'                  => '200000',
                'sales_date'              => '20201231',
                'planed_deposit_date'     => '20210131',
                'deposit_date'            => '20210131',
            ],
            [
                'id'                      => '14',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '300000',
                'sales_date'              => '20210131',
                'planed_deposit_date'     => '20210215',
                'deposit_date'            => '20210215',
            ],
            [
                'id'                      => '15',
                'project_id'              => '3',
                'status'                  => '3',
                'content'                 => 'プロジェクト3の月額報酬',
                'amount'                  => '200000',
                'sales_date'              => '20210131',
                'planed_deposit_date'     => '20210228',
                'deposit_date'            => '20210228',
            ],
            [
                'id'                      => '16',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '300000',
                'sales_date'              => '20210228',
                'planed_deposit_date'    => '20210315',
                'deposit_date'            => '20210315',
            ],
            [
                'id'                      => '17',
                'project_id'              => '3',
                'status'                  => '3',
                'content'                 => 'プロジェクト3の月額報酬',
                'amount'                  => '200000',
                'sales_date'              => '20210228',
                'planed_deposit_date'    => '20210331',
                'deposit_date'            => '20210331',
            ],
            [
                'id'                      => '18',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '300000',
                'sales_date'              => '20210331',
                'planed_deposit_date'    => '20210415',
                'deposit_date'            => '20210415',
            ],
            [
                'id'                      => '19',
                'project_id'              => '3',
                'status'                  => '3',
                'content'                 => 'プロジェクト3の月額報酬',
                'amount'                  => '200000',
                'sales_date'              => '20210331',
                'planed_deposit_date'    => '20210430',
                'deposit_date'            => '20210430',
            ],
            [
                'id'                      => '20',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '300000',
                'sales_date'              => '20210430',
                'planed_deposit_date'    => '20210515',
                'deposit_date'            => '20210515',
            ],
            [
                'id'                      => '21',
                'project_id'              => '3',
                'status'                  => '3',
                'content'                 => 'プロジェクト3の月額報酬',
                'amount'                  => '200000',
                'sales_date'              => '20210430',
                'planed_deposit_date'    => '20210531',
                'deposit_date'            => '20210531',
            ],
            [
                'id'                      => '22',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '300000',
                'sales_date'              => '20210531',
                'planed_deposit_date'    => '20210615',
                'deposit_date'            => '20210615',
            ],
            [
                'id'                      => '23',
                'project_id'              => '3',
                'status'                  => '3',
                'content'                 => 'プロジェクト3の月額報酬',
                'amount'                  => '200000',
                'sales_date'              => '20210531',
                'planed_deposit_date'    => '20210630',
                'deposit_date'            => '20210630',
            ],
            [
                'id'                      => '24',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '300000',
                'sales_date'              => '20210630',
                'planed_deposit_date'    => '20210715',
                'deposit_date'            => '20210715',
            ],
            [
                'id'                      => '25',
                'project_id'              => '3',
                'status'                  => '3',
                'content'                 => 'プロジェクト3の月額報酬',
                'amount'                  => '200000',
                'sales_date'              => '20210630',
                'planed_deposit_date'    => '20210731',
                'deposit_date'            => '20210731',
            ],
            [
                'id'                      => '26',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '300000',
                'sales_date'              => '20210731',
                'planed_deposit_date'    => '20210815',
                'deposit_date'            => '20210815',
            ],
            [
                'id'                      => '27',
                'project_id'              => '3',
                'status'                  => '3',
                'content'                 => 'プロジェクト3の月額報酬',
                'amount'                  => '200000',
                'sales_date'              => '20210731',
                'planed_deposit_date'    => '20210831',
                'deposit_date'            => '20210831',
            ],
            [
                'id'                      => '28',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '300000',
                'sales_date'              => '20210831',
                'planed_deposit_date'    => '20210915',
                'deposit_date'            => '20210915',
            ],
            [
                'id'                      => '29',
                'project_id'              => '3',
                'status'                  => '3',
                'content'                 => 'プロジェクト3の月額報酬',
                'amount'                  => '200000',
                'sales_date'              => '20210831',
                'planed_deposit_date'     => '20210930',
                'deposit_date'            => '20210930',
            ],
            [
                'id'                      => '30',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '300000',
                'sales_date'              => '20210930',
                'planed_deposit_date'    => '20211015',
                'deposit_date'            => '20211015',
            ],
            [
                'id'                      => '31',
                'project_id'              => '3',
                'status'                  => '3',
                'content'                 => 'プロジェクト3の月額報酬',
                'amount'                  => '200000',
                'sales_date'              => '20210930',
                'planed_deposit_date'     => '20211031',
                'deposit_date'            => '20211031',
            ],
            [
                'id'                      => '32',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '300000',
                'sales_date'              => '20211031',
                'planed_deposit_date'    => '20211115',
                'deposit_date'            => '20211115',
            ],
            [
                'id'                      => '33',
                'project_id'              => '3',
                'status'                  => '3',
                'content'                 => 'プロジェクト3の月額報酬',
                'amount'                  => '200000',
                'sales_date'              => '20211031',
                'planed_deposit_date'     => '20211130',
                'deposit_date'            => '20211130',
            ],
            [
                'id'                      => '34',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '300000',
                'sales_date'              => '20211130',
                'planed_deposit_date'     => '20211215',
                'deposit_date'            => '20211215',
            ],
            [
                'id'                      => '35',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '300000',
                'sales_date'              => '20211231',
                'planed_deposit_date'    => '20220115',
                'deposit_date'            => '20220115',
            ],
            [
                'id'                      => '36',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '300000',
                'sales_date'              => '20220131',
                'planed_deposit_date'    => '20220215',
                'deposit_date'            => '20220215',
            ],
            [
                'id'                      => '37',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '300000',
                'sales_date'              => '20220228',
                'planed_deposit_date'    => '20220315',
                'deposit_date'            => '20220315',
            ],
            [
                'id'                      => '38',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '300000',
                'sales_date'              => '20220331',
                'planed_deposit_date'    => '20220415',
                'deposit_date'            => '20220415',
            ],
            [
                'id'                      => '39',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '300000',
                'sales_date'              => '20220430',
                'planed_deposit_date'    => '20220515',
                'deposit_date'            => '20220515',
            ],
            [
                'id'                      => '40',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '300000',
                'sales_date'              => '20220531',
                'planed_deposit_date'    => '20220615',
                'deposit_date'            => '20220615',
            ],
            [
                'id'                      => '41',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '300000',
                'sales_date'              => '20220630',
                'planed_deposit_date'    => '20220715',
                'deposit_date'            => '20220715',
            ],
            [
                'id'                      => '42',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '300000',
                'sales_date'              => '20220731',
                'planed_deposit_date'    => '20220815',
                'deposit_date'            => '20220815',
            ],
            [
                'id'                      => '43',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '300000',
                'sales_date'              => '20220831',
                'planed_deposit_date'    => '20220915',
                'deposit_date'            => '20220915',
            ],
            [
                'id'                      => '44',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '300000',
                'sales_date'              => '20220930',
                'planed_deposit_date'    => '20221015',
                'deposit_date'            => '20221015',
            ],
            [
                'id'                      => '45',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '400000',
                'sales_date'              => '20221031',
                'planed_deposit_date'     => '20221115',
                'deposit_date'            => '20221115',
            ],
            [
                'id'                      => '46',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '400000',
                'sales_date'              => '20221130',
                'planed_deposit_date'    => '20221215',
                'deposit_date'            => '20221215',
            ],
            [
                'id'                      => '47',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '400000',
                'sales_date'              => '20221231',
                'planed_deposit_date'     => '20230115',
                'deposit_date'            => '20230115',
            ],
            [
                'id'                      => '48',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '400000',
                'sales_date'              => '20230131',
                'planed_deposit_date'     => '20230215',
                'deposit_date'            => '20230215',
            ],
            [
                'id'                      => '49',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '400000',
                'sales_date'              => '20230228',
                'planed_deposit_date'     => '20230315',
                'deposit_date'            => '20230315',
            ],
            [
                'id'                      => '50',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '500000',
                'sales_date'              => '20230331',
                'planed_deposit_date'     => '20230415',
                'deposit_date'            => '20230415',
            ],
            [
                'id'                      => '51',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '500000',
                'sales_date'              => '20230430',
                'planed_deposit_date'     => '20230515',
                'deposit_date'            => '20230515',
            ],
            [
                'id'                      => '52',
                'project_id'              => '2',
                'status'                  => '3',
                'content'                 => 'プロジェクト２の月額報酬',
                'amount'                  => '500000',
                'sales_date'              => '20230530',
                'planed_deposit_date'     => '20230615',
                'deposit_date'            => '20230615',
            ],
        ]);
    }
}
