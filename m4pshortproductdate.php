<?php

/**
 * LICENCE
 *
 * ALL RIGHTS RESERVED.
 * YOU ARE NOT ALLOWED TO COPY/EDIT/SHARE/WHATEVER.
 *
 * IN CASE OF ANY PROBLEM CONTACT AUTHOR.
 *
 *  @author    Jan Kołodziej (contact@modules4presta.io)
 *  @copyright Modules4Presta.io
 *  @license   ALL RIGHTS RESERVED
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

require_once __DIR__ . '/classes/Database.php';

class M4pShortProductDate extends Module
{
    public function __construct()
    {
        $this->name = 'm4pshortproductdate';
        $this->config_prefix = strtoupper($this->name);
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Modules4Presta.io';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = ['min' => '1.7', 'max' => _PS_VERSION_];
        $this->bootstrap = true;
        $this->context = Context::getContext();
        $this->db = Db::getInstance();

        parent::__construct();

        $this->displayName = $this->l('Product short date');
        $this->description = $this->l('Module to set custom short date.');
    }

    public function install()
    {
        if (
            !parent::install()
            || !$this->registerHook('displayAdminProductsExtra')
            || !$this->registerHook('actionProductUpdate')
            || !$this->registerHook('displayProductAdditionalInfo')
            || !(new Database)->installQueries()
        ) {
            return false;
        }

        return true;
    }

    public function uninstall()
    {
        if (
            !parent::uninstall()
            || !(new Database)->uninstallQueries()
        ) {
            return false;
        }

        return true;
    }

    private function getDatesData($idProduct)
    {
        $sql = "SELECT * FROM " . _DB_PREFIX_ . "m4pshortproductdate_dates
            WHERE id_product = " . pSQL((int) $idProduct);

        return $this->db->getRow($sql);
    }

    public function hookDisplayAdminProductsExtra($params)
    {
        $datesInfo = $this->getDatesData($params['id_product']);
        if (!empty($datesInfo['date'])) {
            $datesInfo['date'] = date('Y-m-d', strtotime($datesInfo['date']));
        }

        $this->context->smarty->assign([
            'data' => $datesInfo,
        ]);

        return $this->context->smarty->fetch('module:' . $this->name . '/views/templates/hook/displayAdminProductsExtra.tpl');
    }

    public function hookActionProductUpdate($params)
    {
        $sql = "INSERT INTO `" . _DB_PREFIX_ . "m4pshortproductdate_dates` (`id_product`, `active`, `date`)
            VALUES (
                " . pSQL((int) $params['id_product']) . ",
                " . pSQL((int) Tools::getValue('m4pshortproductdate_active')) . ",
                '" . pSQL(Tools::getValue('m4pshortproductdate_expired_date')) . "'
            ) ON DUPLICATE KEY UPDATE
                `active` = VALUES(`active`),
                `date` = VALUES(`date`)
        ";

        $this->db->execute($sql);
    }

    public function hookDisplayProductAdditionalInfo($params)
    {
        $datesInfo = $this->getDatesData($params['product']['id_product']);
        if (empty($datesInfo['active'])) {
            return false;
        } elseif (!empty($datesInfo['date'])) {
            $datesInfo['date'] = date('d.m.Y', strtotime($datesInfo['date']));
        }

        $this->context->smarty->assign([
            'data' => $datesInfo,
        ]);

        return $this->context->smarty->fetch('module:' . $this->name . '/views/templates/hook/displayProductAdditionalInfo.tpl');
    }
}
