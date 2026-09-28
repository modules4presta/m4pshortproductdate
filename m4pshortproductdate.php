<?php

/**
 * m4pshortproductdate
 *
 * @author    Modules4Presta <contact@modules4presta.io>
 * @copyright 2026 Nice Code sp. z o.o. (Modules4Presta)
 * @license   https://opensource.org/licenses/MIT MIT License
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

require_once __DIR__ . '/classes/M4pShortProductDateDatabase.php';

class M4pShortProductDate extends Module
{
    public function __construct()
    {
        $this->name = 'm4pshortproductdate';
        $this->config_prefix = strtoupper($this->name);
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Modules4Presta';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = ['min' => '1.7.6.0', 'max' => _PS_VERSION_];
        $this->bootstrap = true;
        $this->context = Context::getContext();
        $this->db = Db::getInstance();

        parent::__construct();

        $this->displayName = $this->trans('Product short date', [], 'Modules.M4pshortproductdate.Admin');
        $this->description = $this->trans('Module to set custom short date.', [], 'Modules.M4pshortproductdate.Admin');
    }

    public function install()
    {
        if (
            !parent::install()
            || !$this->registerHook('displayAdminProductsExtra')
            || !$this->registerHook('actionProductUpdate')
            || !$this->registerHook('displayProductAdditionalInfo')
            || !(new M4pShortProductDateDatabase())->installQueries()
        ) {
            return false;
        }

        return true;
    }

    public function uninstall()
    {
        if (
            !parent::uninstall()
            || !(new M4pShortProductDateDatabase())->uninstallQueries()
        ) {
            return false;
        }

        return true;
    }

    private function getDatesData($idProduct)
    {
        return $this->db->getRow(
            'SELECT * FROM `' . _DB_PREFIX_ . 'm4pshortproductdate_dates` WHERE id_product = ' . (int) $idProduct
        );
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
        if (!Tools::getIsset('m4pshortproductdate_expired_date')) {
            return;
        }

        $date = Tools::getValue('m4pshortproductdate_expired_date');
        if (!Validate::isDate($date) && !Validate::isDateFormat($date)) {
            $date = null;
        }

        $this->db->execute(
            'INSERT INTO `' . _DB_PREFIX_ . 'm4pshortproductdate_dates` (`id_product`, `active`, `date`)
            VALUES (
                ' . (int) $params['id_product'] . ',
                ' . (int) Tools::getValue('m4pshortproductdate_active') . ',
                ' . ($date === null ? 'NULL' : "'" . pSQL($date) . "'") . '
            ) ON DUPLICATE KEY UPDATE
                `active` = VALUES(`active`),
                `date` = VALUES(`date`)'
        );
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
