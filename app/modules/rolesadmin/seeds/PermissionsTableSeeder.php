<?php namespace App\Modules\Rolesadmin\Seeds;
use DB, Hash, Config, DateTime, Seeder;
use App\Modules\Rolesadmin\Models\User;
use App\Modules\Rolesadmin\Models\Post;
use App\Modules\Rolesadmin\Models\Role;

class PermissionsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('permissions')->delete();


        $permissions = array(
            array(
                'name'      => 'manage_blogs',
                'display_name'      => 'manage blogs'
                ),
            array(
                'name'      => 'manage_posts',
                'display_name'      => 'manage posts'
                ),
            array(
                'name'      => 'manage_comments',
                'display_name'      => 'manage comments'
                ),
            array(
                'name'      => 'manage_users',
                'display_name'      => 'manage users'
                ),
            array(
                'name'      => 'manage_roles',
                'display_name'      => 'manage roles'
                ),
            array(
                'name'      => 'post_comment',
                'display_name'      => 'post comment'
                ),
            array(
                'name'      => 'INT_MSG_SEND',
                'display_name'      => 'INT_MSG_SEND'
                ),
            array(
                'name'      => 'INT_MSG_DEL',
                'display_name'      => 'INT_MSG_DEL'
                ),
            array(
                'name'      => 'INT_MSG_VIEW',
                'display_name'      => 'INT_MSG_VIEW'
                ),
            array(
                'name'      => 'INT_MSG_REPLY',
                'display_name'      => 'INT_MSG_REPLY'
                ),
            array(
                'name'      => 'SYS_MSG_VIEW',
                'display_name'      => 'SYS_MSG_VIEW'
                ),
            array(
                'name'      => 'SYS_MSG_DEL',
                'display_name'      => 'SYS_MSG_DEL'
                ),
            array(
                'name'      => 'PROFILE_PIC',
                'display_name'      => 'PROFILE_PIC'
                ),
            array(
                'name'      => 'SECURITY_CENTER',
                'display_name'      => 'SECURITY_CENTER'
                ),
            array(
                'name'      => 'TX_REQ_CANCEL',
                'display_name'      => 'TX_REQ_CANCEL'
                ),
            array(
                'name'      => 'TX_SEND_VIEW',
                'display_name'      => 'TX_SEND_VIEW'
                ),
            array(
                'name'      => 'TX_SEND_PERFORM',
                'display_name'      => 'TX_SEND_PERFORM'
                ),
            array(
                'name'      => 'TX_SEND_CANCEL',
                'display_name'      => 'TX_SEND_CANCEL'
                ),
            array(
                'name'      => 'TX_LIST_TX',
                'display_name'      => 'TX_LIST_TX'
                ),
            array(
                'name'      => 'TX_LIST_REPAYMENT',
                'display_name'      => 'TX_LIST_REPAYMENT'
                ),
            array(
                'name'      => 'TX_LIST_SETTLEMENT',
                'display_name'      => 'TX_LIST_SETTLEMENT'
                ),
            array(
                'name'      => 'TX_LIST_STATEMENT',
                'display_name'      => 'TX_LIST_STATEMENT'
                ),
            array(
                'name'      => 'TX_LIST_GUARANTEES',
                'display_name'      => 'TX_LIST_GUARANTEES'
                ),
            array(
                'name'      => 'INT_MSG_STORE_SEND',
                'display_name'      => 'INT_MSG_STORE_SEND'
                ),
            array(
                'name'      => 'INT_MSG_STORE_DEL',
                'display_name'      => 'INT_MSG_STORE_DEL'
                ),
            array(
                'name'      => 'INT_MSG_STORE_VIEW',
                'display_name'      => 'INT_MSG_STORE_VIEW'
                ),
            array(
                'name'      => 'INT_MSG_STORE_REPLY',
                'display_name'      => 'INT_MSG_STORE_REPLY'
                ),
            array(
                'name'      => 'SYS_MSG_STORE_VIEW',
                'display_name'      => 'SYS_MSG_STORE_VIEW'
                ),
            array(
                'name'      => 'SYS_MSG_STORE_DEL',
                'display_name'      => 'SYS_MSG_STORE_DEL'
                ),
            array(
                'name'      => 'MANAGE_SERVICES_VIEW',
                'display_name'      => 'MANAGE_SERVICES_VIEW'
                ),
            array(
                'name'      => 'MANAGE_SERVICES_EDIT',
                'display_name'      => 'MANAGE_SERVICES_EDIT'
                ),
            array(
                'name'      => 'MANAGE_SERVICES_DEL',
                'display_name'      => 'MANAGE_SERVICES_DEL'
                ),
            array(
                'name'      => 'MANAGE_SERVICE_PUBLISH',
                'display_name'      => 'MANAGE_SERVICE_PUBLISH'
                ),
            array(
                'name'      => 'MANAGE_POTENTIAL_CUSTOMER',
                'display_name'      => 'MANAGE_POTENTIAL_CUSTOMER'
                ),
            array(
                'name'      => 'MANAGE_ENGAGED_CUSTOMER',
                'display_name'      => 'MANAGE_ENGAGED_CUSTOMER'
                ),
            array(
                'name'      => 'MANAGE_EMP_EDIT',
                'display_name'      => 'MANAGE_EMP_EDIT'
                ),
            array(
                'name'      => 'MANAGE_EMP_VIEW',
                'display_name'      => 'MANAGE_EMP_VIEW'
                ),
            array(
                'name'      => 'MANAGE_EMP_DEL',
                'display_name'      => 'MANAGE_EMP_DEL'
                ),
            array(
                'name'      => 'MANAGE_DEP_ADD',
                'display_name'      => 'MANAGE_DEP_ADD'
                ),
            array(
                'name'      => 'MANAGE_DEP_EDIT',
                'display_name'      => 'MANAGE_DEP_EDIT'
                ),
            array(
                'name'      => 'MANAGE_DEP_VIEW',
                'display_name'      => 'MANAGE_DEP_VIEW'
                ),
            array(
                'name'      => 'MANAGE_DEP_DEL',
                'display_name'      => 'MANAGE_DEP_DEL'
                ),
            array(
                'name'      => 'MANAGE_POS_ADD',
                'display_name'      => 'MANAGE_POS_ADD'
                ),
            array(
                'name'      => 'MANAGE_POS_EDIT',
                'display_name'      => 'MANAGE_POS_EDIT'
                ),
            array(
                'name'      => 'MANAGE_POS_VIEW',
                'display_name'      => 'MANAGE_POS_VIEW'
                ),
            array(
                'name'      => 'MANAGE_POS_DEL',
                'display_name'      => 'MANAGE_POS_DEL'
                ),
            array(
                'name'      => 'MANAGE_SUBSIDIARY_ADD',
                'display_name'      => 'MANAGE_SUBSIDIARY_ADD'
                ),
            array(
                'name'      => 'MANAGE_SUBSIDIARY_EDIT',
                'display_name'      => 'MANAGE_SUBSIDIARY_EDIT'
                ),
            array(
                'name'      => 'MANAGE_SUBSIDIARY_VIEW',
                'display_name'      => 'MANAGE_SUBSIDIARY_VIEW'
                ),
            array(
                'name'      => 'MANAGE_SUBSIDIARY_DEL',
                'display_name'      => 'MANAGE_SUBSIDIARY_DEL'
                ),
            array(
                'name'      => 'MANAGE_ROLES_ADD',
                'display_name'      => 'MANAGE_ROLES_ADD'
                ),
            array(
                'name'      => 'MANAGE_ROLES_EDIT',
                'display_name'      => 'MANAGE_ROLES_EDIT'
                ),
            array(
                'name'      => 'MANAGE_ROLES_DEL',
                'display_name'      => 'MANAGE_ROLES_DEL'
                ),
            array(
                'name'      => 'VIEW_KYPAY_USER_BASIC',
                'display_name'      => 'VIEW_KYPAY_USER_BASIC'
                ),
            array(
                'name'      => 'VIEW_KYPAY_USER_TX_LIST',
                'display_name'      => 'VIEW_KYPAY_USER_TX_LIST'
                ),
            array(
                'name'      => 'VIEW_KYPAY_USER_REPAYMENT_LIST',
                'display_name'      => 'VIEW_KYPAY_USER_REPAYMENT_LIST'
                ),
            array(
                'name'      => 'VIEW_KYPAY_USER_SETTLEMENT_LIST',
                'display_name'      => 'VIEW_KYPAY_USER_SETTLEMENT_LIST'
                ),
            array(
                'name'      => 'VIEW_KYPAY_USER_STATEMENT_LIST',
                'display_name'      => 'VIEW_KYPAY_USER_STATEMENT_LIST'
                ),
            array(
                'name'      => 'FLOW_MGMT_NEW',
                'display_name'      => 'FLOW_MGMT_NEW'
                ),
            array(
                'name'      => 'FLOW_MGMT_EDIT',
                'display_name'      => 'FLOW_MGMT_EDIT'
                ),
            array(
                'name'      => 'FLOW_MGMT_DEL',
                'display_name'      => 'FLOW_MGMT_DEL'
                ),
            array(
                'name'      => 'FLOW_MGMT_INITIATE',
                'display_name'      => 'FLOW_MGMT_INITIATE'
                ),
            array(
                'name'      => 'IMPORT_KYPAY_CARDS',
                'display_name'      => 'IMPORT_KYPAY_CARDS'
                ),
            array(
                'name'      => 'ASSIGN_KYPAY_CARDS',
                'display_name'      => 'ASSIGN_KYPAY_CARDS'
                ),
            array(
                'name'      => 'MANAGE_NOT_RECEIVED_CARDS',
                'display_name'      => 'MANAGE_NOT_RECEIVED_CARDS'
                ),
            array(
                'name'      => 'DATA_DIC_ADD',
                'display_name'      => 'DATA_DIC_ADD'
                ),
            array(
                'name'      => 'DATA_DIC_DEL',
                'display_name'      => 'DATA_DIC_DEL'
                ),
            array(
                'name'      => 'DATA_DIC_VIEW',
                'display_name'      => 'DATA_DIC_VIEW'
                ),
            array(
                'name'      => 'DATA_DIC_EDIT',
                'display_name'      => 'DATA_DIC_EDIT'
                ),
            array(
                'name'      => 'INDIVIDUAL_BLACK_LIST',
                'display_name'      => 'INDIVIDUAL_BLACK_LIST'
                ),
            array(
                'name'      => 'ENTERPRISE_BLACK_LIST',
                'display_name'      => 'ENTERPRISE_BLACK_LIST'
                ),
            array(
                'name'      => 'USERS_WHITE_LIST',
                'display_name'      => 'USERS_WHITE_LIST'
                ),
            array(
                'name'      => 'WORKFLOW_TEMPLATE_EDIT',
                'display_name'      => 'WORKFLOW_TEMPLATE_EDIT'
                ),
            array(
                'name'      => 'WORKFLOW_TEMPLATE_PREVIEW',
                'display_name'      => 'WORKFLOW_TEMPLATE_PREVIEW'
                ),
            array(
                'name'      => 'SUB_KYPAY_CARDS',
                'display_name'      => 'SUB_KYPAY_CARDS'
                ),
            array(
                'name'      => 'SUB_KYPAY_CARDS_RECEIVED',
                'display_name'      => 'SUB_KYPAY_CARDS_RECEIVED'
                ),
            array(
                'name'      => 'TX_STORE_REQ_VIEW',
                'display_name'      => 'TX_STORE_REQ_VIEW'
                ),
            array(
                'name'      => 'TX_STORE_REQ_CANCEL',
                'display_name'      => 'TX_STORE_REQ_CANCEL'
                ),
            array(
                'name'      => 'TX_STORE_SEND_VIEW',
                'display_name'      => 'TX_STORE_SEND_VIEW'
                ),
            array(
                'name'      => 'TX_STORE_SEND_PERFORM',
                'display_name'      => 'TX_STORE_SEND_PERFORM'
                ),
            array(
                'name'      => 'TX_STORE_SEND_CANCEL',
                'display_name'      => 'TX_STORE_SEND_CANCEL'
                ),
            array(
                'name'      => 'TX_STORE_LIST_TX',
                'display_name'      => 'TX_STORE_LIST_TX'
                ),
            array(
                'name'      => 'TASK_MANAGEMENT',
                'display_name'      => 'TASK_MANAGEMENT'
                ),
            array(
                'name'      => 'PROFILE_PIC_STORE',
                'display_name'      => 'PROFILE_PIC_STORE'
                ),
            array(
                'name'      => 'BASIC_INFO_STORE',
                'display_name'      => 'BASIC_INFO_STORE'
                ),
            array(
                'name'      => 'TX_REQ_VIEW',
                'display_name'      => 'TX_REQ_VIEW'
                ),
            array(
                'name'      => 'TX_REQ_PERFORM',
                'display_name'      => 'TX_REQ_PERFORM'
                ),
            array(
                'name'      => 'TX_STORE_REQ_PERFORM',
                'display_name'      => 'TX_STORE_REQ_PERFORM'
                ),
            array(
                'name'      => 'MANAGE_EMP_ADD',
                'display_name'      => 'MANAGE_EMP_ADD'
                ),
            array(
                'name'      => 'TX_STORE_LIST_SETTLEMENT',
                'display_name'      => 'TX_STORE_LIST_SETTLEMENT'
                ),
            array(
                'name'      => 'TX_STORE_LIST_STATEMENT',
                'display_name'      => 'TX_STORE_LIST_STATEMENT'
                ),
            array(
                'name'      => 'TX_STORE_LIST_REPAYMENT',
                'display_name'      => 'TX_STORE_LIST_REPAYMENT'
                ),
            array(
                'name'      => 'BASIC_INFO',
                'display_name'      => 'BASIC_INFO'
                ),
            array(
                'name'      => 'MY_KYPAY',
                'display_name'      => 'MY_KYPAY'
                ),
            array(
                'name'      => 'SEC_KYPAY_CARD',
                'display_name'      => 'SEC_KYPAY_CARD'
                ),
            array(
                'name'      => 'REQ_TAX_RECEIPT',
                'display_name'      => 'REQ_TAX_RECEIPT'
                ),
            array(
                'name'      => 'STORE_MY_KYPAY',
                'display_name'      => 'STORE_MY_KYPAY'
                ),
            array(
                'name'      => 'VIEW_PARENT_CO',
                'display_name'      => 'VIEW_PARENT_CO'
                ),
            array(
                'name'      => 'STORE_SEC_KYPAY_CARD',
                'display_name'      => 'STORE_SEC_KYPAY_CARD'
                ),
            array(
                'name'      => 'STORE_REQ_TAX_RECEIPT',
                'display_name'      => 'STORE_REQ_TAX_RECEIPT'
                ),
            array(
                'name'      => 'VIEW_BREACH_CONTRACTS',
                'display_name'      => 'VIEW_BREACH_CONTRACTS'
                ),
            array(
                'name'      => 'VIEW_OTP_RECORDS',
                'display_name'      => 'VIEW_OTP_RECORDS'
                ),
            array(
                'name'      => 'VIEW_BANK_CARDS',
                'display_name'      => 'VIEW_BANK_CARDS'
                ),
            array(
                'name'      => 'KYPAY_PAYABLES',
                'display_name'      => 'KYPAY_PAYABLES'
                ),
            array(
                'name'      => 'KYPAY_RECEIVABLES',
                'display_name'      => 'KYPAY_RECEIVABLES'
                ),
            array(
                'name'      => 'KYPAY_COLLECTION_RECORDS',
                'display_name'      => 'KYPAY_COLLECTION_RECORDS'
                ),
            array(
                'name'      => 'KYPAY_PAYMENT_RECORDS',
                'display_name'      => 'KYPAY_PAYMENT_RECORDS'
                ),
            array(
                'name'      => 'KYPAY_CUST_IN_DEFAULT',
                'display_name'      => 'KYPAY_CUST_IN_DEFAULT'
                ),
            array(
                'name'      => 'KYPAY_SETTLEMENT_MGMT',
                'display_name'      => 'KYPAY_SETTLEMENT_MGMT'
                ),
            array(
                'name'      => 'KYPAY_BANK_CARDS_VALIDATION',
                'display_name'      => 'KYPAY_BANK_CARDS_VALIDATION'
                ),
            array(
                'name'      => 'KYPAY_BANK_CARDS_VERIFICATION',
                'display_name'      => 'KYPAY_BANK_CARDS_VERIFICATION'
                ),
            array(
                'name'      => 'KYPAY_TAX_RECEIPT_MGMT',
                'display_name'      => 'KYPAY_TAX_RECEIPT_MGMT'
                ),
            array(
                'name'      => 'KYPAY_MEMBERS_CHANGE_SETT_PLAN',
                'display_name'      => 'KYPAY_MEMBERS_CHANGE_SETT_PLAN'
                ),
            array(
                'name'      => 'KYPAY_PARAMS_MGMT',
                'display_name'      => 'KYPAY_PARAMS_MGMT'
                ),
            );

DB::table('permissions')->insert( $permissions );

DB::table('permission_role')->delete();
DB::statement('SET FOREIGN_KEY_CHECKS=0;');

$permissions = array(
    array(
        'role_id'      => 1,
        'permission_id' => 1
        ),
    array(
        'role_id'      => 1,
        'permission_id' => 2
        ),
    array(
        'role_id'      => 1,
        'permission_id' => 3
        ),
    array(
        'role_id'      => 1,
        'permission_id' => 4
        ),
    array(
        'role_id'      => 1,
        'permission_id' => 5
        ),
    array(
        'role_id'      => 1,
        'permission_id' => 6
        ),
    array(
        'role_id'      => 2,
        'permission_id' => 6
        ),
    );

DB::table('permission_role')->insert( $permissions );
DB::statement('SET FOREIGN_KEY_CHECKS=1;');
}

}
